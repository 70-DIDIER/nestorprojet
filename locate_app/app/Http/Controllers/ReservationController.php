<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reservation;
use App\Models\Voiture;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::with(['user', 'voiture'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Voiture $voiture)
    {
        return view('reservations.create', compact('voiture'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
            'statut' => 'en_attente' // Ajout du statut par défaut
        ]);

        return redirect()->route('voitures.show', $voiture)
             ->with('success', 'Réservation créée !');
    }

    /**
     * Approve the specified reservation.
     */
 // Dans ReservationController.php
public function approve(Reservation $reservation)
{
    if ($reservation->statut === 'en_attente') {
        DB::transaction(function () use ($reservation) {
            $reservation->update(['statut' => 'confirmee']); // Utilisez 'confirmee' au lieu de 'approuvee'
            $reservation->voiture()->update(['disponible' => false]);
        });
        return back()->with('success', 'Réservation confirmée avec succès');
    }
    return back()->with('error', 'Action non autorisée');
}

public function reject(Reservation $reservation)
{
    if ($reservation->statut === 'en_attente') {
        $reservation->update(['statut' => 'annulee']); // Utilisez 'annulee' au lieu de 'rejetee'
        return back()->with('success', 'Réservation annulée');
    }
    return back()->with('error', 'Action non autorisée');
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