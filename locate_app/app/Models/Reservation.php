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
    protected $casts = [
        'date_debut' => 'datetime:Y-m-d',
        'date_fin' => 'datetime:Y-m-d',
    ];

    public const STATUT_EN_ATTENTE = 'en_attente';
public const STATUT_APPROUVEE = 'approuvee';
public const STATUT_REJETEE = 'rejetee';
    public function user()
{
    return $this->belongsTo(User::class);
}

public function voiture()
{
    return $this->belongsTo(Voiture::class);
}
}
