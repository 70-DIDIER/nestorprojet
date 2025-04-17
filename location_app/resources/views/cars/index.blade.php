@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des voitures</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('cars.create') }}" class="btn btn-primary mb-3">Ajouter une voiture</a>

    <div class="row">
        @foreach($cars as $car)
            <div class="col-md-4 mb-3">
                <div class="card">
                    @if($car->image)
                        <img src="{{ asset('storage/' . $car->image) }}" class="card-img-top" alt="{{ $car->model }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->brand }} {{ $car->model }}</h5>
                        <p>{{ $car->description }}</p>
                        <p><strong>{{ $car->price_per_day }} FCFA / jour</strong></p>
                        <a href="{{ route('bookings.create', $car->id) }}" class="btn btn-success">Réserver</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
