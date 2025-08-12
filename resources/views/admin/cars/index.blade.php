@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Titre -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h1 class="text-2xl font-bold text-gray-900 mb-4">Gestion des voitures</h1>
            <p class="text-gray-600">Gérez toutes les voitures de votre application et leur statut de publication.</p>
        </div>
    </div>

    <!-- Liste des voitures -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Voiture
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Propriétaire
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Prix
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Localisation
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Statut
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Créée le
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($cars as $car)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12">
                                            <img class="h-12 w-12 rounded object-cover" src="{{ $car->main_image }}" alt="{{ $car->brand }} {{ $car->model }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $car->brand }} {{ $car->model }}</div>
                                            <div class="text-sm text-gray-500">{{ $car->year }} • {{ $car->mileage ? $car->formatted_mileage : 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $car->user->name ?? 'Utilisateur supprimé' }}</div>
                                    <div class="text-sm text-gray-500">{{ $car->user->email ?? '' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $car->formatted_price }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @if($car->city && $car->state)
                                            {{ $car->city }}, {{ $car->state }}
                                        @elseif($car->city)
                                            {{ $car->city }}
                                        @elseif($car->state)
                                            {{ $car->state }}
                                        @else
                                            Non renseigné
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($car->is_published)
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                            Publiée
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">
                                            Non publiée
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $car->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <!-- Voir la voiture -->
                                        <a href="{{ route('cars.show', $car) }}" class="text-blue-600 hover:text-blue-900" target="_blank">
                                            Voir
                                        </a>
                                        
                                        <!-- Toggle Publication -->
                                        <form method="POST" action="{{ route('admin.cars.toggle-publish', $car) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-indigo-600 hover:text-indigo-900">
                                                @if($car->is_published)
                                                    Dépublier
                                                @else
                                                    Publier
                                                @endif
                                            </button>
                                        </form>
                                        
                                        <!-- Supprimer -->
                                        <form method="POST" action="{{ route('admin.cars.delete', $car) }}" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette voiture ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                    Aucune voiture trouvée
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($cars->hasPages())
                <div class="mt-6">
                    {{ $cars->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 