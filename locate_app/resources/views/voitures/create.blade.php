@extends('layouts.app')

@section('title', 'Ajouter une voiture')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-car"></i> Nouveau véhicule
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('voitures.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf

                        <!-- Marque et Modèle -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="marque" class="form-label required">Marque</label>
                                    <input type="text" class="form-control @error('marque') is-invalid @enderror" 
                                           id="marque" name="marque" value="{{ old('marque') }}" required>
                                    @error('marque')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="modele" class="form-label required">Modèle</label>
                                    <input type="text" class="form-control @error('modele') is-invalid @enderror" 
                                           id="modele" name="modele" value="{{ old('modele') }}" required>
                                    @error('modele')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Année et Carburant -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="annee" class="form-label required">Année</label>
                                    <input type="number" class="form-control @error('annee') is-invalid @enderror" 
                                           id="annee" name="annee" min="2000" max="{{ date('Y') }}" 
                                           value="{{ old('annee') }}" required>
                                    @error('annee')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="carburant" class="form-label required">Carburant</label>
                                    <select class="form-select @error('carburant') is-invalid @enderror" 
                                            id="carburant" name="carburant" required>
                                        <option value="">Sélectionnez...</option>
                                        <option value="Essence" {{ old('carburant') == 'Essence' ? 'selected' : '' }}>Essence</option>
                                        <option value="Diesel" {{ old('carburant') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                        <option value="Electrique" {{ old('carburant') == 'Electrique' ? 'selected' : '' }}>Électrique</option>
                                        <option value="Hybride" {{ old('carburant') == 'Hybride' ? 'selected' : '' }}>Hybride</option>
                                    </select>
                                    @error('carburant')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Prix et Photo -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="prix_journalier" class="form-label required">Prix journalier (€)</label>
                                    <div class="input-group">
                                        <input type="number" step="0.01" class="form-control @error('prix_journalier') is-invalid @enderror" 
                                               id="prix_journalier" name="prix_journalier" min="10" 
                                               value="{{ old('prix_journalier') }}" required>
                                        <span class="input-group-text">€/jour</span>
                                    </div>
                                    @error('prix_journalier')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="photo" class="form-label required">Photo</label>
                                    <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                                           id="photo" name="photo" accept="image/jpeg,image/png" required>
                                    @error('photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Formats acceptés : JPEG, PNG (max 2MB)</small>
                                </div>
                            </div>
                        </div>

                        <!-- Disponibilité -->
                        <div class="form-group mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="disponible" 
                                       name="disponible" {{ old('disponible', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="disponible">Disponible immédiatement</label>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('voitures.index') }}" class="btn btn-outline-secondary me-md-2">
                                <i class="fas fa-times"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection