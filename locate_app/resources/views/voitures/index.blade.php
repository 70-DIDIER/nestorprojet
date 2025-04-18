@extends('layouts.app')

@section('title', 'Liste des voitures')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">
            <i class="fas fa-car me-2"></i>Nos véhicules
        </h1>
        <a href="{{ route('voitures.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Ajouter
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            @if($voitures->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-car-side fa-4x text-muted mb-3"></i>
                    <h4>Aucun véhicule disponible</h4>
                    <p class="text-muted">Commencez par ajouter votre premier véhicule</p>
                    <a href="{{ route('voitures.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Ajouter une voiture
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Photo</th>
                                <th>Marque/Modèle</th>
                                <th>Année</th>
                                <th>Prix/jour</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($voitures as $voiture)
                            <tr>
                                <td>
                                    @if($voiture->photo)
                                        <div style="width: 100px; height: 75px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                                            <img src="{{ asset('storage/'.$voiture->photo) }}" 
                                                 alt="{{ $voiture->marque }}"
                                                 style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                        </div>
                                    @else
                                        <div style="width: 100px; height: 75px; background: #f8f9fa; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-car text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $voiture->marque }}</strong><br>
                                    <small class="text-muted">{{ $voiture->modele }}</small>
                                </td>
                                <td>{{ $voiture->annee }}</td>
                                <td>{{ number_format($voiture->prix_journalier, 2) }} €</td>
                                <td>
                                    <span class="badge bg-{{ $voiture->disponible ? 'success' : 'danger' }}">
                                        {{ $voiture->disponible ? 'Disponible' : 'Indisponible' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('voitures.show', $voiture) }}" 
                                           class="btn btn-sm btn-outline-primary"
                                           title="Voir détails">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('voitures.edit', $voiture) }}" 
                                           class="btn btn-sm btn-outline-secondary"
                                           title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('voitures.destroy', $voiture) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette voiture ?')">
                                                <i class="fas fa-trash"></i> Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($voitures->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $voitures->links() }}
                </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection