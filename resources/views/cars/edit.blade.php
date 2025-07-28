@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0">Edit Car: {{ $car->year }} - {{ $car->brand }} {{ $car->model }}</h2>
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

            <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
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
                                            <option value="Lexus" {{ $car->brand == 'Lexus' ? 'selected' : '' }}>Lexus</option>
                                            <option value="BMW" {{ $car->brand == 'BMW' ? 'selected' : '' }}>BMW</option>
                                            <option value="Mercedes" {{ $car->brand == 'Mercedes' ? 'selected' : '' }}>Mercedes</option>
                                            <option value="Audi" {{ $car->brand == 'Audi' ? 'selected' : '' }}>Audi</option>
                                            <option value="Toyota" {{ $car->brand == 'Toyota' ? 'selected' : '' }}>Toyota</option>
                                            <option value="Honda" {{ $car->brand == 'Honda' ? 'selected' : '' }}>Honda</option>
                                            <option value="Ford" {{ $car->brand == 'Ford' ? 'selected' : '' }}>Ford</option>
                                            <option value="Chevrolet" {{ $car->brand == 'Chevrolet' ? 'selected' : '' }}>Chevrolet</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="model" class="form-label">Model</label>
                                        <select class="form-select" id="model" name="model" required>
                                            <option value="">Select Model</option>
                                            <option value="RX350" {{ $car->model == 'RX350' ? 'selected' : '' }}>RX350</option>
                                            <option value="RX450" {{ $car->model == 'RX450' ? 'selected' : '' }}>RX450</option>
                                            <option value="X5" {{ $car->model == 'X5' ? 'selected' : '' }}>X5</option>
                                            <option value="GLE" {{ $car->model == 'GLE' ? 'selected' : '' }}>GLE</option>
                                            <option value="Q5" {{ $car->model == 'Q5' ? 'selected' : '' }}>Q5</option>
                                            <option value="Camry" {{ $car->model == 'Camry' ? 'selected' : '' }}>Camry</option>
                                            <option value="Civic" {{ $car->model == 'Civic' ? 'selected' : '' }}>Civic</option>
                                            <option value="Mustang" {{ $car->model == 'Mustang' ? 'selected' : '' }}>Mustang</option>
                                            <option value="Corvette" {{ $car->model == 'Corvette' ? 'selected' : '' }}>Corvette</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="year" class="form-label">Year</label>
                                        <select class="form-select" id="year" name="year" required>
                                            <option value="">Select Year</option>
                                            @for($i = date('Y') + 1; $i >= 1990; $i--)
                                                <option value="{{ $i }}" {{ $car->year == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Car Type</label>
                                        <div class="row">
                                            @foreach($carTypes as $type)
                                                <div class="col-6 mb-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="type" id="type_{{ $loop->index }}" value="{{ $type }}" {{ $car->type == $type ? 'checked' : '' }} required>
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
                                        <input type="number" class="form-control" id="price" name="price" value="{{ $car->price }}" min="0" step="0.01" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="vin" class="form-label">Vin Code</label>
                                        <input type="text" class="form-control" id="vin" name="vin" value="{{ $car->vin }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="mileage" class="form-label">Mileage (ml)</label>
                                        <input type="number" class="form-control" id="mileage" name="mileage" value="{{ $car->mileage }}" min="0" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Fuel Type</label>
                                        <div class="row">
                                            @foreach($fuelTypes as $fuelType)
                                                <div class="col-6 mb-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="fuel_type" id="fuel_{{ $loop->index }}" value="{{ $fuelType }}" {{ $car->fuel_type == $fuelType ? 'checked' : '' }} required>
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
                                            <option value="Florida" {{ $car->state == 'Florida' ? 'selected' : '' }}>Florida</option>
                                            <option value="California" {{ $car->state == 'California' ? 'selected' : '' }}>California</option>
                                            <option value="Texas" {{ $car->state == 'Texas' ? 'selected' : '' }}>Texas</option>
                                            <option value="New York" {{ $car->state == 'New York' ? 'selected' : '' }}>New York</option>
                                            <option value="Illinois" {{ $car->state == 'Illinois' ? 'selected' : '' }}>Illinois</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <select class="form-select" id="city" name="city" required>
                                            <option value="">Select City</option>
                                            <option value="Miami" {{ $car->city == 'Miami' ? 'selected' : '' }}>Miami</option>
                                            <option value="Los Angeles" {{ $car->city == 'Los Angeles' ? 'selected' : '' }}>Los Angeles</option>
                                            <option value="Houston" {{ $car->city == 'Houston' ? 'selected' : '' }}>Houston</option>
                                            <option value="New York City" {{ $car->city == 'New York City' ? 'selected' : '' }}>New York City</option>
                                            <option value="Chicago" {{ $car->city == 'Chicago' ? 'selected' : '' }}>Chicago</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ $car->address }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $car->phone }}" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4">{{ $car->description }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Features</label>
                                    <div class="row">
                                        @foreach($features as $feature)
                                            <div class="col-md-6 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="features[]" id="feature_{{ $loop->index }}" value="{{ $feature }}" {{ in_array($feature, $car->features ?? []) ? 'checked' : '' }}>
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
                                    <input type="url" class="form-control" id="video_url" name="video_url" value="{{ $car->video_url }}" placeholder="https://example.com/video.mp4">
                                </div>

                                <div class="mb-3">
                                    <label for="images" class="form-label">Add New Images</label>
                                    <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
                                    <div class="form-text">You can select multiple images at once.</div>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-orange">
                                        <i class="fas fa-save me-2"></i>Update Car
                                    </button>
                                    <a href="{{ route('cars.manage-images', $car->id) }}" class="btn btn-outline-info">
                                        <i class="fas fa-images me-2"></i>Manage Images
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Image Management -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Manage your images</h5>
                                <a href="{{ route('cars.manage-images', $car->id) }}" class="text-decoration-none">From here</a>
                            </div>
                            <div class="card-body">
                                @if($car->images->count() > 0)
                                    <div class="row g-2">
                                        @foreach($car->images->take(9) as $image)
                                            <div class="col-4">
                                                @if($image->image_url)
                                                    <img src="{{ $image->image_url }}" 
                                                         alt="Car Image" 
                                                         class="img-fluid rounded" 
                                                         style="width: 100%; height: 80px; object-fit: cover;">
                                                @else
                                                    <div class="d-flex align-items-center justify-content-center rounded" 
                                                         style="width: 100%; height: 80px; background-color: #f8f9fa; color: #6c757d;">
                                                        <i class="fas fa-car"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                    @if($car->images->count() > 9)
                                        <div class="text-center mt-2">
                                            <small class="text-muted">+{{ $car->images->count() - 9 }} more images</small>
                                        </div>
                                    @endif
                                @else
                                    <div class="text-center py-4">
                                        <div class="text-muted mb-2">
                                            <i class="fas fa-images fa-2x"></i>
                                        </div>
                                        <small class="text-muted">No images uploaded yet</small>
                                    </div>
                                @endif
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