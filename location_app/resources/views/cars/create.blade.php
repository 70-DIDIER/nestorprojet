@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter une voiture</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Marque</label>
            <input type="text" name="brand" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Modèle</label>
            <input type="text" name="model" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Matricule</label>
            <input type="text" name="registration" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Prix par jour (FCFA)</label>
            <input type="number" name="price_per_day" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection
