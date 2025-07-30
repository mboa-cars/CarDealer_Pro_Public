@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="row align-items-center bg-white rounded-4 shadow-sm p-5 mb-5 position-relative" style="min-height:400px; background: linear-gradient(135deg, #fff 0%, #fff8f0 100%); border: 1px solid #f0f0f0;">
    
    <div class="col-md-6">
        <h1 class="fw-bold mb-4" style="font-size:3rem; line-height: 1.2;">
            Buy <span style="color:#F26522">The Best Vehicles</span><br>
            <span style="color:#333;">in your region</span>
        </h1>
        <p class="text-secondary mb-4" style="font-size: 1.1rem; line-height: 1.6;">
            Use powerful search tool to find your desired cars<br>
            based on multiple search criteria: Make, Model, Year,<br>
            Price Range, Car Type, etc...
        </p>
        <a href="/cars" class="btn btn-lg px-5 py-3" style="background: #F26522; color: white; border: none; border-radius: 30px; font-weight: 600; text-decoration: none; box-shadow: 0 4px 15px rgba(242, 101, 34, 0.3);">
            Find the car
        </a>
    </div>
    <div class="col-md-6 text-center">
        <img src="images/car-png-39071.png" alt="Car" class="img-fluid" style="max-height:350px; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.1));">
    </div>
</div>

<!-- Search Section -->
<div id="search" class="bg-white rounded-4 p-5 mb-5 shadow-sm" style="border: 1px solid #f0f0f0; background: #f8f9fa;">
    <form class="row g-3 align-items-end" method="GET" action="{{ route('cars.index') }}">
        <div class="col-md-2">
            <label class="form-label fw-semibold" style="color: #555;">Maker</label>
            <select class="form-select" name="brand" style="border-color: #ddd; border-radius: 8px;">
                <option value="">Maker</option>
                @isset($brands)
                    @foreach($brands as $brand)
                        <option value="{{ $brand }}">{{ $brand }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold" style="color: #555;">Model</label>
            <select class="form-select" name="model" style="border-color: #ddd; border-radius: 8px;">
                <option value="">Model</option>
                @isset($models)
                    @foreach($models as $model)
                        <option value="{{ $model }}">{{ $model }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold" style="color: #555;">State/Region</label>
            <select class="form-select" name="state" style="border-color: #ddd; border-radius: 8px;">
                <option value="">State/Region</option>
                @isset($states)
                    @foreach($states as $state)
                        <option value="{{ $state }}">{{ $state }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold" style="color: #555;">City</label>
            <select class="form-select" name="city" style="border-color: #ddd; border-radius: 8px;">
                <option value="">City</option>
                @isset($cities)
                    @foreach($cities as $city)
                        <option value="{{ $city }}">{{ $city }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold" style="color: #555;">Type</label>
            <select class="form-select" name="type" style="border-color: #ddd; border-radius: 8px;">
                <option value="">Type</option>
                @isset($types)
                    @foreach($types as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="col-md-2 d-flex gap-2">
            <a href="/" class="btn" style="background: #f8f9fa; color: #666; border: 1px solid #ddd; border-radius: 8px; font-weight: 500; flex: 1;">Reset</a>
            <button type="submit" class="btn" style="background: #F26522; color: white; border: none; border-radius: 8px; font-weight: 500; flex: 1;">Search</button>
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold" style="color: #555;">Year From</label>
            <input type="number" class="form-control" placeholder="Year From" name="year_from" style="border-color: #ddd; border-radius: 8px;">
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold" style="color: #555;">Year To</label>
            <input type="number" class="form-control" placeholder="Year To" name="year_to" style="border-color: #ddd; border-radius: 8px;">
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold" style="color: #555;">Price From</label>
            <input type="number" class="form-control" placeholder="Price From" name="price_from" style="border-color: #ddd; border-radius: 8px;">
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold" style="color: #555;">Price To</label>
            <input type="number" class="form-control" placeholder="Price To" name="price_to" style="border-color: #ddd; border-radius: 8px;">
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold" style="color: #555;">Fuel Type</label>
            <select class="form-select" name="fuel_type" style="border-color: #ddd; border-radius: 8px;">
                <option value="">Fuel Type</option>
                @isset($fuel_types)
                    @foreach($fuel_types as $fuel_type)
                        <option value="{{ $fuel_type }}">{{ $fuel_type }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
    </form>
</div>

<!-- Latest Cars Section -->
<div class="mb-4">
    <h4 class="fw-bold mb-3" style="color: #333; font-size: 1.8rem;">
        <i class="fas fa-star me-2" style="color: #F26522;"></i>
        Latest Added Cars
    </h4>
    <div class="mb-3 text-end" style="font-size:1rem; color:#666;">
        Showing <span style="color:#F26522; font-weight: 600;">{{ $latestCars->firstItem() }}</span> to <span style="color:#F26522; font-weight: 600;">{{ $latestCars->lastItem() }}</span> of <span style="color:#F26522; font-weight: 600;">{{ $latestCars->total() }}</span> cars
    </div>
</div>

<div class="row g-3">
    @foreach($latestCars as $car)
        @include('components.car-card', ['car' => $car])
    @endforeach
</div>

<div class="mt-4 d-flex justify-content-center">
    <div style="font-size:0.95rem;">
        {{ $latestCars->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>
</div>

<style>
/* Styles personnalisés pour la pagination */
.pagination .page-item.active .page-link {
    background-color: #F26522 !important;
    border-color: #F26522 !important;
    color: white !important;
}

.pagination .page-link {
    color: #F26522 !important;
    border-radius: 8px !important;
}

.pagination .page-link:hover {
    background-color: #ffe5d0 !important;
    color: #F26522 !important;
}


</style>
@endsection 
