@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1" style="color: #333; font-size: 2.2rem;">Add New Car</h2>
                    <p class="text-muted mb-0" style="font-size: 1rem;">Fill in the details below to add your car to the marketplace</p>
                </div>
                <a href="{{ route('cars.my-cars') }}" class="btn-back">
                    <i class="fas fa-arrow-left me-2"></i>Back to My Cars
                </a>
            </div>

            @php($limit = auth()->user()->car_limit)
            @if(!auth()->user()->isAdmin() && !auth()->user()->canPublishMoreCars())
            <div class="alert alert-warning border-0 shadow-sm" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%); color: #212529; border-radius: 12px;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-circle me-3" style="font-size: 1.2rem;"></i>
                    <div>
                        <strong>Limite de plan atteinte.</strong> Votre plan actuel vous permet de publier jusqu'à {{ $limit }} voitures.
                        <a href="{{ route('plans.index') }}" class="text-dark fw-bold text-decoration-underline">Mettre à niveau vers Premium</a> pour des publications illimitées.
                    </div>
                </div>
            </div>
            @endif

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

            <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data" id="carForm">
                @csrf

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
                                    <div class="col-md-6">
                                        <label for="model" class="form-label fw-semibold" style="color: #555;">Model</label>
                                        <input type="text" class="form-control modern-input" id="model" name="model" required placeholder="Enter car model">
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label for="year" class="form-label fw-semibold" style="color: #555;">Year</label>
                                        <select class="form-select modern-select" id="year" name="year" required>
                                            <option value="">Select Year</option>
                                            @for($i = date('Y') + 1; $i >= 1990; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold" style="color: #555;">Car Type</label>
                                        <div class="car-type-grid">
                                            @foreach($carTypes as $type)
                                            <div class="car-type-option">
                                                <input class="form-check-input" type="radio" name="type" id="type_{{ $loop->index }}" value="{{ $type }}" required>
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
                                            <input type="number" class="form-control modern-input" id="price" name="price" min="0" step="0.01" required placeholder="0.00">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="vin" class="form-label fw-semibold" style="color: #555;">VIN Code</label>
                                        <input type="text" class="form-control modern-input" id="vin" name="vin" required placeholder="Enter VIN code">
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label for="mileage" class="form-label fw-semibold" style="color: #555;">Mileage (miles)</label>
                                        <input type="number" class="form-control modern-input" id="mileage" name="mileage" min="0" required placeholder="Enter mileage">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="fuel_type" class="form-label fw-semibold" style="color: #555;">Fuel Type</label>
                                        <select class="form-select modern-select" id="fuel_type" name="fuel_type" required>
                                            <option value="">Select Fuel Type</option>
                                            @foreach($fuelTypes as $fuelType)
                                            <option value="{{ $fuelType }}">{{ $fuelType }}</option>
                                            @endforeach
                                        </select>
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
                                                <option value="California">California</option>
                                                <option value="Texas">Texas</option>
                                                <option value="Florida">Florida</option>
                                                <option value="New York">New York</option>
                                                <option value="Illinois">Illinois</option>
                                                <option value="Pennsylvania">Pennsylvania</option>
                                                <option value="Ohio">Ohio</option>
                                                <option value="Georgia">Georgia</option>
                                                <option value="North Carolina">North Carolina</option>
                                                <option value="Michigan">Michigan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="city" class="form-label fw-semibold" style="color: #555;">City</label>
                                            <select class="form-select modern-select" id="city" name="city" required>
                                                <option value="">Select City</option>
                                                <option value="Los Angeles">Los Angeles</option>
                                                <option value="New York">New York</option>
                                                <option value="Chicago">Chicago</option>
                                                <option value="Houston">Houston</option>
                                                <option value="Phoenix">Phoenix</option>
                                                <option value="Philadelphia">Philadelphia</option>
                                                <option value="San Antonio">San Antonio</option>
                                                <option value="San Diego">San Diego</option>
                                                <option value="Dallas">Dallas</option>
                                                <option value="San Jose">San Jose</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="address" class="form-label fw-semibold" style="color: #555;">Address</label>
                                            <input type="text" class="form-control modern-input" id="address" name="address" required placeholder="Enter full address">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone" class="form-label fw-semibold" style="color: #555;">Phone</label>
                                            <input type="tel" class="form-control modern-input" id="phone" name="phone" required placeholder="Enter phone number">
                                        </div>
                                    </div>
                                </div>

                                <!-- Description Section -->
                                <div class="mb-4">
                                    <label for="description" class="form-label fw-semibold" style="color: #555;">Description</label>
                                    <textarea class="form-control modern-textarea" id="description" name="description" rows="4" placeholder="Describe your car in detail..."></textarea>
                                </div>

                                <!-- Features Section -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold" style="color: #555;">Features</label>
                                    <div class="features-grid">
                                        @foreach($features as $feature)
                                        <div class="feature-item">
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

                                <!-- Media Section -->
                                <div class="mb-4">
                                    <label for="video_url" class="form-label fw-semibold" style="color: #555;">Video URL (optional)</label>
                                    <input type="url" class="form-control modern-input" id="video_url" name="video_url" placeholder="https://example.com/video.mp4">
                                </div>

                                <div class="mb-4">
                                    <label for="images" class="form-label fw-semibold" style="color: #555;">Upload Images</label>
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

                <button type="submit" class="btn btn-lg w-100" {{ (auth()->user()->isAdmin() || auth()->user()->canPublishMoreCars()) ? '' : 'disabled' }} style="background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); color: white; border: none; border-radius: 12px; padding: 15px; font-weight: 600; font-size: 1.1rem; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(242, 101, 34, 0.3);">
                                    <i class="fas fa-save me-2"></i>Add Car
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Preview Section -->
                    <div class="col-lg-4">
                        <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%); position: sticky; top: 20px;">
                            <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                                <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                                    <i class="fas fa-eye me-2" style="color: #F26522;"></i>Preview
                                </h5>
                            </div>
                            <div class="card-body" style="padding: 1.5rem;">
                                <div class="preview-content text-center py-4" id="previewContent">
                                    <div class="preview-placeholder">
                                        <i class="fas fa-car fa-4x mb-3" style="color: #ddd;"></i>
                                        <h6 class="text-muted mb-2">Car Preview</h6>
                                        <small class="text-muted">Fill in the details to see a preview of your car</small>
                                    </div>
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
    position: absolute;
    opacity: 0;
    width: 1px;
    height: 1px;
    margin: -1px;
    padding: 0;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border: 0;
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

/* Preview Styles */
.preview-content {
    min-height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.preview-placeholder {
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
// Debug: Test d'authentification
fetch('/test-auth')
    .then(response => response.json())
    .then(data => {
        console.log('Auth status:', data);
        if (!data.authenticated) {
            alert('Vous n\'êtes pas connecté. Veuillez vous connecter d\'abord.');
        } else {
            console.log('✅ Utilisateur connecté:', data.user_name);
        }
    })
    .catch(error => {
        console.error('Erreur lors de la vérification d\'authentification:', error);
    });

// Debug: Traçage de la soumission du formulaire
document.getElementById('carForm').addEventListener('submit', function(e) {
    console.log('🚀 Formulaire soumis!');
    console.log('Action:', this.action);
    console.log('Method:', this.method);
    
    // Vérifier si tous les champs requis sont remplis
    const requiredFields = this.querySelectorAll('[required]');
    let allValid = true;
    let missingFields = [];
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            console.log('❌ Champ manquant:', field.name, 'Value:', field.value);
            missingFields.push(field.name);
            allValid = false;
        } else {
            console.log('✅ Champ OK:', field.name, 'Value:', field.value);
        }
    });
    
    if (!allValid) {
        e.preventDefault();
        alert('Veuillez remplir tous les champs requis: ' + missingFields.join(', '));
        return;
    }
    
    console.log('✅ Tous les champs sont valides, soumission en cours...');
    
    // Afficher les données du formulaire
    const formData = new FormData(this);
    console.log('📋 Données du formulaire:');
    for (let [key, value] of formData.entries()) {
        console.log(key + ':', value);
    }
});

// Debug: Traçage des clics sur le bouton
document.querySelector('button[type="submit"]').addEventListener('click', function(e) {
    console.log('🖱️ Bouton Add Car cliqué!');
    console.log('Bouton:', this);
    console.log('Form parent:', this.closest('form'));
});

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

// Real-time Preview
document.getElementById('carForm').addEventListener('input', function(e) {
    updatePreview();
});

function updatePreview() {
    const brand = document.getElementById('brand').value;
    const model = document.getElementById('model').value;
    const year = document.getElementById('year').value;
    const price = document.getElementById('price').value;
    
    const previewContent = document.getElementById('previewContent');
    
    if (brand && model && year) {
        previewContent.innerHTML = `
            <div class="preview-card">
                <div class="preview-image mb-3">
                    <i class="fas fa-car fa-3x" style="color: #F26522;"></i>
                </div>
                <h6 class="fw-bold mb-2">${year} ${brand} ${model}</h6>
                ${price ? `<p class="text-success fw-bold mb-2">$${parseFloat(price).toLocaleString()}</p>` : ''}
                <small class="text-muted">Preview generated from form data</small>
            </div>
        `;
    } else {
        previewContent.innerHTML = `
            <div class="preview-placeholder">
                <i class="fas fa-car fa-4x mb-3" style="color: #ddd;"></i>
                <h6 class="text-muted mb-2">Car Preview</h6>
                <small class="text-muted">Fill in the details to see a preview of your car</small>
            </div>
        `;
    }
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