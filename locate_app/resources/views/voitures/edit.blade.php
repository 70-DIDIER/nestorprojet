@extends('layouts.app')

@section('title', 'Modifier '.$voiture->marque)

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-edit me-2"></i>Modifier {{ $voiture->marque }} {{ $voiture->modele }}
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('voitures.update', $voiture) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Section Photo -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Photo actuelle</label>
                            <div class="border p-2 text-center">
                                <img src="{{ asset('storage/'.$voiture->photo) }}" 
                                     alt="{{ $voiture->marque }}" 
                                     class="img-fluid rounded" 
                                     style="max-height: 200px">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="photo" class="form-label">Changer la photo</label>
                            <input type="file" class="form-control" id="photo" name="photo"
                                   accept="image/jpeg,image/png">
                            <small class="text-muted">Laisser vide pour conserver l'actuelle</small>
                        </div>
                    </div>
                </div>

                <!-- Section Informations -->
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="marque" class="form-label required">Marque</label>
                            <input type="text" class="form-control @error('marque') is-invalid @enderror" 
                                   id="marque" name="marque" 
                                   value="{{ old('marque', $voiture->marque) }}" required>
                            @error('marque')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="modele" class="form-label required">Modèle</label>
                            <input type="text" class="form-control @error('modele') is-invalid @enderror" 
                                   id="modele" name="modele" 
                                   value="{{ old('modele', $voiture->modele) }}" required>
                            @error('modele')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="annee" class="form-label required">Année</label>
                            <input type="number" class="form-control @error('annee') is-invalid @enderror" 
                                   id="annee" name="annee" 
                                   min="2000" max="{{ date('Y')+1 }}"
                                   value="{{ old('annee', $voiture->annee) }}" required>
                            @error('annee')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="carburant" class="form-label required">Carburant</label>
                            <select class="form-select @error('carburant') is-invalid @enderror" 
                                    id="carburant" name="carburant" required>
                                <option value="">Sélectionner...</option>
                                <option value="Essence" {{ old('carburant', $voiture->carburant) == 'Essence' ? 'selected' : '' }}>Essence</option>
                                <option value="Diesel" {{ old('carburant', $voiture->carburant) == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                <option value="Electrique" {{ old('carburant', $voiture->carburant) == 'Electrique' ? 'selected' : '' }}>Électrique</option>
                                <option value="Hybride" {{ old('carburant', $voiture->carburant) == 'Hybride' ? 'selected' : '' }}>Hybride</option>
                            </select>
                            @error('carburant')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="prix_journalier" class="form-label required">Prix journalier (€)</label>
                            <div class="input-group">
                                <input type="number" step="0.01" 
                                       class="form-control @error('prix_journalier') is-invalid @enderror" 
                                       id="prix_journalier" name="prix_journalier" 
                                       min="10" value="{{ old('prix_journalier', $voiture->prix_journalier) }}" required>
                                <span class="input-group-text">€/jour</span>
                                @error('prix_journalier')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Statut -->
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="disponible" 
                               name="disponible" value="1"
                               {{ old('disponible', $voiture->disponible) ? 'checked' : '' }}>
                        <label class="form-check-label" for="disponible">Disponible immédiatement</label>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('voitures.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i> Annuler
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .required:after {
        content: " *";
        color: red;
    }
    .card-header h5 {
        font-size: 1.25rem;
    }
</style>
@endsection