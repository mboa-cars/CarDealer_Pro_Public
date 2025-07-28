@extends('layouts.app')

@section('content')
<div class="bg-white rounded-4 shadow-sm p-4 mb-4 mx-auto" style="max-width:900px;">
    <h2 class="fw-bold mb-4">My Favourite Cars</h2>
    <div class="row g-3">
        @forelse($cars as $car)
            <div class="col-md-4">
                <div class="card p-2 h-100">
                    @if($car->main_image)
                        <img src="{{ $car->main_image }}" class="card-img-top rounded-3" alt="Car">
                    @else
                        <div class="card-img-top rounded-3 d-flex align-items-center justify-content-center" style="height: 200px; background-color: #f8f9fa; color: #6c757d;">
                            <i class="fas fa-car fa-3x"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="text-muted small">{{ $car->city ?? 'City' }}</div>
                        <div class="fw-bold">{{ $car->year }} - {{ $car->brand }} {{ $car->model }}</div>
                        <div class="fw-bold mb-2" style="color:#F26522;">${{ number_format($car->price, 0, '', ',') }}</div>
                        <span class="badge bg-light text-dark border me-1">{{ $car->type ?? 'SUV' }}</span>
                        <span class="badge bg-light text-dark border">{{ $car->fuel_type ?? 'Hybrid' }}</span>
                        <span class="float-end" style="color:#F26522;font-size:1.3rem;">&#10084;</span>
                        <a href="{{ route('cars.show', $car->id) }}" class="btn btn-sm btn-outline-primary mt-2">Voir</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Vous n'avez pas encore de voitures en favoris.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection 