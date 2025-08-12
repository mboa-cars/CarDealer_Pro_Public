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
                <h5 class="fw-bold mb-3" style="color: #2c3e50;">Informations du vendeur</h5>
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-orange rounded-circle d-flex align-items-center justify-content-center me-3" style="width:60px;height:60px; box-shadow: 0 4px 15px rgba(242, 101, 34, 0.3);">
                        <i class="fas fa-user text-white fa-lg"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-5" style="color: #2c3e50;">{{ $car->user ? $car->user->name : 'Elva Graham' }}</div>
                        <div class="text-muted">{{ $car->user ? $car->user->cars()->count() : '26' }} voitures</div>
                        @if($car->user && $car->user->average_rating)
                            <div class="d-flex align-items-center mt-1">
                                <div class="stars-display me-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $car->user->average_rating ? 'text-warning' : 'text-muted' }}" style="font-size: 0.8rem;"></i>
                                    @endfor
                                </div>
                                <small class="text-muted">{{ $car->user->average_rating }}/5 ({{ $car->user->reviews_count }} avis)</small>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="fw-bold fs-5" style="color:#F26522;">{{ $car->phone ?? '123456***' }}</span>
                    <a href="#" class="btn btn-orange btn-sm rounded-pill" style="padding: 8px 16px;">voir le numéro complet</a>
                </div>
                
                <!-- Boutons d'action pour le vendeur -->
                <div class="seller-action-buttons">
                    <a href="{{ route('reviews.seller', $car->user->id) }}" class="btn btn-reviews">
                        <div class="btn-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="btn-content">
                            <span class="btn-title">Voir les avis</span>
                            <span class="btn-subtitle">{{ $car->user->reviews_count ?? 0 }} avis</span>
                        </div>
                        <div class="btn-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>
                    
                    @auth
                        @if(auth()->id() !== $car->user_id)
                            <a href="{{ route('reviews.create', $car->id) }}" class="btn btn-rate-seller">
                                <div class="btn-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="btn-content">
                                    <span class="btn-title">Noter ce vendeur</span>
                                    <span class="btn-subtitle">Partager votre expérience</span>
                                </div>
                                <div class="btn-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-login-to-rate">
                            <div class="btn-icon">
                                <i class="fas fa-sign-in-alt"></i>
                            </div>
                            <div class="btn-content">
                                <span class="btn-title">Connectez-vous</span>
                                <span class="btn-subtitle">Pour noter ce vendeur</span>
                            </div>
                            <div class="btn-arrow">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Subscribe Button -->
            <div class="mt-4">
                @auth
                    @if(auth()->id() !== $car->user_id)
                        <button 
                            id="subscribe-btn" 
                            class="btn btn-lg w-100 rounded-pill subscription-btn {{ $isFollowing ? 'btn-outline-danger' : 'btn-danger' }}" 
                            style="padding: 15px; font-weight: 600; box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3); transition: all 0.3s ease;"
                            onclick="toggleSubscription({{ $car->user_id }})"
                        >
                            <i class="fas {{ $isFollowing ? 'fa-check' : 'fa-play' }} me-2"></i>
                            <span id="subscribe-text">{{ $isFollowing ? 'Abonné' : 'S\'abonner' }}</span>
                        </button>
                        <div class="text-center mt-2">
                            <small class="text-muted">
                                <span id="followers-count">{{ $followersCount }}</span> abonné{{ $followersCount > 1 ? 's' : '' }}
                            </small>
                        </div>
                    @else
                        <div class="alert alert-info rounded-pill text-center" style="background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%); border: none;">
                            <i class="fas fa-info-circle me-2"></i>C'est votre annonce
                        </div>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-danger btn-lg w-100 rounded-pill" style="padding: 15px; font-weight: 600; box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);">
                        <i class="fas fa-sign-in-alt me-2"></i>Connectez-vous pour vous abonner
                    </a>
                @endauth
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

.subscription-btn {
    transition: all 0.3s ease;
}

.subscription-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4) !important;
}

/* Styles pour les boutons d'action du vendeur */
.seller-action-buttons {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-top: 1.5rem;
}

.seller-action-buttons .btn {
    display: flex;
    align-items: center;
    padding: 1rem 1.25rem;
    border-radius: 16px;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    border: none;
    position: relative;
    overflow: hidden;
    min-height: 70px;
}

.seller-action-buttons .btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.seller-action-buttons .btn:hover::before {
    left: 100%;
}

.seller-action-buttons .btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.btn-icon {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    font-size: 1.2rem;
    color: white;
    flex-shrink: 0;
}

.btn-content {
    flex: 1;
    text-align: left;
}

.btn-title {
    display: block;
    font-weight: 700;
    font-size: 1rem;
    color: white;
    margin-bottom: 0.25rem;
    line-height: 1.2;
}

.btn-subtitle {
    display: block;
    font-size: 0.875rem;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 500;
    line-height: 1.2;
}

.btn-arrow {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.875rem;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.seller-action-buttons .btn:hover .btn-arrow {
    background: rgba(255, 255, 255, 0.3);
    transform: translateX(3px);
}

/* Bouton Voir les avis */
.btn-reviews {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

.btn-reviews:hover {
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
}

.btn-reviews .btn-icon {
    background: rgba(255, 255, 255, 0.2);
}

/* Bouton Noter ce vendeur */
.btn-rate-seller {
    background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
    box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3);
}

.btn-rate-seller:hover {
    background: linear-gradient(135deg, #ea580c 0%, #dc2626 100%);
    box-shadow: 0 8px 25px rgba(249, 115, 22, 0.4);
}

.btn-rate-seller .btn-icon {
    background: rgba(255, 255, 255, 0.2);
}

/* Bouton Connectez-vous */
.btn-login-to-rate {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
}

.btn-login-to-rate:hover {
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
}

.btn-login-to-rate .btn-icon {
    background: rgba(255, 255, 255, 0.2);
}

/* Animation d'entrée pour les boutons */
.seller-action-buttons .btn {
    animation: slideInUp 0.6s ease-out;
}

.seller-action-buttons .btn:nth-child(2) {
    animation-delay: 0.1s;
}

.seller-action-buttons .btn:nth-child(3) {
    animation-delay: 0.2s;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive design pour les boutons */
@media (max-width: 768px) {
    .seller-action-buttons .btn {
        padding: 0.875rem 1rem;
        min-height: 60px;
    }
    
    .btn-icon {
        width: 40px;
        height: 40px;
        font-size: 1.1rem;
        margin-right: 0.75rem;
    }
    
    .btn-title {
        font-size: 0.95rem;
    }
    
    .btn-subtitle {
        font-size: 0.8rem;
    }
    
    .btn-arrow {
        width: 28px;
        height: 28px;
        font-size: 0.8rem;
    }
}

/* Effet de focus pour l'accessibilité */
.seller-action-buttons .btn:focus {
    outline: 3px solid rgba(59, 130, 246, 0.5);
    outline-offset: 2px;
}

/* Animation de pulsation pour attirer l'attention */
@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}

.btn-rate-seller {
    animation: slideInUp 0.6s ease-out, pulse 2s ease-in-out infinite 1s;
}
</style>

<script>
// Fonction pour basculer l'abonnement
async function toggleSubscription(sellerId) {
    const btn = document.getElementById('subscribe-btn');
    const icon = btn.querySelector('i');
    const text = document.getElementById('subscribe-text');
    const followersCount = document.getElementById('followers-count');
    
    // Désactiver le bouton pendant la requête
    btn.disabled = true;
    btn.style.opacity = '0.7';
    
    try {
        const response = await fetch(`/subscribe/${sellerId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Mettre à jour l'interface
            if (data.is_subscribed) {
                // Maintenant abonné
                btn.className = 'btn btn-lg w-100 rounded-pill subscription-btn btn-outline-danger';
                icon.className = 'fas fa-check me-2';
                text.textContent = 'Abonné';
            } else {
                // Plus abonné
                btn.className = 'btn btn-lg w-100 rounded-pill subscription-btn btn-danger';
                icon.className = 'fas fa-play me-2';
                text.textContent = 'S\'abonner';
            }
            
            // Mettre à jour le nombre d'abonnés
            followersCount.textContent = data.followers_count;
            
            // Afficher un message de succès
            showNotification(data.message, 'success');
        } else {
            showNotification(data.message, 'error');
        }
    } catch (error) {
        console.error('Erreur:', error);
        showNotification('Une erreur est survenue. Veuillez réessayer.', 'error');
    } finally {
        // Réactiver le bouton
        btn.disabled = false;
        btn.style.opacity = '1';
    }
}

// Fonction pour afficher les notifications
function showNotification(message, type) {
    // Créer l'élément de notification
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'success' ? 'success' : 'danger'} position-fixed`;
    notification.style.cssText = `
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        animation: slideInRight 0.3s ease-out;
    `;
    
    notification.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
            <span>${message}</span>
            <button type="button" class="btn-close ms-auto" onclick="this.parentElement.parentElement.remove()"></button>
        </div>
    `;
    
    // Ajouter au DOM
    document.body.appendChild(notification);
    
    // Supprimer automatiquement après 5 secondes
    setTimeout(() => {
        if (notification.parentElement) {
            notification.remove();
        }
    }, 5000);
}

// Ajouter les styles d'animation
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    .stars-display {
        display: inline-flex;
        gap: 2px;
    }
`;
document.head.appendChild(style);
</script>
@endsection 