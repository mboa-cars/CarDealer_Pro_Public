@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0">Add New Car</h2>
                <a href="{{ route('cars.my-cars') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to My Cars
                </a>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <!-- Car Specifications Form -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Car Specifications</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="brand" class="form-label">Maker</label>
                                        <select class="form-select" id="brand" name="brand" required>
                                            <option value="">Select Maker</option>
                                            <option value="Lexus">Lexus</option>
                                            <option value="BMW">BMW</option>
                                            <option value="Mercedes">Mercedes</option>
                                            <option value="Audi">Audi</option>
                                            <option value="Toyota">Toyota</option>
                                            <option value="Honda">Honda</option>
                                            <option value="Ford">Ford</option>
                                            <option value="Chevrolet">Chevrolet</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="model" class="form-label">Model</label>
                                        <select class="form-select" id="model" name="model" required>
                                            <option value="">Select Model</option>
                                            <option value="RX350">RX350</option>
                                            <option value="RX450">RX450</option>
                                            <option value="X5">X5</option>
                                            <option value="GLE">GLE</option>
                                            <option value="Q5">Q5</option>
                                            <option value="Camry">Camry</option>
                                            <option value="Civic">Civic</option>
                                            <option value="Mustang">Mustang</option>
                                            <option value="Corvette">Corvette</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="year" class="form-label">Year</label>
                                        <select class="form-select" id="year" name="year" required>
                                            <option value="">Select Year</option>
                                            @for($i = date('Y') + 1; $i >= 1990; $i--)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Car Type</label>
                                        <div class="row">
                                            @foreach($carTypes as $type)
                                                <div class="col-6 mb-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="type" id="type_{{ $loop->index }}" value="{{ $type }}" required>
                                                        <label class="form-check-label" for="type_{{ $loop->index }}">
                                                            {{ $type }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" class="form-control" id="price" name="price" min="0" step="0.01" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="vin" class="form-label">Vin Code</label>
                                        <input type="text" class="form-control" id="vin" name="vin" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="mileage" class="form-label">Mileage (ml)</label>
                                        <input type="number" class="form-control" id="mileage" name="mileage" min="0" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Fuel Type</label>
                                        <div class="row">
                                            @foreach($fuelTypes as $fuelType)
                                                <div class="col-6 mb-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="fuel_type" id="fuel_{{ $loop->index }}" value="{{ $fuelType }}" required>
                                                        <label class="form-check-label" for="fuel_{{ $loop->index }}">
                                                            {{ $fuelType }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="state" class="form-label">State/Region</label>
                                        <select class="form-select" id="state" name="state" required>
                                            <option value="">Select State</option>
                                            <option value="Florida">Florida</option>
                                            <option value="California">California</option>
                                            <option value="Texas">Texas</option>
                                            <option value="New York">New York</option>
                                            <option value="Illinois">Illinois</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <select class="form-select" id="city" name="city" required>
                                            <option value="">Select City</option>
                                            <option value="Miami">Miami</option>
                                            <option value="Los Angeles">Los Angeles</option>
                                            <option value="Houston">Houston</option>
                                            <option value="New York City">New York City</option>
                                            <option value="Chicago">Chicago</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Features</label>
                                    <div class="row">
                                        @foreach($features as $feature)
                                            <div class="col-md-6 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="features[]" id="feature_{{ $loop->index }}" value="{{ $feature }}">
                                                    <label class="form-check-label" for="feature_{{ $loop->index }}">
                                                        {{ $feature }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="video_url" class="form-label">Video URL (optional)</label>
                                    <input type="url" class="form-control" id="video_url" name="video_url" placeholder="https://example.com/video.mp4">
                                </div>

                                <div class="mb-3">
                                    <label for="images" class="form-label">Upload Images</label>
                                    <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
                                    <div class="form-text">You can select multiple images at once.</div>
                                </div>

                                <button type="submit" class="btn btn-orange">
                                    <i class="fas fa-save me-2"></i>Add Car
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Preview Section -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Preview</h5>
                            </div>
                            <div class="card-body">
                                <div class="text-center py-4">
                                    <div class="text-muted mb-2">
                                        <i class="fas fa-car fa-3x"></i>
                                    </div>
                                    <small class="text-muted">Car preview will appear here after you fill in the details</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.btn-orange {
    background-color: #F26522;
    border-color: #F26522;
    color: white;
}

.btn-orange:hover {
    background-color: #d54d1a;
    border-color: #d54d1a;
    color: white;
}

.form-check-input:checked {
    background-color: #F26522;
    border-color: #F26522;
}
</style>
@endsection 