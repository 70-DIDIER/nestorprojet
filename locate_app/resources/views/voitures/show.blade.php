@extends('layouts.app')

@section('title', $voiture->marque.' '.$voiture->modele)

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <!-- Colonne Photo -->
                <div class="col-md-6">
                    <div class="position-relative">
                        <img src="{{ asset('storage/'.$voiture->photo) }}" 
                             alt="{{ $voiture->marque }}"
                             class="img-fluid rounded mb-3">
                        
                        <!-- Badge de statut sur l'image -->
                        <span class="position-absolute top-0 start-0 m-2 badge bg-{{ $voiture->disponible ? 'success' : 'danger' }}">
                            {{ $voiture->disponible ? 'Disponible' : 'Indisponible' }}
                        </span>
                    </div>
                </div>

                <!-- Colonne Détails -->
                <div class="col-md-6">
                    <h2 class="mb-3">{{ $voiture->marque }} {{ $voiture->modele }}</h2>
                    
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><strong>Année :</strong></span>
                            <span>{{ $voiture->annee }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><strong>Prix journalier :</strong></span>
                            <span class="text-primary fw-bold">{{ number_format($voiture->prix_journalier, 2) }} €</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><strong>Carburant :</strong></span>
                            <span>{{ $voiture->carburant }}</span>
                        </li>
                    </ul>

                    <!-- Boutons d'action -->
                    <div class="d-grid gap-3">
                        @if($voiture->disponible)
                            <a href="{{ route('reservations.create', $voiture) }}" 
                               class="btn btn-success btn-lg py-3">
                                <i class="fas fa-calendar-check me-2"></i>Réserver maintenant
                            </a>
                        @else
                            <button class="btn btn-secondary btn-lg py-3" disabled>
                                <i class="fas fa-times-circle me-2"></i>Non disponible
                            </button>
                        @endif
                        
                        <div class="d-flex gap-2">
                            <a href="{{ route('voitures.edit', $voiture) }}" 
                               class="btn btn-outline-primary flex-grow-1">
                                <i class="fas fa-edit me-1"></i> Modifier
                            </a>
                            <a href="{{ route('voitures.index') }}" 
                               class="btn btn-outline-secondary flex-grow-1">
                                <i class="fas fa-list me-1"></i> Retour
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection