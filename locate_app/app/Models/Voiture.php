<?php

namespace App\Models;
use App\Models\Reservation; 

use Illuminate\Database\Eloquent\Model;

class Voiture extends Model
{
    //
    protected $fillable = [
        'marque', 'modele', 'annee', 'prix_journalier',
        'carburant', 'photo', 'disponible'
    ];
    public function reservations()
{
    return $this->hasMany(Reservation::class);
}

public function estDisponible($debut = null, $fin = null)
{
    return $this->disponible && !$this->reservations()
        ->where(function($query) use ($debut, $fin) {
            $query->whereBetween('date_debut', [$debut, $fin])
                  ->orWhereBetween('date_fin', [$debut, $fin]);
        })->exists();
}
}
