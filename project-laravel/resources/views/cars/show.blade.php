@extends('layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('cars.index') }}" class="btn btn-outline-secondary" style="border-color:#F26522; color:#F26522; border-radius: 12px; padding: 12px 20px; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.background='#F26522'; this.style.color='white'" onmouseout="this.style.background='transparent'; this.style.color='#F26522'">
        <i class="fas fa-arrow-left me-2"></i>Retour à la liste
    </a>
</div>

<div class="bg-white rounded-4 shadow-lg p-5 mb-4" style="border: none; background: linear-gradient(135deg, #ffffff 0%, #fafafa 100%);">
    <div class="row">
        <!-- Galerie d'images et vidéo -->
        <div class="col-md-7">
            <div class="mb-4">
                <!-- Video Player -->
                @if($car->video_url)
                    <div class="position-relative mb-4">
                        <video id="car-video" class="w-100 rounded-4" style="max-height:450px;object-fit:cover; box-shadow: 0 10px 30px rgba(0,0,0,0.1);" controls>
                            <source src="{{ $car->video_url }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <!-- Video Controls Overlay -->
                        <div class="position-absolute bottom-0 start-0 end-0 p-4" style="background: linear-gradient(transparent, rgba(0,0,0,0.8));">
                            <div class="d-flex justify-content-between align-items-center text-white">
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-sm btn-outline-light me-2 rounded-pill" onclick="togglePlay()" style="backdrop-filter: blur(10px);">
                                        <i class="fas fa-play" id="play-icon"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-light me-2 rounded-pill" onclick="skipBackward()" style="backdrop-filter: blur(10px);">
                                        <i class="fas fa-backward"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-light me-2 rounded-pill" onclick="skipForward()" style="backdrop-filter: blur(10px);">
                                        <i class="fas fa-forward"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-light me-2 rounded-pill" onclick="toggleMute()" style="backdrop-filter: blur(10px);">
                                        <i class="fas fa-volume-up" id="volume-icon"></i>
                                    </button>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-sm btn-outline-light me-2 rounded-pill" onclick="togglePlaylist()" style="backdrop-filter: blur(10px);">
                                        <i class="fas fa-list"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-light me-2 rounded-pill" onclick="toggleSettings()" style="backdrop-filter: blur(10px);">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-light me-2 rounded-pill" onclick="togglePictureInPicture()" style="backdrop-filter: blur(10px);">
                                        <i class="fas fa-external-link-alt"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-light rounded-pill" onclick="toggleFullscreen()" style="backdrop-filter: blur(10px);">
                                        <i class="fas fa-expand"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Main Image -->
                    <div class="position-relative mb-4">
                        @if($car->main_image)
                            <img id="main-image" src="{{ $car->main_image }}" 
                                 class="img-fluid rounded-4 w-100" 
                                 style="max-height:450px;object-fit:cover; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                        @else
                            <div class="d-flex align-items-center justify-content-center rounded-4 w-100" 
                                 style="max-height:450px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); color: #6c757d; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                                <i class="fas fa-car fa-5x"></i>
                            </div>
                        @endif
                        
                        <!-- Navigation arrows for images -->
                        @if($car->images->count() > 1)
                            <button class="btn btn-light position-absolute top-50 start-0 translate-middle-y ms-3 rounded-circle" onclick="previousImage()" style="width: 50px; height: 50px; backdrop-filter: blur(10px); box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="btn btn-light position-absolute top-50 end-0 translate-middle-y me-3 rounded-circle" onclick="nextImage()" style="width: 50px; height: 50px; backdrop-filter: blur(10px); box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        @endif
                    </div>
                @endif

                <!-- Thumbnail Gallery -->
                @if($car->images->count() > 0)
                    <div class="d-flex gap-3 mb-4 overflow-auto">
                        @foreach($car->images as $index => $image)
                            @if($image->image_url)
                                <img src="{{ $image->image_url }}" 
                                     class="rounded-3 thumbnail-image" 
                                     style="width:80px;height:60px;object-fit:cover;cursor:pointer; box-shadow: 0 4px 10px rgba(0,0,0,0.1);"
                                     onclick="showImage({{ $index }})"
                                     data-index="{{ $index }}">
                            @else
                                <div class="rounded-3 thumbnail-image d-flex align-items-center justify-content-center" 
                                     style="width:80px;height:60px;background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);color:#6c757d;cursor:pointer; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                                    <i class="fas fa-car"></i>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Infos principales -->
        <div class="col-md-5">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h2 class="fw-bold mb-2" style="color: #2c3e50; font-size: 2rem;">{{ $car->brand }} {{ $car->model }}</h2>
                    <div class="text-muted mb-2" style="font-size: 1.1rem;">{{ $car->year }}</div>
                    <div class="mb-3 text-muted">
                        <i class="fas fa-map-marker-alt me-2" style="color: #F26522;"></i>
                        {{ $car->city ?? 'City' }} - {{ $car->created_at->format('Y-m-d H:i:s') }}
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="text-end me-3">
                        <div class="fs-2 fw-bold" style="color:#F26522;">{{ $car->formatted_price }}</div>
                        <div class="text-muted small">Prix</div>
                    </div>
                    @auth
                        @php
                            $isFavorited = auth()->user()->carsFavorited->contains($car->id);
                        @endphp
                        <form method="POST" action="{{ $isFavorited ? route('cars.unfavorite', $car->id) : route('cars.favorite', $car->id) }}" class="favorite-form" style="display:inline;" data-car-id="{{ $car->id }}">
                            @csrf
                            @if($isFavorited)
                                @method('DELETE')
                            @endif
                            <button type="submit" class="btn favorite-btn {{ $isFavorited ? 'btn-warning' : 'btn-outline-warning' }} rounded-circle" style="width: 50px; height: 50px; box-shadow: 0 4px 15px rgba(242, 101, 34, 0.3);">
                                {!! $isFavorited ? '&#9829;' : '&#9825;' !!}
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
            
            <div class="mb-4">
                <span class="badge me-2" style="background: linear-gradient(135deg, rgba(242, 101, 34, 0.1) 0%, rgba(242, 101, 34, 0.2) 100%); color: #F26522; border: 1px solid rgba(242, 101, 34, 0.3); padding: 0.6rem 1rem; font-size: 0.9rem; border-radius: 20px; font-weight: 600;">{{ $car->type ?? 'SUV' }}</span>
                <span class="badge" style="background: linear-gradient(135deg, rgba(242, 101, 34, 0.1) 0%, rgba(242, 101, 34, 0.2) 100%); color: #F26522; border: 1px solid rgba(242, 101, 34, 0.3); padding: 0.6rem 1rem; font-size: 0.9rem; border-radius: 20px; font-weight: 600;">{{ $car->fuel_type ?? 'Hybrid' }}</span>
            </div>

            <!-- Car Specifications -->
            <div class="bg-light rounded-4 p-4 mb-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); border: 1px solid #e9ecef;">
                <h5 class="fw-bold mb-3" style="color: #2c3e50;">Car Specifications</h5>
                <div class="row g-3">
                    <div class="col-6">
                        <div class="spec-item">
                            <small class="text-muted d-block">Maker</small>
                            <strong style="color: #2c3e50;">{{ $car->brand }}</strong>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="spec-item">
                            <small class="text-muted d-block">Model</small>
                            <strong style="color: #2c3e50;">{{ $car->model }}</strong>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="spec-item">
                            <small class="text-muted d-block">Year</small>
                            <strong style="color: #2c3e50;">{{ $car->year }}</strong>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="spec-item">
                            <small class="text-muted d-block">Vin</small>
                            <strong style="color: #2c3e50;">{{ $car->vin ?? 'N/A' }}</strong>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="spec-item">
                            <small class="text-muted d-block">Mileage</small>
                            <strong style="color: #2c3e50;">{{ $car->formatted_mileage }}</strong>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="spec-item">
                            <small class="text-muted d-block">Car Type</small>
                            <strong style="color: #2c3e50;">{{ $car->type ?? 'SUV' }}</strong>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="spec-item">
                            <small class="text-muted d-block">Fuel Type</small>
                            <strong style="color: #2c3e50;">{{ $car->fuel_type ?? 'Hybrid' }}</strong>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="spec-item">
                            <small class="text-muted d-block">Address</small>
                            <strong style="color: #2c3e50;">{{ $car->address ?? 'Address 1' }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seller Information -->
            <div class="bg-light rounded-4 p-4 mb-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); border: 1px solid #e9ecef;">
                <h5 class="fw-bold mb-3" style="color: #2c3e50;">Seller Information</h5>
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-orange rounded-circle d-flex align-items-center justify-content-center me-3" style="width:60px;height:60px; box-shadow: 0 4px 15px rgba(242, 101, 34, 0.3);">
                        <i class="fas fa-user text-white fa-lg"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-5" style="color: #2c3e50;">{{ $car->user ? $car->user->name : 'Elva Graham' }}</div>
                        <div class="text-muted">{{ $car->user ? $car->user->cars()->count() : '26' }} cars</div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <span class="fw-bold fs-5" style="color:#F26522;">{{ $car->phone ?? '123456***' }}</span>
                    <a href="#" class="btn btn-orange btn-sm rounded-pill" style="padding: 8px 16px;">view full number</a>
                </div>
            </div>

            <!-- Subscribe Button -->
            <div class="mt-4">
                <button class="btn btn-danger btn-lg w-100 rounded-pill" style="padding: 15px; font-weight: 600; box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);">
                    <i class="fas fa-play me-2"></i>Subscribe
                </button>
            </div>
        </div>
    </div>

    <!-- Description et spécifications -->
    <div class="row mt-5">
        <div class="col-md-7 mb-4">
            <div class="bg-light rounded-4 p-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); border: 1px solid #e9ecef; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                <h5 class="fw-bold mb-3" style="color: #2c3e50;">Detailed Description</h5>
                <div style="color: #555; line-height: 1.7;">{{ $car->description ?? 'No description available.' }}</div>
            </div>
        </div>
        <div class="col-md-5 mb-4">
            <div class="bg-light rounded-4 p-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); border: 1px solid #e9ecef; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                <h5 class="fw-bold mb-3" style="color: #2c3e50;">Car Features</h5>
                <ul class="list-unstyled mb-0">
                    @if($car->features)
                        @foreach($car->features as $feature)
                            <li class="mb-2 d-flex align-items-center">
                                <span class="text-success me-2" style="font-size: 1.2rem;">&#10003;</span> 
                                <span style="color: #555;">{{ $feature }}</span>
                            </li>
                        @endforeach
                    @else
                        <li class="mb-2 d-flex align-items-center">
                            <span class="text-success me-2" style="font-size: 1.2rem;">&#10003;</span> 
                            <span style="color: #555;">Air Conditioning</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <span class="text-success me-2" style="font-size: 1.2rem;">&#10003;</span> 
                            <span style="color: #555;">Power Windows</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <span class="text-success me-2" style="font-size: 1.2rem;">&#10003;</span> 
                            <span style="color: #555;">Power Door Locks</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <span class="text-success me-2" style="font-size: 1.2rem;">&#10003;</span> 
                            <span style="color: #555;">ABS</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <span class="text-success me-2" style="font-size: 1.2rem;">&#10003;</span> 
                            <span style="color: #555;">Cruise Control</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <span class="text-success me-2" style="font-size: 1.2rem;">&#10003;</span> 
                            <span style="color: #555;">Bluetooth Connectivity</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <span class="text-success me-2" style="font-size: 1.2rem;">&#10003;</span> 
                            <span style="color: #555;">Remote Start</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <span class="text-success me-2" style="font-size: 1.2rem;">&#10003;</span> 
                            <span style="color: #555;">GPS Navigation System</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <span class="text-success me-2" style="font-size: 1.2rem;">&#10003;</span> 
                            <span style="color: #555;">Heated Seats</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <span class="text-success me-2" style="font-size: 1.2rem;">&#10003;</span> 
                            <span style="color: #555;">Climate Control</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <span class="text-success me-2" style="font-size: 1.2rem;">&#10003;</span> 
                            <span style="color: #555;">Rear Parking Sensors</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <span class="text-success me-2" style="font-size: 1.2rem;">&#10003;</span> 
                            <span style="color: #555;">Leather Seats</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Video Player Controls Script -->
<script>
let currentImageIndex = 0;
const images = @json($car->images->pluck('image_url')->filter());

function showImage(index) {
    if (images.length > 0 && index >= 0 && index < images.length) {
        currentImageIndex = index;
        document.getElementById('main-image').src = images[index];
        
        // Update thumbnail selection
        document.querySelectorAll('.thumbnail-image').forEach((thumb, i) => {
            thumb.style.border = i === index ? '3px solid #F26522' : 'none';
        });
    }
}

function nextImage() {
    if (images.length > 0) {
        showImage((currentImageIndex + 1) % images.length);
    }
}

function previousImage() {
    if (images.length > 0) {
        showImage(currentImageIndex === 0 ? images.length - 1 : currentImageIndex - 1);
    }
}

// Video player functions
function togglePlay() {
    const video = document.getElementById('car-video');
    const icon = document.getElementById('play-icon');
    
    if (video.paused) {
        video.play();
        icon.className = 'fas fa-pause';
    } else {
        video.pause();
        icon.className = 'fas fa-play';
    }
}

function skipForward() {
    const video = document.getElementById('car-video');
    video.currentTime += 10;
}

function skipBackward() {
    const video = document.getElementById('car-video');
    video.currentTime -= 10;
}

function toggleMute() {
    const video = document.getElementById('car-video');
    const icon = document.getElementById('volume-icon');
    
    video.muted = !video.muted;
    icon.className = video.muted ? 'fas fa-volume-mute' : 'fas fa-volume-up';
}

function togglePlaylist() {
    // Toggle thumbnail gallery visibility
    const gallery = document.querySelector('.d-flex.gap-3');
    if (gallery) {
        gallery.style.display = gallery.style.display === 'none' ? 'flex' : 'none';
    }
}

function toggleSettings() {
    // Show/hide video settings
    alert('Video settings would appear here');
}

function togglePictureInPicture() {
    const video = document.getElementById('car-video');
    if (document.pictureInPictureElement) {
        document.exitPictureInPicture();
    } else if (document.pictureInPictureEnabled) {
        video.requestPictureInPicture();
    }
}

function toggleFullscreen() {
    const video = document.getElementById('car-video');
    if (document.fullscreenElement) {
        document.exitFullscreen();
    } else {
        video.requestFullscreen();
    }
}

// Favorite functionality
document.querySelectorAll('.favorite-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = this;
        const button = this.querySelector('.favorite-btn');
        const originalContent = button.innerHTML;
        
        button.disabled = true;
        button.innerHTML = '...';
        
        fetch(this.action, {
            method: this.querySelector('input[name=_method]')?.value === 'DELETE' ? 'DELETE' : 'POST',
            headers: {
                'X-CSRF-TOKEN': this.querySelector('input[name=_token]').value,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.isFavorited) {
                button.innerHTML = '&#9829;';
                button.className = 'btn favorite-btn btn-warning rounded-circle';
                showNotification('Ajouté aux favoris !', 'success');
            } else {
                button.innerHTML = '&#9825;';
                button.className = 'btn favorite-btn btn-outline-warning rounded-circle';
                showNotification('Retiré des favoris !', 'info');
            }
            
            if (data.isFavorited) {
                formData.action = formData.action.replace('/favorite', '/favorite');
                if (!formData.querySelector('input[name=_method]')) {
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    formData.appendChild(methodInput);
                }
            } else {
                formData.action = formData.action.replace('/favorite', '/favorite');
                const methodInput = formData.querySelector('input[name=_method]');
                if (methodInput) methodInput.remove();
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            button.innerHTML = originalContent;
            showNotification('Erreur lors de l\'opération', 'error');
        })
        .finally(() => {
            button.disabled = false;
        });
    });
});

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'} position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);';
    notification.innerHTML = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>

<style>
.btn-orange {
    background-color: #F26522;
    border-color: #F26522;
    color: white;
    transition: all 0.3s ease;
}

.btn-orange:hover {
    background-color: #d54d1a;
    border-color: #d54d1a;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(242, 101, 34, 0.4);
}

.bg-orange {
    background-color: #F26522 !important;
}

.thumbnail-image {
    transition: all 0.3s ease;
}

.thumbnail-image:hover {
    opacity: 0.8;
    transform: scale(1.05);
}

.favorite-btn {
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.favorite-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(242, 101, 34, 0.4);
}

#car-video::-webkit-media-controls {
    display: none;
}

#car-video::-webkit-media-controls-panel {
    display: none;
}

.spec-item {
    padding: 8px 0;
}

.spec-item small {
    font-size: 0.8rem;
    font-weight: 500;
}

.spec-item strong {
    font-size: 1rem;
}
</style>
@endsection 