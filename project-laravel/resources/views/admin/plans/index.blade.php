@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); min-height: 100vh;">
    <div class="row mb-4">
        <div class="col-12">
            <div class="position-relative overflow-hidden" style="border-radius: 20px; background: linear-gradient(135deg, #ff7f50 0%, #ff6a00 100%); box-shadow: 0 15px 35px rgba(255, 106, 0, 0.3);">
                <div class="p-5 position-relative">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h1 class="fw-bold mb-2 text-white" style="font-size: 3rem; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">Plans des utilisateurs</h1>
                            <p class="text-white mb-0" style="font-size: 1.1rem; opacity: 0.9;">
                                Vue d'ensemble des comptes Standard et Premium, avec export CSV
                            </p>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <a href="{{ route('admin.plans', ['export' => 'csv']) }}" class="btn btn-light fw-bold" style="border-radius: 10px;">
                                <i class="fas fa-file-csv me-2"></i>Exporter CSV
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-2">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #e9ecef 0%, #ced4da 100%);">
                            <i class="fas fa-user text-dark"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">Standard</h5>
                            <small class="text-muted">Utilisateurs plan Standard</small>
                        </div>
                        <div class="ms-auto fw-bold" style="font-size: 1.4rem;">{{ $stats['standard'] }}</div>
                    </div>
                    <canvas id="chartStandard" height="120"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-2">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);">
                            <i class="fas fa-crown text-dark"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">Premium</h5>
                            <small class="text-muted">Utilisateurs plan Premium</small>
                        </div>
                        <div class="ms-auto fw-bold" style="font-size: 1.4rem;">{{ $stats['premium'] }}</div>
                    </div>
                    <canvas id="chartPremium" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0" style="border-radius: 16px;">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                                <tr>
                                    <th class="border-0 px-4 py-3">Standard ({{ $stats['standard'] }})</th>
                                    <th class="border-0 px-4 py-3">Email</th>
                                    <th class="border-0 px-4 py-3">Voitures</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($standardUsers as $u)
                                    <tr>
                                        <td class="px-4 py-3">{{ $u->name }}</td>
                                        <td class="px-4 py-3">{{ $u->email }}</td>
                                        <td class="px-4 py-3">{{ $u->cars_count }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-muted">Aucun utilisateur Standard</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0" style="border-radius: 16px;">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                                <tr>
                                    <th class="border-0 px-4 py-3">Premium ({{ $stats['premium'] }})</th>
                                    <th class="border-0 px-4 py-3">Email</th>
                                    <th class="border-0 px-4 py-3">Voitures</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($premiumUsers as $u)
                                    <tr>
                                        <td class="px-4 py-3">{{ $u->name }}</td>
                                        <td class="px-4 py-3">{{ $u->email }}</td>
                                        <td class="px-4 py-3">{{ $u->cars_count }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-muted">Aucun utilisateur Premium</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const stdCtx = document.getElementById('chartStandard');
    const premCtx = document.getElementById('chartPremium');

    // Graphiques simples: répartition voitures par utilisateur (top 5)
    const stdLabels = @json($standardUsers->sortByDesc('cars_count')->take(5)->pluck('name'));
    const stdData = @json($standardUsers->sortByDesc('cars_count')->take(5)->pluck('cars_count'));
    const premLabels = @json($premiumUsers->sortByDesc('cars_count')->take(5)->pluck('name'));
    const premData = @json($premiumUsers->sortByDesc('cars_count')->take(5)->pluck('cars_count'));

    if (stdCtx) new Chart(stdCtx, {
        type: 'bar',
        data: { labels: stdLabels, datasets: [{ label: 'Voitures', data: stdData, backgroundColor: '#ced4da' }] },
        options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
    });
    if (premCtx) new Chart(premCtx, {
        type: 'bar',
        data: { labels: premLabels, datasets: [{ label: 'Voitures', data: premData, backgroundColor: '#fd7e14' }] },
        options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
    });
});
</script>
@endsection


