@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold" style="color:#F26522;">Mes abonnements</h1>
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Vendeur</th>
                        <th>Email</th>
                        <th>Abonné depuis</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subscriptions as $subscription)
                        <tr>
                            <td class="fw-semibold text-dark">{{ $subscription->seller->name ?? '-' }}</td>
                            <td class="text-muted">{{ $subscription->seller->email ?? '-' }}</td>
                            <td><span class="badge bg-orange text-white">{{ $subscription->subscribed_at->format('d/m/Y') }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center text-muted">Aucun abonnement trouvé.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
