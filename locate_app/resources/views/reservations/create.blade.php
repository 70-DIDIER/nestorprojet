@extends('layouts.app')

@section('title', 'Réserver ' . $voiture->marque)

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-calendar-check me-2"></i>Réserver : {{ $voiture->marque }} {{ $voiture->modele }}
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('reservations.store', $voiture) }}" method="POST">
                @csrf

                <div class="row g-3">
                    <!-- Dates -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date_debut" class="form-label required">Date de début</label>
                            <input type="date" 
                                   class="form-control @error('date_debut') is-invalid @enderror" 
                                   id="date_debut" 
                                   name="date_debut" 
                                   min="{{ date('Y-m-d') }}" 
                                   value="{{ old('date_debut') }}" 
                                   required>
                            @error('date_debut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date_fin" class="form-label required">Date de fin</label>
                            <input type="date" 
                                   class="form-control @error('date_fin') is-invalid @enderror" 
                                   id="date_fin" 
                                   name="date_fin" 
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}" 
                                   value="{{ old('date_fin') }}" 
                                   required>
                            @error('date_fin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Affichage du prix estimé -->
                <div class="alert alert-info mt-3">
                    <div class="d-flex justify-content-between">
                        <span>Prix journalier :</span>
                        <strong>{{ number_format($voiture->prix_journalier, 2) }} €</strong>
                    </div>
                    <div class="d-flex justify-content-between mt-1">
                        <span>Total estimé :</span>
                        <strong id="prix-total">-- €</strong>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('voitures.show', $voiture) }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Retour
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check-circle me-1"></i> Confirmer la réservation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script pour calcul dynamique -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateDebut = document.getElementById('date_debut');
    const dateFin = document.getElementById('date_fin');
    const prixTotal = document.getElementById('prix-total');
    const prixJournalier = {{ $voiture->prix_journalier }};

    function calculerTotal() {
        if (dateDebut.value && dateFin.value) {
            const debut = new Date(dateDebut.value);
            const fin = new Date(dateFin.value);
            const jours = (fin - debut) / (1000 * 60 * 60 * 24);
            prixTotal.textContent = (jours * prixJournalier).toFixed(2) + ' €';
        }
    }

    dateDebut.addEventListener('change', function() {
        dateFin.min = this.value;
        calculerTotal();
    });

    dateFin.addEventListener('change', calculerTotal);
});
</script>

<style>
.required:after {
    content: " *";
    color: red;
}
</style>
@endsection