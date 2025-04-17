<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoitureController;

Route::get('/', function () {
    return view('welcome');
});


// Afficher le formulaire
Route::get('/voitures/create', [VoitureController::class, 'create'])->name('voitures.create');

// Traiter la soumission du formulaire
Route::post('/voitures', [VoitureController::class, 'store'])->name('voitures.store');
Route::get('/voitures', [VoitureController::class, 'index'])->name('voitures.index');
Route::get('/voitures', [VoitureController::class, 'index'])->name('voitures.index');
// Afficher les détails d'une voiture
Route::get('/voitures/{voiture}', [VoitureController::class, 'show'])->name('voitures.show');
// Afficher le formulaire d'édition
Route::get('/voitures/{voiture}/edit', [VoitureController::class, 'edit'])->name('voitures.edit');
// Traiter la mise à jour
Route::put('/voitures/{voiture}', [VoitureController::class, 'update'])->name('voitures.update');
// Suppression d'une voiture
Route::delete('/voitures/{voiture}', [VoitureController::class, 'destroy'])->name('voitures.destroy');