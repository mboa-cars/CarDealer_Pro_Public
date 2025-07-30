@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1" style="color: #333; font-size: 2.2rem;">Manage Images</h2>
                    <p class="text-muted mb-0" style="font-size: 1rem;">Organize and update images for {{ $car->year }} - {{ $car->brand }} {{ $car->model }}</p>
                </div>
                <a href="{{ route('cars.my-cars') }}" class="btn-back">
                    <i class="fas fa-arrow-left me-2"></i>Back to My Cars
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; border-radius: 12px;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-3" style="font-size: 1.2rem;"></i>
                        <div>
                            <strong>Success!</strong> {{ session('success') }}
                        </div>
                    </div>
                </div>
            @endif

            <div class="row g-4">
                <!-- Existing Images -->
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                        <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                            <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                                <i class="fas fa-images me-2" style="color: #F26522;"></i>Existing Images
                            </h5>
                        </div>
                        <div class="card-body" style="padding: 1.5rem;">
                            @if($car->images->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover modern-table">
                                        <thead>
                                            <tr>
                                                <th style="width: 50px;">
                                                    <div class="form-check">
                                                        <input type="checkbox" id="select-all" class="form-check-input modern-checkbox">
                                                    </div>
                                                </th>
                                                <th>Image</th>
                                                <th style="width: 120px;">Position</th>
                                            </tr>
                                        </thead>
                                        <tbody id="images-tbody">
                                            @foreach($car->images as $image)
                                                <tr data-image-id="{{ $image->id }}" class="image-row">
                                                    <td>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input modern-checkbox image-checkbox">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if($image->image_url)
                                                            <div class="image-preview">
                                                                <img src="{{ $image->image_url }}" 
                                                                     alt="Car Image" 
                                                                     class="rounded" 
                                                                     style="width: 100px; height: 75px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                                            </div>
                                                        @else
                                                            <div class="image-placeholder d-flex align-items-center justify-content-center rounded" 
                                                                 style="width: 100px; height: 75px; background-color: #f8f9fa; color: #6c757d; border-radius: 8px;">
                                                                <i class="fas fa-car"></i>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input type="number" 
                                                               class="form-control modern-input position-input" 
                                                               value="{{ $image->position }}" 
                                                               min="0" 
                                                               style="width: 80px; text-align: center;">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex gap-3 mt-4">
                                    <button type="button" class="btn btn-lg flex-fill" onclick="updatePositions()" style="background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); color: white; border: none; border-radius: 12px; padding: 15px; font-weight: 600; font-size: 1.1rem; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(242, 101, 34, 0.3);">
                                        <i class="fas fa-save me-2"></i>Update Images
                                    </button>
                                    <button type="button" class="btn btn-lg flex-fill" onclick="deleteSelected()" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: white; border: none; border-radius: 12px; padding: 15px; font-weight: 600; font-size: 1.1rem; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);">
                                        <i class="fas fa-trash me-2"></i>Delete Selected
                                    </button>
                                </div>
                            @else
                                <div class="text-center py-6">
                                    <div class="empty-state">
                                        <i class="fas fa-images fa-4x mb-4" style="color: #ddd;"></i>
                                        <h6 class="text-muted mb-2">No Images Yet</h6>
                                        <small class="text-muted">Upload some images to get started</small>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Add New Images -->
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%); position: sticky; top: 20px;">
                        <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                            <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                                <i class="fas fa-plus me-2" style="color: #F26522;"></i>Add New Images
                            </h5>
                        </div>
                        <div class="card-body" style="padding: 1.5rem;">
                            <form action="{{ route('cars.add-images', $car->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="mb-4">
                                    <label for="images" class="form-label fw-semibold" style="color: #555;">Select Images</label>
                                    <div class="upload-area" id="uploadArea">
                                        <input type="file" 
                                               class="form-control" 
                                               id="images" 
                                               name="images[]" 
                                               multiple 
                                               accept="image/*" 
                                               style="display: none;">
                                        <div class="upload-content">
                                            <i class="fas fa-cloud-upload-alt fa-2x mb-3" style="color: #F26522;"></i>
                                            <h6 class="mb-2">Drop images here or click to browse</h6>
                                            <p class="text-muted mb-0">You can select multiple images at once</p>
                                        </div>
                                    </div>
                                    <div id="preview-images" class="d-flex flex-wrap gap-2 mt-3"></div>
                                </div>

                                <button type="submit" class="btn btn-lg w-100" style="background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); color: white; border: none; border-radius: 12px; padding: 15px; font-weight: 600; font-size: 1.1rem; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(242, 101, 34, 0.3);">
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

/* Modern Table Styles */
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
    padding: 1rem;
}

.modern-table td {
    border: none;
    padding: 1rem;
    vertical-align: middle;
}

.image-row {
    transition: all 0.3s ease;
}

.image-row:hover {
    background: linear-gradient(135deg, #fff8f0 0%, #fff5f0 100%);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(242, 101, 34, 0.1);
}

/* Modern Checkbox */
.modern-checkbox {
    width: 18px;
    height: 18px;
    border: 2px solid #e9ecef;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.modern-checkbox:checked {
    background-color: #F26522;
    border-color: #F26522;
}

.modern-checkbox:focus {
    box-shadow: 0 0 0 0.2rem rgba(242, 101, 34, 0.25);
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

/* Position Input */
.position-input {
    text-align: center;
    font-weight: 600;
}

/* Responsive Design */
@media (max-width: 768px) {
    .btn-back {
        padding: 10px 16px;
        font-size: 0.9rem;
    }
    
    .modern-table {
        font-size: 0.9rem;
    }
    
    .image-preview img,
    .image-placeholder {
        width: 80px !important;
        height: 60px !important;
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

/* Button Hover Effects */
.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.2);
}
</style>

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

    // Upload Area Interactions
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('images');

    if (uploadArea && fileInput) {
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
    }
});

function handleFileSelect() {
    const preview = document.getElementById('preview-images');
    const fileInput = document.getElementById('images');
    
    if (!preview || !fileInput) return;
    
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

    // Show loading state
    const updateBtn = document.querySelector('button[onclick="updatePositions()"]');
    const originalText = updateBtn.innerHTML;
    updateBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Updating...';
    updateBtn.disabled = true;

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
    })
    .finally(() => {
        updateBtn.innerHTML = originalText;
        updateBtn.disabled = false;
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

    // Show loading state
    const deleteBtn = document.querySelector('button[onclick="deleteSelected()"]');
    const originalText = deleteBtn.innerHTML;
    deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Deleting...';
    deleteBtn.disabled = true;

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
        })
        .finally(() => {
            deleteBtn.innerHTML = originalText;
            deleteBtn.disabled = false;
        });
}

function showNotification(message, type) {
    const alertClass = type === 'success' ? 'alert-success' : 
                      type === 'error' ? 'alert-danger' : 'alert-warning';
    
    const notification = document.createElement('div');
    notification.className = `alert ${alertClass} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);';
    notification.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-triangle' : 'fa-info-circle'} me-2"></i>
            <div>${message}</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 5000);
}
</script>
@endsection 