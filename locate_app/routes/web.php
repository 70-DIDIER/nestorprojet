<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoitureController;
use App\Http\controllers\ReservationController;
use App\Mail\ReservationApprovedMail;

// Routes publiques
Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // Routes des voitures
    Route::get('/voitures/create', [VoitureController::class, 'create'])->name('voitures.create');
    Route::post('/voitures', [VoitureController::class, 'store'])->name('voitures.store');
    Route::get('/voitures', [VoitureController::class, 'index'])->name('voitures.index');
    Route::get('/voitures/{voiture}', [VoitureController::class, 'show'])->name('voitures.show');
    Route::get('/voitures/{voiture}/edit', [VoitureController::class, 'edit'])->name('voitures.edit');
    Route::put('/voitures/{voiture}', [VoitureController::class, 'update'])->name('voitures.update');
    Route::delete('/voitures/{voiture}', [VoitureController::class, 'destroy'])->name('voitures.destroy');

    // Routes des réservations
    Route::post('/reservations/{reservation}/approve', [ReservationController::class, 'approve'])->name('reservations.approve');
    Route::post('/reservations/{reservation}/reject', [ReservationController::class, 'reject'])->name('reservations.reject');
    Route::get('/voitures/{voiture}/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/voitures/{voiture}/reservations/', [ReservationController::class, 'store'])->name('reservations.store');

    // Route de test email
    Route::get('/test-email', function() {
        $reservation = App\Models\Reservation::first();
        Mail::to('test@example.com')->send(new App\Mail\ReservationApprovedMail($reservation));
        return 'Email envoyé';
    });

    // Routes du profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

    