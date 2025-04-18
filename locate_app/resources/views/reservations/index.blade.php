@extends('layouts.app')

@section('title', 'Liste des réservations')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">
            <i class="fas fa-calendar-alt me-2"></i>Liste des réservations
        </h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            @if($reservations->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                    <h4>Aucune réservation enregistrée</h4>
                    <p class="text-muted">Aucun client n'a encore effectué de réservation</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Client</th>
                                <th>Véhicule</th>
                                <th>Dates</th>
                                <th>Prix total</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservations as $reservation)
                            <tr>
                                <td>
                                    <strong>{{ $reservation->user->name }}</strong><br>
                                    <small class="text-muted">{{ $reservation->user->email }}</small>
                                </td>
                                <td>
                                    <strong>{{ $reservation->voiture->marque }}</strong><br>
                                    <small class="text-muted">{{ $reservation->voiture->modele }}</small>
                                </td>
                                <td>
                                    <strong>{{ $reservation->date_debut->format('d/m/Y') }}</strong><br>
                                    <small class="text-muted">au {{ $reservation->date_fin->format('d/m/Y') }}</small>
                                </td>
                                <td>{{ number_format($reservation->prix_total, 2) }} €</td>
                                <td>
                                    @php
                                        $statusColors = [
                                            'en_attente' => 'warning',
                                            'approuvee' => 'success',
                                            'rejetee' => 'danger'
                                        ];
                                        $statusLabels = [
                                            'en_attente' => 'En attente',
                                            'approuvee' => 'Approuvée',
                                            'rejetee' => 'Rejetée'
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $statusColors[$reservation->statut] ?? 'secondary' }}">
                                        {{ $statusLabels[$reservation->statut] ?? ucfirst($reservation->statut) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        @if($reservation->statut === 'en_attente')
                                        <form action="{{ route('reservations.approve', $reservation) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm px-3">
                                                <i class="fas fa-check me-1"></i> Approuver
                                            </button>
                                        </form>
                                        <form action="{{ route('reservations.reject', $reservation) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm px-3">
                                                <i class="fas fa-times me-1"></i> Rejeter
                                            </button>
                                        </form>
                                        @else
                                        <span class="text-muted align-self-center">Aucune action</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($reservations->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $reservations->links() }}
                </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .btn-sm {
        min-width: 110px;
        white-space: nowrap;
    }
    @media (max-width: 768px) {
        .btn-sm {
            min-width: auto;
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
        }
        .btn-sm i {
            margin-right: 0 !important;
        }
        .btn-sm span {
            display: none;
        }
    }
</style>
@endsection