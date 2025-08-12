@component('mail::message')
# Félicitations !

Votre plan a été mis à niveau vers: **{{ ucfirst($plan) }}**.

@if($plan === 'premium')
- Publications illimitées
- Mise en avant
- Support prioritaire
@endif

Merci pour votre confiance.

@component('mail::button', ['url' => route('cars.my-cars')])
Voir mes voitures
@endcomponent

{{ config('app.name') }}
@endcomponent


