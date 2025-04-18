<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reservation;
use App\Models\Voiture;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['user', 'voiture'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('reservations.index', compact('reservations'));
    }

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

        $dateDebut = new \DateTime($validated['date_debut']);
        $jours = $dateDebut->diff(new \DateTime($validated['date_fin']))->days;
        $prix_total = $jours * $voiture->prix_journalier;

        Reservation::create([
            'user_id' => auth()->id(),
            'voiture_id' => $voiture->id,
            'date_debut' => $validated['date_debut'],
            'date_fin' => $validated['date_fin'],
            'prix_total' => $prix_total,
            'statut' => 'en_attente'
        ]);

        return redirect()->route('voitures.show', $voiture)
             ->with('success', 'Réservation créée !');
    }

    public function approve(Reservation $reservation)
    {
        if ($reservation->statut === 'en_attente') {
            DB::transaction(function () use ($reservation) {
                $reservation->update(['statut' => 'confirmee']);
                $reservation->voiture()->update(['disponible' => false]);
            });
            
            return back()->with('success', 'Réservation confirmée');
        }
        
        return back()->with('error', 'Action non autorisée');
    }

    public function reject(Reservation $reservation)
    {
        if ($reservation->statut === 'en_attente') {
            $reservation->update(['statut' => 'annulee']);
            return back()->with('success', 'Réservation annulée');
        }
        return back()->with('error', 'Action non autorisée');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}