<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoitureController;
use App\Http\controllers\ReservationController;

Route::get('/', function () {
    return view('welcome');
});

// Afficher le formulaire
Route::get('/voitures/create', [VoitureController::class, 'create'])->name('voitures.create');

// Traiter la soumission du formulaire
Route::post('/voitures', [VoitureController::class, 'store'])->name('voitures.store');
Route::get('/voitures', [VoitureController::class, 'index'])->name('voitures.index');
// Afficher les détails d'une voiture
Route::get('/voitures/{voiture}', [VoitureController::class, 'show'])->name('voitures.show');
// Afficher le formulaire d'édition
Route::get('/voitures/{voiture}/edit', [VoitureController::class, 'edit'])->name('voitures.edit');
// Traiter la mise à jour
Route::put('/voitures/{voiture}', [VoitureController::class, 'update'])->name('voitures.update');
// Suppression d'une voiture
Route::delete('/voitures/{voiture}', [VoitureController::class, 'destroy'])->name('voitures.destroy');
Route::post('/reservations/{reservation}/approve', [ReservationController::class, 'approve'])->name('reservations.approve');
Route::post('/reservations/{reservation}/reject', [ReservationController::class, 'reject'])->name('reservations.reject');
Route::get('/voitures/{voiture}/reservations/create', [ReservationController::class, 'create'])
    ->name('reservations.create');
    Route::get('/reservations', [ReservationController::class, 'index'])
    ->name('reservations.index');
    Route::post('/voitures/{voiture}/reservations/', [ReservationController::class, 'store'])
    ->name('reservations.store');
    // ->middleware('auth'); // Protection par authentification
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

    