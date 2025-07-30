<div class="col-md-3 mb-4">
    <div class="card h-100 d-flex flex-column shadow-sm" style="min-height: 400px; border-radius: 20px; overflow: hidden; border: none; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);">
        <!-- Image Section -->
        <div class="position-relative" style="height: 180px; background: linear-gradient(135deg, #20B2AA 0%, #48D1CC 100%); overflow: hidden;">
            @if($car->main_image)
                <img src="{{ $car->main_image }}" class="w-100 h-100" alt="Car" 
                     style="object-fit: cover;">
            @else
                <div class="d-flex align-items-center justify-content-center h-100" 
                     style="background: linear-gradient(135deg, #20B2AA 0%, #48D1CC 100%); color: white; font-size: 1.2rem; font-weight: 600; text-align: center; padding: 20px;">
                    {{ $car->brand }} {{ $car->model }}
                </div>
            @endif
            
            <!-- Overlay effect -->
            <div class="position-absolute top-0 start-0 w-100 h-100" 
                 style="background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 100%); opacity: 0;"></div>
        </div>
        
        <!-- Content Section -->
        <div class="card-body d-flex flex-column flex-grow-1 p-4" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
            <!-- Header with location and favorite -->
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="text-muted small" style="color: #6c757d; font-size: 0.9rem; font-weight: 500;">
                    <i class="fas fa-map-marker-alt me-1" style="color: #F26522;"></i>
                    {{ $car->city ?? '-' }}
                </div>
                @php
                    $isFavorited = false;
                    if (Auth::check()) {
                        $isFavorited = Auth::user()->carsFavorited->contains($car->id);
                    } else {
                        $favorites = session('favorites', []);
                        $isFavorited = in_array($car->id, $favorites);
                    }
                @endphp
                <form method="POST" action="{{ $isFavorited ? route('cars.unfavorite', $car->id) : route('cars.favorite', $car->id) }}" class="d-inline favorite-form m-0" data-car-id="{{ $car->id }}" style="margin: 0;">
                    @csrf
                    @if($isFavorited)
                        @method('DELETE')
                    @endif
                    <button type="submit" class="btn p-0 border-0 bg-transparent favorite-btn d-flex align-items-center justify-content-center" 
                            style="color: #F26522; font-size: 1.3rem; cursor: pointer; padding: 8px; margin: 0; border-radius: 50%; width: 40px; height: 40px; background: rgba(242, 101, 34, 0.1); transition: all 0.3s ease;">
                        {!! $isFavorited ? '&#9829;' : '&#9825;' !!}
                    </button>
                </form>
            </div>
            
            <!-- Car details -->
            <div class="fw-bold mb-3" style="font-size: 1.2rem; color: #212529; line-height: 1.3; font-weight: 700;">
                {{ $car->year }} - {{ $car->brand }} {{ $car->model }}
            </div>
            
            <!-- Price -->
            <div class="fw-bold mb-4" style="color: #F26522; font-size: 1.4rem; font-weight: 700; text-shadow: 0 1px 2px rgba(242, 101, 34, 0.1);">
                ${{ number_format($car->price, 0, '', ' ') }}
            </div>
            
            <!-- Divider -->
            <hr style="margin: 0.5rem 0; border-color: rgba(255, 255, 255, 0.3); border-width: 1px;">
            
            <!-- Tags -->
            <div class="mb-4">
                @if(!empty($car->type))
                    <span class="badge me-2" style="background: linear-gradient(135deg, rgba(242, 101, 34, 0.1) 0%, rgba(242, 101, 34, 0.2) 100%); color: #F26522; border: 1px solid rgba(242, 101, 34, 0.3); padding: 0.5rem 0.8rem; font-size: 0.8rem; border-radius: 12px; font-weight: 600; backdrop-filter: blur(5px); -webkit-backdrop-filter: blur(5px);">{{ $car->type }}</span>
                @endif
                @if(!empty($car->fuel_type))
                    <span class="badge" style="background: linear-gradient(135deg, rgba(242, 101, 34, 0.1) 0%, rgba(242, 101, 34, 0.2) 100%); color: #F26522; border: 1px solid rgba(242, 101, 34, 0.3); padding: 0.5rem 0.8rem; font-size: 0.8rem; border-radius: 12px; font-weight: 600; backdrop-filter: blur(5px); -webkit-backdrop-filter: blur(5px);">{{ $car->fuel_type }}</span>
                @endif
            </div>
            
            <!-- View details button -->
            <div class="mt-auto">
                <a href="{{ route('cars.show', $car->id) }}" class="btn w-100" 
                   style="background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); color: white; border: none; border-radius: 12px; padding: 12px; font-weight: 600; text-decoration: none; display: block; text-align: center; box-shadow: 0 4px 15px rgba(242, 101, 34, 0.3); position: relative; overflow: hidden;">
                    <span style="position: relative; z-index: 2;">
                        <i class="fas fa-eye me-2"></i>Voir détails
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
/* Styles pour le bouton favori */
.favorite-btn:hover {
    transform: scale(1.1);
    background: rgba(242, 101, 34, 0.2) !important;
    box-shadow: 0 4px 15px rgba(242, 101, 34, 0.3);
}

.favorite-btn:active {
    transform: scale(0.95);
}

/* Animation pour le changement d'état du favori */
.favorite-btn {
    transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.favorite-btn:hover {
    animation: heartBeat 0.6s ease-in-out;
}

@keyframes heartBeat {
    0% { transform: scale(1); }
    14% { transform: scale(1.1); }
    28% { transform: scale(1); }
    42% { transform: scale(1.1); }
    70% { transform: scale(1); }
}
</style> 