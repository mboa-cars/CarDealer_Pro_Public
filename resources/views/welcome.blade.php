@extends('layouts.app')

@section('content')
<div class="row align-items-center bg-white rounded-4 shadow-sm p-4 mb-4" style="min-height:340px;">
    <div class="col-md-6">
        <h1 class="fw-bold" style="font-size:2.5rem;">
            Buy <span style="color:#F26522">The Best Vehicles</span><br>in your region
        </h1>
        <p class="text-secondary mb-4">
            Use powerful search tool to find your desired cars<br>
            based on multiple search criteria: Make, Model, Year,<br>
            Price Range, Car Type, etc...
        </p>
        <a href="/cars" class="btn btn-orange btn-lg px-4">Find the car</a>
    </div>
    <div class="col-md-6 text-center">
        <img src="images/car-png-39071.png" alt="Car" class="img-fluid" style="max-height:320px;">
    </div>
</div>

<div id="search" class="bg-light rounded-4 p-4 mb-4 shadow-sm">
    <form class="row g-2 align-items-end" method="GET" action="{{ route('cars.index') }}">
        <div class="col-md-2">
            <label class="form-label">Maker</label>
            <select class="form-select" name="brand">
                <option value="">Maker</option>
                @isset($brands)
                    @foreach($brands as $brand)
                        <option value="{{ $brand }}">{{ $brand }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label">Model</label>
            <select class="form-select" name="model">
                <option value="">Model</option>
                @isset($models)
                    @foreach($models as $model)
                        <option value="{{ $model }}">{{ $model }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label">State/Region</label>
            <select class="form-select" name="state">
                <option value="">State/Region</option>
                @isset($states)
                    @foreach($states as $state)
                        <option value="{{ $state }}">{{ $state }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label">City</label>
            <select class="form-select" name="city">
                <option value="">City</option>
                @isset($cities)
                    @foreach($cities as $city)
                        <option value="{{ $city }}">{{ $city }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label">Type</label>
            <select class="form-select" name="type">
                <option value="">Type</option>
                @isset($types)
                    @foreach($types as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="col-md-2 d-flex gap-2">
            <a href="/" class="btn btn-outline-secondary" style="flex:1;">Reset</a>
            <button type="submit" class="btn btn-orange" style="flex:1;">Search</button>
        </div>
        <div class="col-md-2">
            <label class="form-label">Year From</label>
            <input type="number" class="form-control" placeholder="Year From" name="year_from">
        </div>
        <div class="col-md-2">
            <label class="form-label">Year To</label>
            <input type="number" class="form-control" placeholder="Year To" name="year_to">
        </div>
        <div class="col-md-2">
            <label class="form-label">Price From</label>
            <input type="number" class="form-control" placeholder="Price From" name="price_from">
        </div>
        <div class="col-md-2">
            <label class="form-label">Price To</label>
            <input type="number" class="form-control" placeholder="Price To" name="price_to">
        </div>
    </form>
</div>

<h4 class="fw-bold mb-3">Latest Added Cars</h4>
<div class="mb-2 text-end" style="font-size:1rem; color:#444;">
    Showing <span style="color:#F26522;">{{ $latestCars->firstItem() }}</span> to <span style="color:#F26522;">{{ $latestCars->lastItem() }}</span> of <span style="color:#F26522;">{{ $latestCars->total() }}</span> cars
</div>
<div class="row g-3">
    @foreach($latestCars as $car)
        <div class="col-md-3">
            <div class="card p-2 h-100">
                @if($car->main_image)
                    <img src="{{ $car->main_image }}" class="card-img-top rounded-3" alt="Car">
                @else
                    <div class="card-img-top rounded-3 d-flex align-items-center justify-content-center" style="height: 200px; background-color: #f8f9fa; color: #6c757d;">
                        <i class="fas fa-car fa-3x"></i>
                    </div>
                @endif
                <div class="card-body">
                    <div class="text-muted small">{{ $car->city ?? '-' }}</div>
                    <div class="fw-bold">{{ $car->year ?? '-' }} - {{ $car->brand ?? '-' }} {{ $car->model ?? '-' }}</div>
                    <div class="fw-bold mb-2" style="color:#F26522;">${{ isset($car->price) ? number_format($car->price, 0, '', ' ') : '-' }}</div>
                    @if(!empty($car->type))
                        <span class="badge bg-light text-dark border me-1">{{ $car->type }}</span>
                    @endif
                    @if(!empty($car->fuel_type))
                        <span class="badge bg-light text-dark border">{{ $car->fuel_type }}</span>
                    @endif
                    <span class="float-end" style="color:#F26522;font-size:1.3rem;cursor:pointer;">&#9825;</span>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="mt-3 d-flex justify-content-center">
    <div style="font-size:0.95rem;">
        {{ $latestCars->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection 
