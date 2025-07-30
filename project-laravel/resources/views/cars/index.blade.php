@extends('layouts.app')

@section('content')
@php
    $user = Auth::user();
@endphp

<!-- Header Section -->
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="fw-bold mb-1" style="color: #333; font-size: 2.2rem;">Find Your Perfect Car</h2>
            <p class="text-muted mb-0" style="font-size: 1rem;">Use our powerful search tool to find your desired car</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="search-stats">
                <span class="badge" style="background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); color: white; padding: 8px 16px; border-radius: 20px; font-size: 0.9rem;">
                    <i class="fas fa-car me-2"></i>{{ $cars->total() }} cars available
                </span>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; border-radius: 12px;">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-3" style="font-size: 1.2rem;"></i>
                <span>{{ session('success') }}</span>
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
</div>

<div class="row g-4">
    <!-- Filtres à gauche -->
    <div class="col-lg-3">
        <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%); position: sticky; top: 20px;">
            <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                    <i class="fas fa-filter me-2" style="color: #F26522;"></i>Search Criteria
                </h5>
            </div>
            <div class="card-body" style="padding: 1.5rem;">
                <form method="GET" action="{{ route('cars.index') }}" id="searchForm">
                    <!-- Basic Filters -->
                    <div class="mb-4">
                        <h6 class="fw-semibold mb-3" style="color: #555; font-size: 0.95rem;">
                            <i class="fas fa-cog me-2" style="color: #F26522;"></i>Car Details
                        </h6>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: #555; font-size: 0.9rem;">Maker</label>
                            <select class="form-select modern-select" name="brand">
                                <option value="">Select Maker</option>
                                @isset($brands)
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: #555; font-size: 0.9rem;">Model</label>
                            <select class="form-select modern-select" name="model">
                                <option value="">Select Model</option>
                                @isset($models)
                                    @foreach($models as $model)
                                        <option value="{{ $model }}" {{ request('model') == $model ? 'selected' : '' }}>{{ $model }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: #555; font-size: 0.9rem;">Type</label>
                            <select class="form-select modern-select" name="type">
                                <option value="">Select Type</option>
                                @isset($types)
                                    @foreach($types as $type)
                                        <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>

                    <!-- Year Range -->
                    <div class="mb-4">
                        <h6 class="fw-semibold mb-3" style="color: #555; font-size: 0.95rem;">
                            <i class="fas fa-calendar me-2" style="color: #F26522;"></i>Year Range
                        </h6>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="number" class="form-control modern-input" placeholder="From" name="year_from" value="{{ request('year_from') }}" min="1900" max="{{ date('Y') + 1 }}">
                            </div>
                            <div class="col-6">
                                <input type="number" class="form-control modern-input" placeholder="To" name="year_to" value="{{ request('year_to') }}" min="1900" max="{{ date('Y') + 1 }}">
                            </div>
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="mb-4">
                        <h6 class="fw-semibold mb-3" style="color: #555; font-size: 0.95rem;">
                            <i class="fas fa-dollar-sign me-2" style="color: #F26522;"></i>Price Range
                        </h6>
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="input-group">
                                    <span class="input-group-text" style="background: #f8f9fa; border: 1px solid #e9ecef; font-size: 0.9rem;">$</span>
                                    <input type="number" class="form-control modern-input" placeholder="From" name="price_from" value="{{ request('price_from') }}" min="0">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <span class="input-group-text" style="background: #f8f9fa; border: 1px solid #e9ecef; font-size: 0.9rem;">$</span>
                                    <input type="number" class="form-control modern-input" placeholder="To" name="price_to" value="{{ request('price_to') }}" min="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Filters -->
                    <div class="mb-4">
                        <h6 class="fw-semibold mb-3" style="color: #555; font-size: 0.95rem;">
                            <i class="fas fa-sliders-h me-2" style="color: #F26522;"></i>Additional Filters
                        </h6>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: #555; font-size: 0.9rem;">Mileage</label>
                            <select class="form-select modern-select" name="mileage">
                                <option value="">Any Mileage</option>
                                @isset($mileages)
                                    @foreach($mileages as $mileage)
                                        <option value="{{ $mileage }}" {{ request('mileage') == $mileage ? 'selected' : '' }}>{{ $mileage }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: #555; font-size: 0.9rem;">Fuel Type</label>
                            <select class="form-select modern-select" name="fuel_type">
                                <option value="">Select Fuel Type</option>
                                @isset($fuel_types)
                                    @foreach($fuel_types as $fuel_type)
                                        <option value="{{ $fuel_type }}" {{ request('fuel_type') == $fuel_type ? 'selected' : '' }}>{{ $fuel_type }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>

                    <!-- Location Filters -->
                    <div class="mb-4">
                        <h6 class="fw-semibold mb-3" style="color: #555; font-size: 0.95rem;">
                            <i class="fas fa-map-marker-alt me-2" style="color: #F26522;"></i>Location
                        </h6>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: #555; font-size: 0.9rem;">State/Region</label>
                            <select class="form-select modern-select" name="state">
                                <option value="">Select State/Region</option>
                                @isset($states)
                                    @foreach($states as $state)
                                        <option value="{{ $state }}" {{ request('state') == $state ? 'selected' : '' }}>{{ $state }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: #555; font-size: 0.9rem;">City</label>
                            <select class="form-select modern-select" name="city">
                                <option value="">Select City</option>
                                @isset($cities)
                                    @foreach($cities as $city)
                                        <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex gap-2">
                        <button type="reset" class="btn flex-fill" style="background: #f8f9fa; color: #666; border: 2px solid #e9ecef; border-radius: 12px; padding: 12px; font-weight: 600; transition: all 0.3s ease;">
                            <i class="fas fa-undo me-2"></i>Reset
                        </button>
                        <button type="submit" class="btn flex-fill" style="background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); color: white; border: none; border-radius: 12px; padding: 12px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(242, 101, 34, 0.3);">
                            <i class="fas fa-search me-2"></i>Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Grille de voitures -->
    <div class="col-lg-9">
        <!-- Results Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="fw-bold mb-1" style="color: #333;">Search Results</h5>
                <p class="text-muted mb-0" style="font-size: 0.9rem;">
                    Showing {{ $cars->firstItem() ?? 0 }} to {{ $cars->lastItem() ?? 0 }} of {{ $cars->total() }} cars
                </p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <select class="form-select modern-select w-auto" style="min-width: 150px;">
                    <option>Sort by: Latest</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Year: Newest</option>
                    <option>Year: Oldest</option>
                </select>
                <div class="view-toggle">
                    <button class="btn btn-sm" style="background: #F26522; color: white; border: none; border-radius: 8px; padding: 8px 12px;">
                        <i class="fas fa-th-large"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Cars Grid -->
        <div class="row g-4">
            @forelse($cars as $car)
                @include('components.car-card', ['car' => $car])
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <div class="empty-state">
                            <i class="fas fa-car fa-4x mb-4" style="color: #ddd;"></i>
                            <h5 class="text-muted mb-2">No cars found</h5>
                            <p class="text-muted mb-4">Try adjusting your search criteria to find more cars</p>
                            <button class="btn" style="background: #F26522; color: white; border: none; border-radius: 12px; padding: 12px 24px; font-weight: 600;">
                                <i class="fas fa-undo me-2"></i>Clear Filters
                            </button>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($cars->hasPages())
            <div class="mt-5 d-flex justify-content-center">
                <div class="pagination-wrapper">
                    {{ $cars->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @endif
    </div>
</div>

@endsection

@push('styles')
<style>
/* Modern Form Styles */
.modern-input, .modern-select {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 12px 16px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background: white;
}

.modern-input:focus, .modern-select:focus {
    border-color: #F26522;
    box-shadow: 0 0 0 0.2rem rgba(242, 101, 34, 0.25);
    outline: none;
}

/* Card Styles */
.card {
    border: none;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

/* Pagination Styles */
.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #F26522 0%, #ea6500 100%);
    border-color: #F26522;
    color: white;
    border-radius: 8px;
}

.pagination .page-link {
    color: #F26522;
    border-radius: 8px;
    border: 2px solid #e9ecef;
    margin: 0 2px;
    transition: all 0.3s ease;
}

.pagination .page-link:hover {
    background: #fff8f0;
    color: #F26522;
    border-color: #F26522;
}

/* Empty State */
.empty-state {
    padding: 3rem 1rem;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card {
    animation: fadeInUp 0.6s ease-out;
}

/* Responsive Design */
@media (max-width: 768px) {
    .search-stats {
        display: none;
    }
    
    .view-toggle {
        display: none;
    }
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

/* Sticky Sidebar */
@media (min-width: 992px) {
    .sticky-top {
        position: sticky;
        top: 20px;
    }
}
</style>
@endpush

@push('scripts')
<script>
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

// Auto-submit form on select change
document.querySelectorAll('.modern-select').forEach(select => {
    select.addEventListener('change', function() {
        // Uncomment the line below to auto-submit on change
        // document.getElementById('searchForm').submit();
    });
});

// Reset form functionality
document.querySelector('button[type="reset"]').addEventListener('click', function() {
    setTimeout(() => {
        document.getElementById('searchForm').submit();
    }, 100);
});

// Favorite functionality
document.addEventListener('click', function(e) {
    const btn = e.target.closest('.favorite-btn');
    
    if (!btn) return;
    e.preventDefault();
    
    const form = btn.closest('form');
    const carId = form.getAttribute('data-car-id');
    
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const isFavorited = btn.innerHTML.includes('&#9829;');
    const url = `/cars/${carId}/favorite`;
    
    // Désactiver le bouton pendant la requête
    btn.disabled = true;
    const originalContent = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    
    fetch(url, {
        method: isFavorited ? 'DELETE' : 'POST',
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        btn.innerHTML = data.isFavorited ? '&#9829;' : '&#9825;';
        btn.style.color = '#F26522';
        
        // Notification
        const message = data.isFavorited ? 'Added to favorites!' : 'Removed from favorites!';
        showNotification(message, data.isFavorited ? 'success' : 'info');
    })
    .catch(error => {
        console.error('Error:', error);
        btn.innerHTML = originalContent;
        showNotification('Error during operation', 'error');
    })
    .finally(() => {
        btn.disabled = false;
    });
});

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'} position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px; border-radius: 12px;';
    notification.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-triangle' : 'info-circle'} me-3"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Smooth scrolling
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
</script>
@endpush 