@extends('layouts.app')

@section('content')
<div class="mb-3">
    <a href="{{ route('cars.index') }}" class="btn btn-outline-secondary" style="border-color:#F26522; color:#F26522;" onmouseover="this.style.background='#F26522'; this.style.color='white'" onmouseout="this.style.background='transparent'; this.style.color='#F26522'">
        ← Retour à la liste
    </a>
</div>

<div class="bg-white rounded-4 shadow-sm p-4 mb-4">
    <div class="row">
        <!-- Galerie d'images et vidéo -->
        <div class="col-md-7">
            <div class="mb-3">
                <!-- Video Player -->
                @if($car->video_url)
                    <div class="position-relative mb-3">
                        <video id="car-video" class="w-100 rounded-3" style="max-height:400px;object-fit:cover;" controls>
                            <source src="{{ $car->video_url }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <!-- Video Controls Overlay -->
                        <div class="position-absolute bottom-0 start-0 end-0 p-3" style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                            <div class="d-flex justify-content-between align-items-center text-white">
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-sm btn-outline-light me-2" onclick="togglePlay()">
                                        <i class="fas fa-play" id="play-icon"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-light me-2" onclick="skipBackward()">
                                        <i class="fas fa-backward"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-light me-2" onclick="skipForward()">
                                        <i class="fas fa-forward"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-light me-2" onclick="toggleMute()">
                                        <i class="fas fa-volume-up" id="volume-icon"></i>
                                    </button>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-sm btn-outline-light me-2" onclick="togglePlaylist()">
                                        <i class="fas fa-list"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-light me-2" onclick="toggleSettings()">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-light me-2" onclick="togglePictureInPicture()">
                                        <i class="fas fa-external-link-alt"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-light" onclick="toggleFullscreen()">
                                        <i class="fas fa-expand"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Main Image -->
                    <div class="position-relative mb-3">
                        @if($car->main_image)
                            <img id="main-image" src="{{ $car->main_image }}" 
                                 class="img-fluid rounded-3 w-100" 
                                 style="max-height:400px;object-fit:cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center rounded-3 w-100" 
                                 style="max-height:400px; background-color: #f8f9fa; color: #6c757d;">
                                <i class="fas fa-car fa-5x"></i>
                            </div>
                        @endif
                        
                        <!-- Navigation arrows for images -->
                        @if($car->images->count() > 1)
                            <button class="btn btn-light position-absolute top-50 start-0 translate-middle-y ms-2" onclick="previousImage()">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="btn btn-light position-absolute top-50 end-0 translate-middle-y me-2" onclick="nextImage()">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        @endif
                    </div>
                @endif

                <!-- Thumbnail Gallery -->
                @if($car->images->count() > 0)
                    <div class="d-flex gap-2 mb-3 overflow-auto">
                        @foreach($car->images as $index => $image)
                            @if($image->image_url)
                                <img src="{{ $image->image_url }}" 
                                     class="rounded-3 thumbnail-image" 
                                     style="width:70px;height:50px;object-fit:cover;cursor:pointer;"
                                     onclick="showImage({{ $index }})"
                                     data-index="{{ $index }}">
                            @else
                                <div class="rounded-3 thumbnail-image d-flex align-items-center justify-content-center" 
                                     style="width:70px;height:50px;background-color:#f8f9fa;color:#6c757d;cursor:pointer;"
                                     onclick="showImage({{ $index }})"
                                     data-index="{{ $index }}">
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
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h3 class="fw-bold mb-0">{{ $car->brand }} {{ $car->model }} - {{ $car->year }}</h3>
                <div class="d-flex align-items-center">
                    <span class="fs-4 fw-bold me-3" style="color:#F26522;">{{ $car->formatted_price }}</span>
                    @auth
                        @php
                            $isFavorited = auth()->user()->carsFavorited->contains($car->id);
                        @endphp
                        <form method="POST" action="{{ $isFavorited ? route('cars.unfavorite', $car->id) : route('cars.favorite', $car->id) }}" class="favorite-form" style="display:inline;" data-car-id="{{ $car->id }}">
                            @csrf
                            @if($isFavorited)
                                @method('DELETE')
                            @endif
                            <button type="submit" class="btn favorite-btn {{ $isFavorited ? 'btn-warning' : 'btn-outline-warning' }}">
                                {!! $isFavorited ? '&#9829;' : '&#9825;' !!}
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
            <div class="mb-2 text-muted">{{ $car->city ?? 'City' }} - {{ $car->created_at->format('Y-m-d H:i:s') }}</div>
            <div class="mb-3">
                <span class="badge bg-light text-dark border me-1">{{ $car->type ?? 'SUV' }}</span>
                <span class="badge bg-light text-dark border">{{ $car->fuel_type ?? 'Hybrid' }}</span>
            </div>

            <!-- Car Specifications -->
            <div class="mb-3">
                <h6 class="fw-bold mb-2">Car Specifications</h6>
                <div class="row">
                    <div class="col-6">
                        <small class="text-muted">Maker:</small><br>
                        <strong>{{ $car->brand }}</strong>
                    </div>
                    <div class="col-6">
                        <small class="text-muted">Model:</small><br>
                        <strong>{{ $car->model }}</strong>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-6">
                        <small class="text-muted">Year:</small><br>
                        <strong>{{ $car->year }}</strong>
                    </div>
                    <div class="col-6">
                        <small class="text-muted">Vin:</small><br>
                        <strong>{{ $car->vin ?? 'N/A' }}</strong>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-6">
                        <small class="text-muted">Mileage:</small><br>
                        <strong>{{ $car->formatted_mileage }}</strong>
                    </div>
                    <div class="col-6">
                        <small class="text-muted">Car Type:</small><br>
                        <strong>{{ $car->type ?? 'SUV' }}</strong>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-6">
                        <small class="text-muted">Fuel Type:</small><br>
                        <strong>{{ $car->fuel_type ?? 'Hybrid' }}</strong>
                    </div>
                    <div class="col-6">
                        <small class="text-muted">Address:</small><br>
                        <strong>{{ $car->address ?? 'Address 1' }}</strong>
                    </div>
                </div>
            </div>

            <!-- Seller Information -->
            <div class="border-top pt-3">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-orange rounded-circle d-flex align-items-center justify-content-center me-3" style="width:48px;height:48px;">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div>
                        <div class="fw-bold">{{ $car->user ? $car->user->name : 'Elva Graham' }}</div>
                        <div class="text-muted small">{{ $car->user ? $car->user->cars()->count() : '26' }} cars</div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <span class="fw-bold fs-5 me-2" style="color:#F26522;">{{ $car->phone ?? '123456***' }}</span>
                    <a href="#" class="btn btn-orange btn-sm">view full number</a>
                </div>
            </div>

            <!-- Subscribe Button -->
            <div class="mt-3">
                <button class="btn btn-danger btn-sm">
                    <i class="fas fa-play me-1"></i>Subscribe
                </button>
            </div>
        </div>
    </div>

    <!-- Description et spécifications -->
    <div class="row mt-4">
        <div class="col-md-7 mb-3">
            <div class="bg-light rounded-4 p-3 mb-3">
                <h5 class="fw-bold">Detailed Description</h5>
                <div>{{ $car->description ?? 'No description available.' }}</div>
            </div>
        </div>
        <div class="col-md-5 mb-3">
            <div class="bg-light rounded-4 p-3">
                <h5 class="fw-bold">Car Features</h5>
                <ul class="list-unstyled mb-0">
                    @if($car->features)
                        @foreach($car->features as $feature)
                            <li><span class="text-success">&#10003;</span> {{ $feature }}</li>
                        @endforeach
                    @else
                        <li><span class="text-success">&#10003;</span> Air Conditioning</li>
                        <li><span class="text-success">&#10003;</span> Power Windows</li>
                        <li><span class="text-success">&#10003;</span> Power Door Locks</li>
                        <li><span class="text-success">&#10003;</span> ABS</li>
                        <li><span class="text-success">&#10003;</span> Cruise Control</li>
                        <li><span class="text-success">&#10003;</span> Bluetooth Connectivity</li>
                        <li><span class="text-success">&#10003;</span> Remote Start</li>
                        <li><span class="text-success">&#10003;</span> GPS Navigation System</li>
                        <li><span class="text-success">&#10003;</span> Heated Seats</li>
                        <li><span class="text-success">&#10003;</span> Climate Control</li>
                        <li><span class="text-success">&#10003;</span> Rear Parking Sensors</li>
                        <li><span class="text-success">&#10003;</span> Leather Seats</li>
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
            thumb.style.border = i === index ? '2px solid #F26522' : 'none';
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
    const gallery = document.querySelector('.d-flex.gap-2');
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
                button.className = 'btn favorite-btn btn-warning';
                showNotification('Ajouté aux favoris !', 'success');
            } else {
                button.innerHTML = '&#9825;';
                button.className = 'btn favorite-btn btn-outline-warning';
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
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
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
}

.btn-orange:hover {
    background-color: #d54d1a;
    border-color: #d54d1a;
    color: white;
}

.bg-orange {
    background-color: #F26522 !important;
}

.thumbnail-image:hover {
    opacity: 0.8;
}

.favorite-btn {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

#car-video::-webkit-media-controls {
    display: none;
}

#car-video::-webkit-media-controls-panel {
    display: none;
}
</style>
@endsection 