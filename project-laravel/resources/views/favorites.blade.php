@extends('layouts.app')

@section('content')
<!-- Header Section -->
<div class="bg-white rounded-4 shadow-sm p-5 mb-5 mx-auto" style="max-width:1200px; border: 1px solid #f0f0f0;">
    <h2 class="fw-bold mb-4" style="color: #333; font-size: 2rem;">
        <i class="fas fa-heart me-2" style="color: #F26522;"></i>
        My Favourite Cars
    </h2>
    
    @guest
        <div class="alert alert-info mb-4" style="background: linear-gradient(135deg, rgba(242, 101, 34, 0.1) 0%, rgba(242, 101, 34, 0.05) 100%); border: 1px solid rgba(242, 101, 34, 0.2); border-radius: 12px; padding: 16px;">
            <div class="d-flex align-items-center">
                <i class="fas fa-info-circle me-3" style="color: #F26522; font-size: 1.2rem;"></i>
                <div>
                    <strong style="color: #F26522;">Favoris temporaires</strong>
                    <p class="mb-0 mt-1" style="color: #666; font-size: 0.95rem;">
                        Vous n'êtes pas connecté. Vos favoris sont sauvegardés temporairement dans votre navigateur. 
                        <a href="{{ route('login') }}" style="color: #F26522; text-decoration: underline;">Connectez-vous</a> 
                        pour les sauvegarder définitivement et les retrouver sur tous vos appareils.
                    </p>
                </div>
            </div>
        </div>
    @endguest
    
    @if($cars->count() > 0)
        <div class="mb-3 text-end" style="font-size:1rem; color:#666;">
            Showing <span style="color:#F26522; font-weight: 600;">{{ $cars->firstItem() }}</span> to <span style="color:#F26522; font-weight: 600;">{{ $cars->lastItem() }}</span> of <span style="color:#F26522; font-weight: 600;">{{ $cars->total() }}</span> favorite cars
        </div>
    @endif
    
    <div class="row g-3">
        @forelse($cars as $car)
            @include('components.car-card', ['car' => $car])
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-heart-broken fa-3x mb-3" style="color: #ddd;"></i>
                    <h4 class="text-muted mb-3">Aucun favori pour le moment</h4>
                    <p class="text-muted mb-4">Vous n'avez pas encore ajouté de voitures à vos favoris.</p>
                    <a href="{{ route('cars.index') }}" class="btn" style="background: #F26522; color: white; border: none; border-radius: 8px; padding: 12px 24px; font-weight: 500; text-decoration: none;">
                        <i class="fas fa-search me-2"></i>
                        Découvrir des voitures
                    </a>
                </div>
            </div>
        @endforelse
    </div>
    
    @if($cars->count() > 0)
        <div class="mt-4 d-flex justify-content-center">
            <div style="font-size:0.95rem;">
                {{ $cars->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    @endif
</div>

<style>
/* Styles personnalisés pour la pagination */
.pagination .page-item.active .page-link {
    background-color: #F26522 !important;
    border-color: #F26522 !important;
    color: white !important;
}

.pagination .page-link {
    color: #F26522 !important;
    border-color: #ddd !important;
    border-radius: 8px !important;
    margin: 0 2px !important;
    padding: 8px 12px !important;
    font-weight: 500 !important;
}

.pagination .page-link:hover {
    background-color: #ffe5d0 !important;
    color: #F26522 !important;
    border-color: #F26522 !important;
}

.pagination .page-item.disabled .page-link {
    color: #6c757d !important;
    background-color: transparent !important;
    border-color: #ddd !important;
}

.pagination .page-item:not(.active):not(.disabled) .page-link:hover {
    background-color: #fff8f0 !important;
    border-color: #F26522 !important;
}
</style>
@endsection

@push('scripts')
<script>
document.addEventListener('click', function(e) {
    const btn = e.target.closest('.favorite-btn');
    if (!btn) return;
    e.preventDefault();
    
    const form = btn.closest('form');
    const carId = form.getAttribute('data-car-id');
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Désactiver le bouton pendant la requête
    btn.disabled = true;
    const originalContent = btn.innerHTML;
    btn.innerHTML = '...';
    
    fetch(`/cars/${carId}/favorite`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        // Retirer la carte de la page
        btn.closest('.col-md-3, .col-md-4, .col').remove();
        
        // Notification
        showNotification('Voiture retirée des favoris', 'info');
        
        // Mettre à jour le compteur si nécessaire
        const countElement = document.querySelector('[data-favorites-count]');
        if (countElement) {
            const currentCount = parseInt(countElement.textContent);
            countElement.textContent = Math.max(0, currentCount - 1);
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        btn.innerHTML = originalContent;
        showNotification('Erreur lors du retrait du favori', 'error');
    })
    .finally(() => {
        btn.disabled = false;
    });
});

function showNotification(message, type) {
    // Remove existing notifications
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(notification => notification.remove());
    
    // Create notification
    const notification = document.createElement('div');
    notification.className = `notification alert alert-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'}`;
    notification.style.cssText = 'position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px; padding: 15px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);';
    notification.innerHTML = message;
    
    document.body.appendChild(notification);
    
    // Remove notification after 3 seconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>
@endpush 