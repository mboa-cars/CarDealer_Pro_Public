@extends('layouts.app')

@section('content')
@php
    $user = Auth::user();
@endphp
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
    <!-- Filtres à gauche -->
    <div class="col-md-3 mb-4">
        <div class="bg-white rounded-4 p-4 shadow-sm mb-3">
            <h5 class="fw-bold mb-3">Define your search criteria</h5>
            <form method="GET" action="{{ route('cars.index') }}">
                <div class="mb-2">
                    <label class="form-label">Maker</label>
                    <select class="form-select" name="brand">
                        <option value="">Maker</option>
                        @isset($brands)
                            @foreach($brands as $brand)
                                <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label">Model</label>
                    <select class="form-select" name="model">
                        <option value="">Model</option>
                        @isset($models)
                            @foreach($models as $model)
                                <option value="{{ $model }}" {{ request('model') == $model ? 'selected' : '' }}>{{ $model }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label">Type</label>
                    <select class="form-select" name="type">
                        <option value="">Type</option>
                        @isset($types)
                            @foreach($types as $type)
                                <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="mb-2 row g-2">
                    <div class="col">
                        <input type="number" class="form-control" placeholder="Year From" name="year_from" value="{{ request('year_from') }}">
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" placeholder="Year To" name="year_to" value="{{ request('year_to') }}">
                    </div>
                </div>
                <div class="mb-2 row g-2">
                    <div class="col">
                        <input type="number" class="form-control" placeholder="Price From" name="price_from" value="{{ request('price_from') }}">
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" placeholder="Price To" name="price_to" value="{{ request('price_to') }}">
                    </div>
                </div>
                <div class="mb-2">
                    <label class="form-label">Mileage</label>
                    <select class="form-select" name="mileage">
                        <option value="">Any Mileage</option>
                        @isset($mileages)
                            @foreach($mileages as $mileage)
                                <option value="{{ $mileage }}" {{ request('mileage') == $mileage ? 'selected' : '' }}>{{ $mileage }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label">State/Region</label>
                    <select class="form-select" name="state">
                        <option value="">State/Region</option>
                        @isset($states)
                            @foreach($states as $state)
                                <option value="{{ $state }}" {{ request('state') == $state ? 'selected' : '' }}>{{ $state }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label">City</label>
                    <select class="form-select" name="city">
                        <option value="">City</option>
                        @isset($cities)
                            @foreach($cities as $city)
                                <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label">Fuel Type</label>
                    <select class="form-select" name="fuel_type">
                        <option value="">Fuel Type</option>
                        @isset($fuel_types)
                            @foreach($fuel_types as $fuel_type)
                                <option value="{{ $fuel_type }}" {{ request('fuel_type') == $fuel_type ? 'selected' : '' }}>{{ $fuel_type }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <button type="reset" style="flex:1; background:#f3f3f3; color:#444; border:none; border-radius:14px; padding:14px 0; font-size:1.1rem; font-weight:500; box-shadow:0 2px 8px #0001; transition:background 0.2s;" onmouseover="this.style.background='#e0e0e0'" onmouseout="this.style.background='#f3f3f3'">Reset</button>
                    <button type="submit" style="flex:1; background:#ea6500; color:#fff; border:none; border-radius:14px; padding:14px 0; font-size:1.1rem; font-weight:500; box-shadow:0 2px 8px #0001; transition:background 0.2s;" onmouseover="this.style.background='#d35400'" onmouseout="this.style.background='#ea6500'">Search</button>
                </div>
            </form>
        </div>
        <div class="bg-white rounded-4 p-3 shadow-sm text-center">
            <div class="fw-bold">Found <span style="color:#F26522;">{{ $cars->count() }}</span> cars</div>
        </div>
    </div>
    <!-- Grille de voitures -->
    <div class="col-md-9">
        <div class="d-flex justify-content-end mb-3">
            <select class="form-select w-auto">
                <option>Order By</option>
            </select>
        </div>
        <div class="row g-3">
            @foreach($cars as $car)
                <div class="col-md-3">
                    <div class="card p-2 h-100">
                        <a href="{{ route('cars.show', $car->id) }}" style="text-decoration: none; color: inherit;">
                            @if($car->main_image)
                                <img src="{{ $car->main_image }}" class="card-img-top rounded-3" alt="Car" style="cursor: pointer; transition: transform 0.2s; height: 200px; object-fit: cover;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                            @else
                                <div class="card-img-top rounded-3 d-flex align-items-center justify-content-center" style="height: 200px; background-color: #f8f9fa; color: #6c757d;">
                                    <i class="fas fa-car fa-3x"></i>
                                </div>
                            @endif
                        </a>
                        <div class="card-body">
                            <div class="text-muted small">{{ $car->city ?? '-' }}</div>
                            <a href="{{ route('cars.show', $car->id) }}" style="text-decoration: none; color: inherit;">
                                <div class="fw-bold" style="cursor: pointer; transition: color 0.2s;" onmouseover="this.style.color='#F26522'" onmouseout="this.style.color='inherit'">{{ $car->year ?? '-' }} - {{ $car->brand ?? '-' }} {{ $car->model ?? '-' }}</div>
                            </a>
                            <div class="fw-bold mb-2" style="color:#F26522;">${{ isset($car->price) ? number_format($car->price, 0, '', ' ') : '-' }}</div>
                            @if(!empty($car->type))
                                <span class="badge bg-light text-dark border me-1">{{ $car->type }}</span>
                            @endif
                            @if(!empty($car->fuel_type))
                                <span class="badge bg-light text-dark border">{{ $car->fuel_type }}</span>
                            @endif
                            @auth
                                @php
                                    $isFavorited = in_array($car->id, $carsFavorited ?? []);
                                @endphp
                                <form method="POST" action="{{ $isFavorited ? route('cars.unfavorite', $car->id) : route('cars.favorite', $car->id) }}" class="d-inline favorite-form" data-car-id="{{ $car->id }}">
                                    @csrf
                                    @if($isFavorited)
                                        @method('DELETE')
                                    @endif
                                    <button type="submit" class="btn p-0 border-0 bg-transparent favorite-btn" style="color:#F26522;font-size:1.3rem;cursor:pointer;">
                                        {!! $isFavorited ? '&#9829;' : '&#9825;' !!}
                                    </button>
                                </form>
                            @else
                                <span style="color:#F26522;font-size:1.3rem;cursor:pointer;">&#9825;</span>
                            @endauth
                            <div class="mt-2">
                                <a href="{{ route('cars.show', $car->id) }}" class="btn btn-outline-primary btn-sm w-100" style="border-color:#F26522; color:#F26522;" onmouseover="this.style.background='#F26522'; this.style.color='white'" onmouseout="this.style.background='transparent'; this.style.color='#F26522'">
                                    Voir détails
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-3 d-flex justify-content-center">
            <div style="font-size:0.95rem;">
                {{ $cars->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.pagination .page-item.active .page-link {
    background-color: #F26522;
    border-color: #F26522;
    color: #fff;
}
.pagination .page-link {
    color: #F26522;
    border-radius: 8px;
}
.pagination .page-link:hover {
    background-color: #ffe5d0;
    color: #F26522;
}
</style>
@endpush

<script>
document.querySelectorAll('.favorite-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = this;
        const button = this.querySelector('.favorite-btn');
        const originalContent = button.innerHTML;
        
        // Désactiver le bouton pendant la requête
        button.disabled = true;
        button.innerHTML = '...';
        
        fetch(this.action, {
            method: this.querySelector('input[name=_method]')?.value === 'DELETE' ? 'DELETE' : 'POST',
            headers: {
                'X-CSRF-TOKEN': this.querySelector('input[name=_token]').value,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            // Mettre à jour l'icône
            if (data.isFavorited) {
                button.innerHTML = '&#9829;';
                button.style.color = '#F26522';
                showNotification('Ajouté aux favoris !', 'success');
            } else {
                button.innerHTML = '&#9825;';
                button.style.color = '#F26522';
                showNotification('Retiré des favoris !', 'info');
            }
            
            // Mettre à jour l'action du formulaire
            if (data.isFavorited) {
                formData.action = formData.action.replace('/favorite', '/favorite');
                formData.querySelector('input[name=_method]').value = 'DELETE';
            } else {
                formData.action = formData.action.replace('/favorite', '/favorite');
                formData.querySelector('input[name=_method]').remove();
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            button.innerHTML = originalContent;
            showNotification('Erreur lors de l\'opération', 'error');
        })
        .finally(() => {
            button.disabled = false;
        });
    });
});

function showNotification(message, type) {
    // Créer une notification temporaire
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'} position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = message;
    
    document.body.appendChild(notification);
    
    // Supprimer la notification après 3 secondes
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script> 