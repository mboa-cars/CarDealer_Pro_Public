@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold" style="color:#F26522;">Mes abonnés</h1>
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Abonné</th>
                        <th>Email</th>
                        <th>Depuis le</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($followers as $follower)
                        <tr>
                            <td class="fw-semibold text-dark">{{ $follower->subscriber->name ?? '-' }}</td>
                            <td class="text-muted">{{ $follower->subscriber->email ?? '-' }}</td>
                            <td><span class="badge bg-orange text-white">{{ $follower->subscribed_at->format('d/m/Y') }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center text-muted">Aucun abonné trouvé.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
