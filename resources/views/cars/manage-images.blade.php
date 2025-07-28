@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0">Manage Images for {{ $car->year }} - {{ $car->brand }} {{ $car->model }}</h2>
                <a href="{{ route('cars.my-cars') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to My Cars
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <!-- Existing Images -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Existing Images</h5>
                        </div>
                        <div class="card-body">
                            @if($car->images->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 50px;">
                                                    <input type="checkbox" id="select-all" class="form-check-input">
                                                </th>
                                                <th>Image</th>
                                                <th style="width: 100px;">Position</th>
                                            </tr>
                                        </thead>
                                        <tbody id="images-tbody">
                                            @foreach($car->images as $image)
                                                <tr data-image-id="{{ $image->id }}">
                                                    <td>
                                                        <input type="checkbox" class="form-check-input image-checkbox">
                                                    </td>
                                                    <td>
                                                        @if($image->image_url)
                                                            <img src="{{ $image->image_url }}" 
                                                                 alt="Car Image" 
                                                                 class="rounded" 
                                                                 style="width: 80px; height: 60px; object-fit: cover;">
                                                        @else
                                                            <div class="d-flex align-items-center justify-content-center rounded" 
                                                                 style="width: 80px; height: 60px; background-color: #f8f9fa; color: #6c757d;">
                                                                <i class="fas fa-car"></i>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input type="number" 
                                                               class="form-control form-control-sm position-input" 
                                                               value="{{ $image->position }}" 
                                                               min="0" 
                                                               style="width: 70px;">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <button type="button" class="btn btn-orange" onclick="updatePositions()">
                                    <i class="fas fa-save me-2"></i>Update Images
                                </button>
                                <button type="button" class="btn btn-danger ms-2" onclick="deleteSelected()">
                                    <i class="fas fa-trash me-2"></i>Delete Selected
                                </button>
                            @else
                                <div class="text-center py-4">
                                    <div class="text-muted mb-3">
                                        <i class="fas fa-images fa-3x"></i>
                                    </div>
                                    <h6 class="text-muted">No images uploaded yet.</h6>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Add New Images -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Add New Images</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-3">
                                    <label for="images" class="form-label">Select Images</label>
                                    <input type="file" 
                                           class="form-control" 
                                           id="images" 
                                           name="images[]" 
                                           multiple 
                                           accept="image/*">
                                    <div class="form-text">You can select multiple images at once.</div>
                                </div>

                                <button type="submit" class="btn btn-orange w-100">
                                    <i class="fas fa-upload me-2"></i>Add Images
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all functionality
    const selectAllCheckbox = document.getElementById('select-all');
    const imageCheckboxes = document.querySelectorAll('.image-checkbox');
    
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            imageCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    }

    // Update select all when individual checkboxes change
    imageCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const allChecked = Array.from(imageCheckboxes).every(cb => cb.checked);
            const anyChecked = Array.from(imageCheckboxes).some(cb => cb.checked);
            
            if (selectAllCheckbox) {
                selectAllCheckbox.checked = allChecked;
                selectAllCheckbox.indeterminate = anyChecked && !allChecked;
            }
        });
    });
});

function updatePositions() {
    const positions = [];
    document.querySelectorAll('#images-tbody tr').forEach((row, index) => {
        const imageId = row.dataset.imageId;
        const positionInput = row.querySelector('.position-input');
        positions.push({
            id: imageId,
            position: parseInt(positionInput.value) || index
        });
    });

    fetch(`{{ route('cars.update-image-positions', $car->id) }}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ positions: positions })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Image positions updated successfully!', 'success');
            setTimeout(() => {
                location.reload();
            }, 1000);
        } else {
            showNotification('Error updating positions', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Error updating positions', 'error');
    });
}

function deleteSelected() {
    const selectedCheckboxes = document.querySelectorAll('.image-checkbox:checked');
    
    if (selectedCheckboxes.length === 0) {
        showNotification('Please select images to delete', 'warning');
        return;
    }

    if (!confirm(`Are you sure you want to delete ${selectedCheckboxes.length} image(s)?`)) {
        return;
    }

    const deletePromises = Array.from(selectedCheckboxes).map(checkbox => {
        const row = checkbox.closest('tr');
        const imageId = row.dataset.imageId;
        
        return fetch(`{{ route('cars.delete-image', ['car' => $car->id, 'image' => ':imageId']) }}`.replace(':imageId', imageId), {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
    });

    Promise.all(deletePromises)
        .then(responses => {
            const allSuccess = responses.every(response => response.ok);
            if (allSuccess) {
                showNotification('Selected images deleted successfully!', 'success');
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                showNotification('Error deleting some images', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error deleting images', 'error');
        });
}

function showNotification(message, type) {
    const alertClass = type === 'success' ? 'alert-success' : 
                      type === 'error' ? 'alert-danger' : 'alert-warning';
    
    const notification = document.createElement('div');
    notification.className = `alert ${alertClass} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 5000);
}
</script>

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

.position-input {
    text-align: center;
}

.table th {
    border-top: none;
    font-weight: 600;
}
</style>
@endsection 