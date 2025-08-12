@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); min-height: 100vh;">
    <div class="row mb-4">
        <div class="col-12">
            <div class="position-relative overflow-hidden" style="border-radius: 20px; background: linear-gradient(135deg, #F26522 0%, #ea6500 50%, #ff8c42 100%); box-shadow: 0 15px 35px rgba(242, 101, 34, 0.3);">
                <div class="position-absolute" style="top: -20px; right: -20px; width: 150px; height: 150px; background: rgba(255, 255, 255, 0.1); border-radius: 50%;"></div>
                <div class="position-absolute" style="bottom: -30px; left: -30px; width: 100px; height: 100px; background: rgba(255, 255, 255, 0.08); border-radius: 50%;"></div>
                <div class="position-absolute" style="top: 50%; right: 10%; width: 60px; height: 60px; background: rgba(255, 255, 255, 0.05); border-radius: 50%;"></div>
                <div class="p-5 position-relative">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="d-flex align-items-center mb-3 header-main">
                                <div class="me-4 position-relative">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center shadow-lg position-relative header-icon glow-effect" style="width: 80px; height: 80px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); border: 2px solid rgba(255, 255, 255, 0.3);">
                                        <i class="fas fa-user-friends text-white" style="font-size: 2rem;"></i>
                                    </div>
                                    <div class="position-absolute" style="top: 10px; left: 10px; width: 20px; height: 20px; background: rgba(255, 255, 255, 0.4); border-radius: 50%; filter: blur(5px);"></div>
                                </div>
                                <div>
                                    <h1 class="fw-bold mb-2 text-white" style="font-size: 3rem; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">
                                        Liste des abonnements
                                    </h1>
                                    <p class="text-white mb-0" style="font-size: 1.2rem; opacity: 0.9; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);">
                                        <i class="fas fa-users me-2"></i>Vue d'ensemble de tous les abonnements de la plateforme
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-center header-stats">
                                <div class="d-flex justify-content-center mb-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3 header-icon" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                        <i class="fas fa-user-friends text-white"></i>
                                    </div>
                                </div>
                                <div class="text-white">
                                    <div class="fw-bold mb-1" style="font-size: 1.5rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);">
                                        {{ $subscriptions->total() }}
                                    </div>
                                    <div style="font-size: 0.9rem; opacity: 0.8;">Total d'abonnements</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 header-progress">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 me-3">
                                <div class="progress" style="height: 8px; background: rgba(255, 255, 255, 0.2); border-radius: 10px; overflow: hidden;">
                                    <div class="progress-bar" style="background: linear-gradient(90deg, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0.6) 100%); width: 75%; border-radius: 10px;"></div>
                                </div>
                            </div>
                            <div class="text-white" style="font-size: 0.9rem; opacity: 0.8;">
                                <i class="fas fa-chart-line me-1"></i>Suivi en temps réel
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                                <tr>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-user me-2" style="color: #F26522;"></i>Abonné
                                    </th>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-envelope me-2" style="color: #F26522;"></i>Email abonné
                                    </th>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-store me-2" style="color: #F26522;"></i>Vendeur
                                    </th>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-envelope me-2" style="color: #F26522;"></i>Email vendeur
                                    </th>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-shield-alt me-2" style="color: #F26522;"></i>Statut
                                    </th>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-calendar me-2" style="color: #F26522;"></i>Date d'abonnement
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subscriptions as $subscription)
                                    <tr style="transition: all 0.3s ease; border-bottom: 1px solid #f0f0f0;">
                                        <td class="px-4 py-3">
                                            <p class="fw-semibold mb-1" style="color: #333;">{{ $subscription->subscriber->name ?? '-' }}</p>
                                        </td>
                                        <td class="px-4 py-3">
                                            <p class="text-muted mb-0" style="font-size: 0.85rem;">{{ $subscription->subscriber->email ?? '-' }}</p>
                                        </td>
                                        <td class="px-4 py-3">
                                            <p class="fw-semibold mb-1" style="color: #333;">{{ $subscription->seller->name ?? '-' }}</p>
                                        </td>
                                        <td class="px-4 py-3">
                                            <p class="text-muted mb-0" style="font-size: 0.85rem;">{{ $subscription->seller->email ?? '-' }}</p>
                                        </td>
                                        <td class="px-4 py-3">
                                            @if($subscription->is_active)
                                                <span class="badge" style="background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%); color: white; padding: 8px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                                                    <i class="fas fa-check-circle me-1"></i>Actif
                                                </span>
                                            @else
                                                <span class="badge" style="background: linear-gradient(135deg, #6c757d 0%, #495057 100%); color: white; padding: 8px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                                                    <i class="fas fa-pause-circle me-1"></i>Inactif
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="badge" style="background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); color: white; padding: 8px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                                                {{ optional($subscription->subscribed_at)->format('d/m/Y') ?? '-' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-user-friends text-muted mb-3" style="font-size: 3rem;"></i>
                                                <p class="text-muted mb-0">Aucun abonnement trouvé</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($subscriptions->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <nav aria-label="Pagination des abonnements">
                        {{ $subscriptions->links() }}
                    </nav>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
/* Styles harmonisés avec les autres pages admin */
.card { transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
.card:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important; }
.table tbody tr { transition: all 0.3s ease; }
.table tbody tr:hover { background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important; transform: scale(1.01); }
.badge { transition: all 0.3s ease; }
.badge:hover { transform: scale(1.05); }

/* Animations pour l'en-tête */
@keyframes slideInFromLeft { from { opacity: 0; transform: translateX(-50px); } to { opacity: 1; transform: translateX(0); } }
@keyframes slideInFromRight { from { opacity: 0; transform: translateX(50px); } to { opacity: 1; transform: translateX(0); } }
.header-main { animation: slideInFromLeft 1s ease-out; }
.header-stats { animation: slideInFromRight 1s ease-out 0.3s both; }
.header-icon { animation: float 3s ease-in-out infinite; }
@keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-10px); } }
.header-progress { animation: slideInFromLeft 1s ease-out 0.6s both; }

/* Pagination */
.pagination .page-link { border-radius: 8px; margin: 0 2px; border: none; color: #666; font-weight: 600; transition: all 0.3s ease; }
.pagination .page-link:hover { background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); color: white; transform: translateY(-2px); }
.pagination .page-item.active .page-link { background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); border-color: #F26522; color: white; }
.pagination .page-item.disabled .page-link { color: #ccc; background: #f8f9fa; }

/* Responsive */
@media (max-width: 768px) {
    .table-responsive { font-size: 0.9rem; }
    .badge { padding: 6px 10px !important; font-size: 0.75rem !important; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() { this.style.transform = 'translateY(-5px)'; });
        card.addEventListener('mouseleave', function() { this.style.transform = 'translateY(0)'; });
    });
});
</script>
@endsection
