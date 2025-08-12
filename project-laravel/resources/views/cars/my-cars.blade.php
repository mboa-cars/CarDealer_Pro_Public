@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-6">
                <div>
                    <h2 class="fw-bold mb-1" style="color: #333; font-size: 2.2rem;">My Cars</h2>
                    <p class="text-muted mb-0" style="font-size: 1rem;">Manage and organize your car listings</p>
                </div>
                <div class="d-flex gap-2">
                    @php($canPublish = auth()->user()->canPublishMoreCars())
                    <a href="{{ route('cars.create') }}" class="btn-modern {{ $canPublish ? '' : 'disabled' }}" {{ $canPublish ? '' : 'aria-disabled=true tabindex=-1' }}>
                        <i class="fas fa-plus me-2"></i>Add new Car
                    </a>
                    @unless($canPublish || auth()->user()->isAdmin())
                        <a href="{{ route('plans.index') }}" class="btn-upgrade">
                            <i class="fas fa-crown me-2"></i>Mettre à niveau (Premium)
                        </a>
                    @endunless
                </div>
            </div>

            @php($limit = auth()->user()->car_limit)
            @if(!$canPublish && !auth()->user()->isAdmin())
            <div class="alert alert-warning border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%); color: #212529; border-radius: 12px;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-circle me-3" style="font-size: 1.2rem;"></i>
                    <div>
                        <strong>Limite atteinte:</strong> Vous avez atteint la limite de {{ $limit }} voitures pour votre plan Standard. 
                        <a href="{{ route('plans.index') }}" class="text-dark fw-bold text-decoration-underline">Passez en Premium</a> pour publier sans limite.
                    </div>
                </div>
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; border-radius: 12px;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-3" style="font-size: 1.2rem;"></i>
                    <div>
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%); color: white; border-radius: 12px;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-3" style="font-size: 1.2rem;"></i>
                    <div>
                        <strong>Error!</strong> {{ session('error') }}
                    </div>
                </div>
            </div>
            @endif

            <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                    <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                        <i class="fas fa-car me-2" style="color: #F26522;"></i>Car Listings
                    </h5>
                    @php($current = $cars->total())
                    @if(!auth()->user()->isAdmin())
                        @php($limit = auth()->user()->car_limit)
                        <div class="mt-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <small class="text-muted">Publications: {{ $limit === null ? $current . ' / ∞' : $current . ' / ' . $limit }}</small>
                                @if($limit !== null)
                                    @php($percent = min(100, intval($current / max($limit,1) * 100)))
                                    <small class="text-muted">{{ $percent }}%</small>
                                @endif
                            </div>
                            <div class="progress" style="height: 10px; background: #f1f3f5; border-radius: 10px;">
                                <div class="progress-bar" role="progressbar" style="width: {{ $limit === null ? 100 : min(100, intval($current / max($limit,1) * 100)) }}%; background: linear-gradient(135deg, #F26522 0%, #ea6500 100%);" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    @else
                        <div class="mt-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <small class="text-muted">Publications: {{ $current }} (Illimité)</small>
                            </div>
                            <div class="progress" style="height: 10px; background: #f1f3f5; border-radius: 10px;">
                                <div class="progress-bar" role="progressbar" style="width: 100%; background: linear-gradient(135deg, #28a745 0%, #20c997 100%);" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-body" style="padding: 1.5rem;">
                    @if($cars->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover modern-table">
                            <thead>
                                <tr>
                                    <th style="width: 80px;">Image</th>
                                    <th>Title</th>
                                    <th style="width: 120px;">Date</th>
                                    <th style="width: 120px;">Status</th>
                                    <th style="width: 200px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cars as $car)
                                <tr class="car-row">
                                    <td>
                                        @if($car->main_image)
                                        <div class="car-image">
                                            <img src="{{ $car->main_image }}" alt="{{ $car->brand }} {{ $car->model }}"
                                                class="rounded" style="width: 70px; height: 50px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                        </div>
                                        @else
                                        <div class="car-image-placeholder rounded d-flex align-items-center justify-content-center"
                                            style="width: 70px; height: 50px; background-color: #f8f9fa; color: #6c757d; border-radius: 8px;">
                                            <i class="fas fa-car"></i>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="car-info">
                                            <div class="fw-bold text-dark" style="font-size: 1.1rem;">{{ $car->year }} - {{ $car->brand }} {{ $car->model }}</div>
                                            <div class="text-success fw-semibold" style="font-size: 1rem;">{{ $car->formatted_price }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="date-info">
                                            <div class="text-muted small">{{ $car->created_at->format('M d, Y') }}</div>
                                            <div class="text-muted smaller">{{ $car->created_at->format('H:i') }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge {{ $car->is_published ? 'published' : 'draft' }}">
                                            <i class="fas {{ $car->is_published ? 'fa-check-circle' : 'fa-clock' }} me-1"></i>
                                            {{ $car->is_published ? 'Published' : 'Draft' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('cars.show', $car->id) }}"
                                                class="action-btn view-btn" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('cars.edit', $car->id) }}"
                                                class="action-btn edit-btn" title="Edit Car">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('cars.manage-images', $car->id) }}"
                                                class="action-btn images-btn" title="Manage Images">
                                                <i class="fas fa-images"></i>
                                            </a>
                                            <form action="{{ route('cars.destroy', $car->id) }}" method="POST"
                                                class="d-inline delete-form"
                                                onsubmit="return confirmDelete(event)">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn delete-btn" title="Delete Car">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-5">
                        <div class="modern-pagination">
                            {{ $cars->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                    @else
                    <div class="text-center py-8">
                        <div class="empty-state">
                            <div class="empty-icon mb-4">
                                <i class="fas fa-car fa-4x" style="color: #ddd;"></i>
                            </div>
                            <h5 class="text-muted mb-3">No Cars Yet</h5>
                            <p class="text-muted mb-4">Start by adding your first car to the marketplace</p>
                            <a href="{{ route('cars.create') }}" class="btn-modern">
                                <i class="fas fa-plus me-2"></i>Add Your First Car
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Modern Button */
.btn-modern {
    display: inline-flex;
    align-items: center;
    padding: 12px 24px;
    background: linear-gradient(135deg, #F26522 0%, #ea6500 100%);
    color: white;
    border: none;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(242, 101, 34, 0.3);
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(242, 101, 34, 0.4);
    color: white;
    text-decoration: none;
}

/* Modern Table */
.modern-table {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.modern-table th {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border: none;
    font-weight: 600;
    color: #555;
    padding: 1.2rem 1rem;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.modern-table td {
    border: none;
    padding: 1.2rem 1rem;
    vertical-align: middle;
}

.car-row {
    transition: all 0.3s ease;
}

.car-row:hover {
    background: linear-gradient(135deg, #fff8f0 0%, #fff5f0 100%);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(242, 101, 34, 0.1);
}

/* Car Image */
.car-image {
    transition: all 0.3s ease;
}

.car-image:hover {
    transform: scale(1.05);
}

.car-image-placeholder {
    transition: all 0.3s ease;
}

.car-image-placeholder:hover {
    background-color: #e9ecef !important;
}

/* Car Info */
.car-info {
    line-height: 1.4;
}

/* Date Info */
.date-info {
    line-height: 1.3;
}

.smaller {
    font-size: 0.75rem;
}

/* Status Badge */
.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-badge.published {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
}

.status-badge.draft {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(255, 193, 7, 0.3);
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 8px;
    align-items: center;
}

.action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border: none;
    border-radius: 8px;
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.action-btn:hover {
    transform: translateY(-2px);
    color: white;
    text-decoration: none;
}

.view-btn {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
}

.view-btn:hover {
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.4);
}

.edit-btn {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    box-shadow: 0 2px 8px rgba(23, 162, 184, 0.3);
}

.edit-btn:hover {
    box-shadow: 0 4px 12px rgba(23, 162, 184, 0.4);
}

.images-btn {
    background: linear-gradient(135deg, #6f42c1 0%, #5a32a3 100%);
    box-shadow: 0 2px 8px rgba(111, 66, 193, 0.3);
}

.images-btn:hover {
    box-shadow: 0 4px 12px rgba(111, 66, 193, 0.4);
}

.delete-btn {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
    box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3) !important;
    color: white !important;
}

.delete-btn:hover {
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4) !important;
    background: linear-gradient(135deg, #c82333 0%, #bd2130 100%) !important;
}

/* Empty State */
.empty-state {
    opacity: 0.8;
}

.empty-icon {
    margin-bottom: 1.5rem;
}

/* Modern Pagination */
.modern-pagination .pagination {
    gap: 4px;
}

.modern-pagination .page-item .page-link {
    border: none;
    border-radius: 8px;
    padding: 10px 14px;
    font-weight: 600;
    color: #555;
    background: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.modern-pagination .page-item .page-link:hover {
    background: linear-gradient(135deg, #fff8f0 0%, #fff5f0 100%);
    color: #F26522;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(242, 101, 34, 0.2);
}

.modern-pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #F26522 0%, #ea6500 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(242, 101, 34, 0.3);
}

.modern-pagination .page-item.disabled .page-link {
    background: #f8f9fa;
    color: #6c757d;
    box-shadow: none;
}

/* Responsive Design */
@media (max-width: 768px) {
    .action-buttons {
        flex-direction: column;
        gap: 4px;
    }
    
    .action-btn {
        width: 32px;
        height: 32px;
        font-size: 0.8rem;
    }
    
    .car-info {
        font-size: 0.9rem;
    }
    
    .status-badge {
        font-size: 0.7rem;
        padding: 4px 8px;
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

/* Delete Confirmation */
.delete-form {
    display: inline;
}

.delete-form button {
    background: none;
    border: none;
    padding: 0;
    margin: 0;
}
</style>

<script>
function confirmDelete(event) {
    event.preventDefault();
    
    if (confirm('Are you sure you want to delete this car? This action cannot be undone.')) {
        event.target.closest('form').submit();
    }
    
    return false;
}

// Add hover effects to table rows
document.addEventListener('DOMContentLoaded', function() {
    const carRows = document.querySelectorAll('.car-row');
    
    carRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endsection