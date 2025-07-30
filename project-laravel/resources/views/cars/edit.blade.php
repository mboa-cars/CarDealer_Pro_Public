@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1" style="color: #333; font-size: 2.2rem;">Edit Car</h2>
                    <p class="text-muted mb-0" style="font-size: 1rem;">Update your car details in the marketplace</p>
                </div>
                <a href="{{ route('cars.my-cars') }}" class="btn-back">
                    <i class="fas fa-arrow-left me-2"></i>Back to My Cars
                </a>
            </div>

            @if($errors->any())
            <div class="alert alert-danger border-0 shadow-sm" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%); color: white; border-radius: 12px;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-3" style="font-size: 1.2rem;"></i>
                    <div>
                        <strong>Please fix the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data" id="carForm">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <!-- Car Specifications Form -->
                    <div class="col-lg-8">
                        <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                            <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                                <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                                    <i class="fas fa-cog me-2" style="color: #F26522;"></i>Car Specifications
                                </h5>
                            </div>
                            <div class="card-body" style="padding: 1.5rem;">
                                
                                <!-- Basic Info Section -->
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label for="brand" class="form-label fw-semibold" style="color: #555;">Maker</label>
                                        <select class="form-select modern-select" id="brand" name="brand" required>
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
                                    <div class="col-md-6">
                                        <label for="model" class="form-label fw-semibold" style="color: #555;">Model</label>
                                        <select class="form-select modern-select" id="model" name="model" required>
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

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label for="year" class="form-label fw-semibold" style="color: #555;">Year</label>
                                        <select class="form-select modern-select" id="year" name="year" required>
                                            <option value="">Select Year</option>
                                            @for($i = date('Y') + 1; $i >= 1990; $i--)
                                            <option value="{{ $i }}" {{ $car->year == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold" style="color: #555;">Car Type</label>
                                        <div class="car-type-grid">
                                            @foreach($carTypes as $type)
                                            <div class="car-type-option">
                                                <input class="form-check-input" type="radio" name="type" id="type_{{ $loop->index }}" value="{{ $type }}" {{ $car->type == $type ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="type_{{ $loop->index }}">
                                                    <i class="fas fa-car me-2"></i>{{ $type }}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label for="price" class="form-label fw-semibold" style="color: #555;">Price ($)</label>
                                        <div class="input-group">
                                            <span class="input-group-text" style="background: #f8f9fa; border: 1px solid #e9ecef;">$</span>
                                            <input type="number" class="form-control modern-input" id="price" name="price" value="{{ $car->price }}" min="0" step="0.01" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="vin" class="form-label fw-semibold" style="color: #555;">VIN Code</label>
                                        <input type="text" class="form-control modern-input" id="vin" name="vin" value="{{ $car->vin }}" required>
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label for="mileage" class="form-label fw-semibold" style="color: #555;">Mileage (miles)</label>
                                        <input type="number" class="form-control modern-input" id="mileage" name="mileage" value="{{ $car->mileage }}" min="0" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold" style="color: #555;">Fuel Type</label>
                                        <div class="car-type-grid">
                                            @foreach($fuelTypes as $fuelType)
                                            <div class="car-type-option">
                                                <input class="form-check-input" type="radio" name="fuel_type" id="fuel_{{ $loop->index }}" value="{{ $fuelType }}" {{ $car->fuel_type == $fuelType ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="fuel_{{ $loop->index }}">
                                                    <i class="fas fa-gas-pump me-2"></i>{{ $fuelType }}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Location Section -->
                                <div class="location-section mb-4">
                                    <h6 class="fw-bold mb-3" style="color: #333;">
                                        <i class="fas fa-map-marker-alt me-2" style="color: #F26522;"></i>Location Details
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="state" class="form-label fw-semibold" style="color: #555;">State/Region</label>
                                            <select class="form-select modern-select" id="state" name="state" required>
                                                <option value="">Select State/Region</option>
                                                <option value="Florida" {{ $car->state == 'Florida' ? 'selected' : '' }}>Florida</option>
                                                <option value="California" {{ $car->state == 'California' ? 'selected' : '' }}>California</option>
                                                <option value="Texas" {{ $car->state == 'Texas' ? 'selected' : '' }}>Texas</option>
                                                <option value="New York" {{ $car->state == 'New York' ? 'selected' : '' }}>New York</option>
                                                <option value="Illinois" {{ $car->state == 'Illinois' ? 'selected' : '' }}>Illinois</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="city" class="form-label fw-semibold" style="color: #555;">City</label>
                                            <select class="form-select modern-select" id="city" name="city" required>
                                                <option value="">Select City</option>
                                                <option value="Miami" {{ $car->city == 'Miami' ? 'selected' : '' }}>Miami</option>
                                                <option value="Los Angeles" {{ $car->city == 'Los Angeles' ? 'selected' : '' }}>Los Angeles</option>
                                                <option value="Houston" {{ $car->city == 'Houston' ? 'selected' : '' }}>Houston</option>
                                                <option value="New York City" {{ $car->city == 'New York City' ? 'selected' : '' }}>New York City</option>
                                                <option value="Chicago" {{ $car->city == 'Chicago' ? 'selected' : '' }}>Chicago</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="address" class="form-label fw-semibold" style="color: #555;">Address</label>
                                            <input type="text" class="form-control modern-input" id="address" name="address" value="{{ $car->address }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone" class="form-label fw-semibold" style="color: #555;">Phone</label>
                                            <input type="tel" class="form-control modern-input" id="phone" name="phone" value="{{ $car->phone }}" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Description Section -->
                                <div class="mb-4">
                                    <label for="description" class="form-label fw-semibold" style="color: #555;">Description</label>
                                    <textarea class="form-control modern-textarea" id="description" name="description" rows="4" placeholder="Describe your car in detail...">{{ $car->description }}</textarea>
                                </div>

                                <!-- Features Section -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold" style="color: #555;">Features</label>
                                    <div class="features-grid">
                                        @foreach($features as $feature)
                                        <div class="feature-item">
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

                                <!-- Media Section -->
                                <div class="mb-4">
                                    <label for="video_url" class="form-label fw-semibold" style="color: #555;">Video URL (optional)</label>
                                    <input type="url" class="form-control modern-input" id="video_url" name="video_url" value="{{ $car->video_url }}" placeholder="https://example.com/video.mp4">
                                </div>

                                <div class="mb-4">
                                    <label for="images" class="form-label fw-semibold" style="color: #555;">Upload New Images</label>
                                    <div class="upload-area" id="uploadArea">
                                        <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*" style="display: none;">
                                        <div class="upload-content">
                                            <i class="fas fa-cloud-upload-alt fa-2x mb-3" style="color: #F26522;"></i>
                                            <h6 class="mb-2">Drop images here or click to browse</h6>
                                            <p class="text-muted mb-0">You can select multiple images at once</p>
                                        </div>
                                    </div>
                                    <div id="preview-images" class="d-flex flex-wrap gap-2 mt-3"></div>
                                </div>

                                <div class="d-flex gap-3">
                                    <button type="submit" class="btn btn-lg flex-fill" style="background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); color: white; border: none; border-radius: 12px; padding: 15px; font-weight: 600; font-size: 1.1rem; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(242, 101, 34, 0.3);">
                                        <i class="fas fa-save me-2"></i>Update Car
                                    </button>
                                    <a href="{{ route('cars.manage-images', $car->id) }}" class="btn btn-lg flex-fill" style="background: white; color: #F26522; border: 2px solid #F26522; border-radius: 12px; padding: 15px; font-weight: 600; font-size: 1.1rem; transition: all 0.3s ease; text-decoration: none; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-images me-2"></i>Manage Images
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Image Management Section -->
                    <div class="col-lg-4">
                        <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%); position: sticky; top: 20px;">
                            <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                                <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                                    <i class="fas fa-images me-2" style="color: #F26522;"></i>Current Images
                                </h5>
                                <a href="{{ route('cars.manage-images', $car->id) }}" class="text-decoration-none" style="color: #F26522; font-size: 0.9rem;">Manage from here</a>
                            </div>
                            <div class="card-body" style="padding: 1.5rem;">
                                @if($car->images->count() > 0)
                                    <div class="row g-2">
                                        @foreach($car->images->take(9) as $image)
                                            <div class="col-4">
                                                @if($image->image_url)
                                                    <div class="image-preview">
                                                        <img src="{{ $image->image_url }}" 
                                                             alt="Car Image" 
                                                             class="img-fluid rounded" 
                                                             style="width: 100%; height: 80px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                                    </div>
                                                @else
                                                    <div class="image-placeholder d-flex align-items-center justify-content-center rounded" 
                                                         style="width: 100%; height: 80px; background-color: #f8f9fa; color: #6c757d; border-radius: 8px;">
                                                        <i class="fas fa-car"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                    @if($car->images->count() > 9)
                                        <div class="text-center mt-3">
                                            <span class="badge bg-light text-dark" style="border-radius: 20px; padding: 8px 16px;">
                                                +{{ $car->images->count() - 9 }} more images
                                            </span>
                                        </div>
                                    @endif
                                @else
                                    <div class="text-center py-4">
                                        <div class="empty-state">
                                            <i class="fas fa-images fa-3x mb-3" style="color: #ddd;"></i>
                                            <h6 class="text-muted mb-2">No Images</h6>
                                            <small class="text-muted">No images uploaded yet</small>
                                        </div>
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
/* Modern Form Styles */
.modern-input, .modern-select, .modern-textarea {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 12px 16px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
}

.modern-input:focus, .modern-select:focus, .modern-textarea:focus {
    border-color: #F26522;
    box-shadow: 0 0 0 0.2rem rgba(242, 101, 34, 0.25);
    outline: none;
}

/* Car Type Grid */
.car-type-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 8px;
}

.car-type-option {
    background: white;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 10px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.car-type-option:hover {
    border-color: #F26522;
    background: #fff8f0;
}

.car-type-option input[type="radio"] {
    display: none;
}

.car-type-option input[type="radio"]:checked + label {
    color: #F26522;
    font-weight: 600;
}

.car-type-option input[type="radio"]:checked ~ .car-type-option {
    border-color: #F26522;
    background: #fff8f0;
}

/* Features Grid */
.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 12px;
}

.feature-item {
    background: white;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 12px;
    transition: all 0.3s ease;
}

.feature-item:hover {
    border-color: #F26522;
    background: #fff8f0;
}

/* Upload Area */
.upload-area {
    border: 2px dashed #ddd;
    border-radius: 12px;
    padding: 40px 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #fafafa;
}

.upload-area:hover {
    border-color: #F26522;
    background: #fff8f0;
}

.upload-area.dragover {
    border-color: #F26522;
    background: #fff8f0;
    transform: scale(1.02);
}

/* Back Button */
.btn-back {
    display: inline-flex;
    align-items: center;
    padding: 12px 24px;
    background: white;
    color: #F26522;
    border: 2px solid #F26522;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(242, 101, 34, 0.1);
}

.btn-back:hover {
    background: #F26522;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(242, 101, 34, 0.3);
    text-decoration: none;
}

/* Image Preview */
.image-preview {
    transition: all 0.3s ease;
}

.image-preview:hover {
    transform: scale(1.05);
}

.image-placeholder {
    transition: all 0.3s ease;
}

.image-placeholder:hover {
    background-color: #e9ecef !important;
}

/* Empty State */
.empty-state {
    opacity: 0.6;
}

/* Responsive Design */
@media (max-width: 768px) {
    .car-type-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .features-grid {
        grid-template-columns: 1fr;
    }
    
    .btn-back {
        padding: 10px 16px;
        font-size: 0.9rem;
    }
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.card {
    animation: fadeIn 0.6s ease-out;
}

/* Loading States */
.form-control:disabled {
    background-color: #f8f9fa;
    opacity: 0.7;
}

/* Success States */
.form-control.is-valid {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}

/* Error States */
.form-control.is-invalid {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}
</style>

<script>
// Upload Area Interactions
const uploadArea = document.getElementById('uploadArea');
const fileInput = document.getElementById('images');

uploadArea.addEventListener('click', () => fileInput.click());

uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.classList.add('dragover');
});

uploadArea.addEventListener('dragleave', () => {
    uploadArea.classList.remove('dragover');
});

uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('dragover');
    fileInput.files = e.dataTransfer.files;
    handleFileSelect();
});

fileInput.addEventListener('change', handleFileSelect);

function handleFileSelect() {
    const preview = document.getElementById('preview-images');
    preview.innerHTML = '';
    
    Array.from(fileInput.files).forEach((file, index) => {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100px';
                img.style.height = '75px';
                img.style.objectFit = 'cover';
                img.style.borderRadius = '8px';
                img.style.margin = '4px';
                img.style.boxShadow = '0 2px 8px rgba(0,0,0,0.1)';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    });
}

// Form Validation Enhancement
document.querySelectorAll('.modern-input, .modern-select').forEach(input => {
    input.addEventListener('blur', function() {
        if (this.checkValidity()) {
            this.classList.add('is-valid');
            this.classList.remove('is-invalid');
        } else {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
        }
    });
});

// Smooth Scrolling
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
</script>
@endsection 