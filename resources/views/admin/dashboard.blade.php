@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Titre -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h1 class="text-2xl font-bold text-gray-900 mb-4">Dashboard d'administration</h1>
            <p class="text-gray-600">Bienvenue dans l'interface d'administration de votre application de vente de voitures.</p>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-bold">{{ $stats['total_users'] }}</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Utilisateurs</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_users'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-bold">{{ $stats['total_cars'] }}</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Voitures</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_cars'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-bold">{{ $stats['published_cars'] }}</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Publiées</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['published_cars'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-bold">{{ $stats['unpublished_cars'] }}</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Non publiées</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['unpublished_cars'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-bold">{{ $stats['total_favorites'] }}</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Favoris</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_favorites'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenu récent -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Voitures récentes -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Voitures récentes</h3>
                <div class="space-y-4">
                    @forelse($recent_cars as $car)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <img src="{{ $car->main_image }}" alt="{{ $car->brand }} {{ $car->model }}" class="w-12 h-12 object-cover rounded">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $car->brand }} {{ $car->model }}</p>
                                    <p class="text-sm text-gray-500">{{ $car->year }} • {{ $car->formatted_price }}</p>
                                    <p class="text-xs text-gray-400">par {{ $car->user->name }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="px-2 py-1 text-xs rounded-full {{ $car->is_published ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $car->is_published ? 'Publiée' : 'Non publiée' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Aucune voiture récente</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Utilisateurs récents -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Utilisateurs récents</h3>
                <div class="space-y-4">
                    @forelse($recent_users as $user)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                                    <span class="text-gray-600 font-medium">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                    <p class="text-xs text-gray-400">Inscrit le {{ $user->created_at->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                @if($user->isAdmin())
                                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                        Admin
                                    </span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Aucun utilisateur récent</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Actions rapides</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('admin.users') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    Gérer les utilisateurs
                </a>
                <a href="{{ route('admin.cars') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                    Gérer les voitures
                </a>
                <a href="{{ route('admin.statistics') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700">
                    Voir les statistiques
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 