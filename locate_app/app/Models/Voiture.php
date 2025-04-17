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
}
