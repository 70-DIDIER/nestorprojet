<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Voiture;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Voiture $voiture)
    {
        return view('reservations.create', compact('voiture'));
    }

public function store(Request $request, Voiture $voiture)
{
    $validated = $request->validate([
        'date_debut' => 'required|date|after_or_equal:today',
        'date_fin' => 'required|date|after:date_debut',
    ]);

    // Calcul du prix
    $dateDebut = new \DateTime($validated['date_debut']);
    $jours = $dateDebut->diff(new \DateTime($validated['date_fin']))->days;
    $prix_total = $jours * $voiture->prix_journalier;

    Reservation::create([
        'user_id' => auth()->id(),
        'voiture_id' => $voiture->id,
        'date_debut' => $validated['date_debut'],
        'date_fin' => $validated['date_fin'],
        'prix_total' => $prix_total,
    ]);

    return redirect()->route('voitures.show', $voiture)
         ->with('success', 'Réservation créée !');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
