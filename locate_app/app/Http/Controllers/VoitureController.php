<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voiture;
use Illuminate\Support\Facades\Storage;

class VoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $voitures = Voiture::latest()->paginate(10); // 10 éléments par page
        return view('voitures.index', compact('voitures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('voitures.create'); // Affiche le formulaire
}

public function store(Request $request)
{
    // Convertit les données avant validation
    $request->merge([
        'disponible' => $request->has('disponible'), // Convertit "on" en true/false
        'annee' => (int)$request->annee,
        'prix_journalier' => (float)$request->prix_journalier
    ]);

    // Validation
    $validated = $request->validate([
        'marque' => 'required|string|max:50',
        'modele' => 'required|string|max:50',
        'annee' => 'required|integer|min:2000|max:'.(date('Y')+1),
        'prix_journalier' => 'required|numeric|min:10',
        'carburant' => 'required|in:Essence,Diesel,Electrique,Hybride',
        'photo' => 'required|image|mimes:jpeg,png|max:5000',
        'disponible' => 'boolean' // 'sometimes' retiré car toujours présent
    ]);

    // Debug: Vérifiez les données après conversion
    // dd($validated);

    // Gestion de l'upload
    $path = $request->file('photo')->store('voitures', 'public');
    $validated['photo'] = $path;

    // Création
    $voiture = Voiture::create($validated);

    return redirect()->route('voitures.index')
         ->with('success', 'Voiture créée (ID: '.$voiture->id.')');
}

    /**
     * Display the specified resource.
     */
    public function show(Voiture $voiture) // Utilisez la "Route Model Binding"
{
    return view('voitures.show', compact('voiture'));
}
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voiture $voiture)
    {
        return view('voitures.edit', compact('voiture'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voiture $voiture)
{
    $validated = $request->validate([
        'marque' => 'required|string|max:50',
        'modele' => 'required|string|max:50',
        'annee' => 'required|integer|min:2000|max:'.(date('Y')+1),
        'prix_journalier' => 'required|numeric|min:10',
        'carburant' => 'required|in:Essence,Diesel,Electrique,Hybride',
        'photo' => 'sometimes|image|mimes:jpeg,png|max:2048',
        'disponible' => 'boolean'
    ]);

    if ($request->hasFile('photo')) {
        // Supprime l'ancienne photo si elle existe
        Storage::disk('public')->delete($voiture->photo);
        $path = $request->file('photo')->store('voitures', 'public');
        $validated['photo'] = $path;
    }

    $voiture->update($validated);

    return redirect()->route('voitures.index')
         ->with('success', 'Voiture mise à jour avec succès !');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voiture $voiture)
    {
        try {
            // Supprime la photo si elle existe
            if ($voiture->photo) {
                Storage::disk('public')->delete($voiture->photo);
            }
            
            $voiture->delete();
            
            return redirect()->route('voitures.index')
                 ->with('success', 'Voiture supprimée avec succès !');
                 
        } catch (\Exception $e) {
            return redirect()->back()
                 ->with('error', 'Erreur lors de la suppression : '.$e->getMessage());
        }
    }
}
