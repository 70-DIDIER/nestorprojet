@extends('layouts.app')

@section('title', $voiture->marque.' '.$voiture->modele)

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('storage/'.$voiture->photo) }}" 
                         alt="{{ $voiture->marque }}"
                         class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                    <h2>{{ $voiture->marque }} {{ $voiture->modele }}</h2>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Année :</strong> {{ $voiture->annee }}
                        </li>
                        <li class="list-group-item">
                            <strong>Prix journalier :</strong> 
                            {{ number_format($voiture->prix_journalier, 2) }} €
                        </li>
                        <li class="list-group-item">
                            <strong>Carburant :</strong> {{ $voiture->carburant }}
                        </li>
                        <li class="list-group-item">
                            <strong>Statut :</strong>
                            <span class="badge bg-{{ $voiture->disponible ? 'success' : 'danger' }}">
                                {{ $voiture->disponible ? 'Disponible' : 'Indisponible' }}
                            </span>
                        </li>
                    </ul>
                    <a href="{{ route('voitures.index') }}" class="btn btn-primary mt-3">
                        Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection