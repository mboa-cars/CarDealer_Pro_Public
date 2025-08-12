@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 fw-bold" style="color:#F26522;">Choisir un plan</h1>
    <div class="row g-4">
        @foreach($plans as $key => $plan)
            <div class="col-md-6">
                <div class="card shadow-sm border-0 h-100" style="border-radius: 16px;">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 56px; height: 56px; background: linear-gradient(135deg, #F26522 0%, #ea6500 100%);">
                                <i class="fas {{ $key === 'premium' ? 'fa-crown' : 'fa-user' }} text-white"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $plan['label'] }}</h4>
                                <small class="text-muted d-block">{{ $key === 'premium' ? 'Publications illimitées' : ($plan['car_limit'] . ' publications maximum') }}</small>
                                @if(isset($plan['price']))
                                    <small class="text-muted">Prix: {{ $plan['price'] ? number_format($plan['price'], 2, ',', ' ') . ' € / mois' : 'Gratuit' }}</small>
                                @endif
                            </div>
                        </div>

                        <ul class="mb-4">
                            @foreach($plan['features'] as $feature)
                                <li class="mb-2"><i class="fas fa-check me-2" style="color:#28a745"></i>{{ $feature }}</li>
                            @endforeach
                        </ul>

                        <div class="mt-auto">
                            @if($user->plan === $key)
                                <button class="btn btn-secondary w-100" disabled>Plan actuel</button>
                            @else
                                <form method="POST" action="{{ route('plans.choose', $key) }}">
                                    @csrf
                                    <button class="btn btn-primary w-100" style="background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); border: none;">
                                        @if($key === 'premium' && ($plans['premium']['price'] ?? null))
                                            Payer et activer Premium
                                        @else
                                            Choisir {{ $plan['label'] }}
                                        @endif
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection


