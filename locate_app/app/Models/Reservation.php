<?php

namespace App\Models;
use App\Models\User;
use App\Models\Voiture;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //
    protected $fillable = [
        'user_id', 'voiture_id', 'date_debut', 'date_fin',
        'prix_total', 'statut'
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function voiture()
{
    return $this->belongsTo(Voiture::class);
}
}
