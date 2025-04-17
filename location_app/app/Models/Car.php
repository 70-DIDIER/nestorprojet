<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'registration',
        'price_per_day',
        'description',
        'image',
        'available',
    ];

    // Une voiture peut avoir plusieurs réservations
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
