<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Validation stricte des filtres
        $validated = $request->validate([
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'year_from' => 'nullable|integer',
            'year_to' => 'nullable|integer',
            'price_from' => 'nullable|numeric',
            'price_to' => 'nullable|numeric',
            'mileage' => 'nullable|integer',
            'state' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'fuel_type' => 'nullable|string|max:255',
        ]);

        $query = Car::published();

        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }
        if ($request->filled('model')) {
            $query->where('model', $request->model);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('year_from')) {
            $query->where('year', '>=', $request->year_from);
        }
        if ($request->filled('year_to')) {
            $query->where('year', '<=', $request->year_to);
        }
        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }
        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }
        if ($request->filled('mileage')) {
            $query->where('mileage', '<=', $request->mileage);
        }
        if ($request->filled('state')) {
            $query->where('state', $request->state);
        }
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }
        if ($request->filled('fuel_type')) {
            $query->where('fuel_type', $request->fuel_type);
        }

        $cars = $query->with(['images', 'user'])->paginate(8);

        $user = Auth::user();
        $carsFavorited = $user ? $user->carsFavorited()->pluck('cars.id')->toArray() : [];

        // Mise en cache des valeurs distinctes pour les listes déroulantes
        $brands = \Cache::remember('car_brands', 3600, function () {
            return Car::published()->select('brand')->distinct()->pluck('brand')->filter();
        });
        $models = \Cache::remember('car_models', 3600, function () {
            return Car::published()->select('model')->distinct()->pluck('model')->filter();
        });
        $types = \Cache::remember('car_types', 3600, function () {
            return Car::published()->select('type')->distinct()->pluck('type')->filter();
        });
        $states = \Cache::remember('car_states', 3600, function () {
            return Car::published()->select('state')->distinct()->pluck('state')->filter();
        });
        $cities = \Cache::remember('car_cities', 3600, function () {
            return Car::published()->select('city')->distinct()->pluck('city')->filter();
        });
        $fuelTypes = \Cache::remember('car_fuel_types', 3600, function () {
            return Car::published()->select('fuel_type')->distinct()->pluck('fuel_type')->filter();
        });

        return view('cars.index', [
            'cars' => $cars,
            'brands' => $brands,
            'models' => $models,
            'types' => $types,
            'states' => $states,
            'cities' => $cities,
            'fuelTypes' => $fuelTypes,
            'user' => $user,
            'carsFavorited' => $carsFavorited,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Limitation selon le plan
        if (! Auth::user()->canPublishMoreCars()) {
            return redirect()->route('cars.my-cars')->with('error', 'Vous avez atteint la limite de publications pour votre plan. Passez au plan Premium pour publier davantage.');
        }
        $carTypes = ['SUV', 'Coupe', 'Minivan', 'Crossover', 'Pickup Truck', 'Hatchback', 'Sedan', 'Jeep', 'Sports Car'];
        $fuelTypes = ['Gasoline', 'Diesel', 'Electric', 'Hybrid'];
        $features = [
            'Air Conditioning', 'Power Windows', 'Power Door Locks', 'Remote Start',
            'GPS Navigation System', 'Climate Control', 'Heated Seats', 'ABS',
            'Cruise Control', 'Rear Parking Sensors', 'Bluetooth Connectivity', 'Leather Seats',
        ];

        return view('cars.create', compact('carTypes', 'fuelTypes', 'features'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Vérifier la limite de publication avant de valider et créer
        if (! Auth::user()->canPublishMoreCars()) {
            return back()->withErrors(['error' => 'Limite atteinte pour votre plan. Passez au plan Premium pour publier davantage.'])->withInput();
        }
        \Log::info('Store method called', [
            'user_id' => Auth::id(),
            'request_data' => $request->all(),
        ]);

        try {
            $request->validate([
                'brand' => 'required|string|max:255',
                'model' => 'required|string|max:255',
                'year' => 'required|integer|min:1900|max:'.(date('Y') + 1),
                'price' => 'required|numeric|min:0',
                'type' => 'required|string|max:255',
                'mileage' => 'required|integer|min:0',
                'fuel_type' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
                'vin' => 'required|string|max:255',
                'description' => 'nullable|string',
                'features' => 'nullable|array',
                'images.*' => 'nullable|image|max:2048',
                'video_url' => 'nullable|url',
            ]);

            \Log::info('Validation passed');

            $data = $request->all();
            $data['user_id'] = Auth::id();
            $data['features'] = $request->features ?? [];

            \Log::info('Creating car with data', $data);

            $car = Car::create($data);

            \Log::info('Car created', ['car_id' => $car->id]);

            // Gérer les images
            if ($request->hasFile('images')) {
                \Log::info('Processing images', ['files_count' => count($request->file('images'))]);
                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store('cars', 'public');
                    $car->images()->create([
                        'image' => $path,
                        'position' => $index,
                    ]);
                    \Log::info('Image stored', ['path' => $path]);
                }
            }

            \Log::info('Redirecting to my-cars');

            return redirect()->route('cars.my-cars')->with('success', 'Voiture ajoutée avec succès !');

        } catch (\Exception $e) {
            \Log::error('Error in store method', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return back()->withErrors(['error' => 'Une erreur est survenue: '.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $car = Car::with(['images', 'user'])->findOrFail($id);
        $user = Auth::user();
        $isFavorited = $user ? $user->carsFavorited()->where('car_id', $id)->exists() : false;

        // Vérifier si l'utilisateur connecté suit le vendeur
        $isFollowing = $user && $user->id !== $car->user_id ? $user->isFollowing($car->user_id) : false;

        // Compter les abonnés du vendeur
        $followersCount = $car->user->followers_count;

        return view('cars.show', compact('car', 'isFavorited', 'isFollowing', 'followersCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $car = Car::with('images')->findOrFail($id);

        // Vérifier que l'utilisateur est propriétaire de la voiture
        if ($car->user_id !== Auth::id()) {
            return redirect()->route('cars.index')->with('error', 'Vous n\'êtes pas autorisé à modifier cette voiture.');
        }

        $carTypes = ['SUV', 'Coupe', 'Minivan', 'Crossover', 'Pickup Truck', 'Hatchback', 'Sedan', 'Jeep', 'Sports Car'];
        $fuelTypes = ['Gasoline', 'Diesel', 'Electric', 'Hybrid'];
        $features = [
            'Air Conditioning', 'Power Windows', 'Power Door Locks', 'Remote Start',
            'GPS Navigation System', 'Climate Control', 'Heated Seats', 'ABS',
            'Cruise Control', 'Rear Parking Sensors', 'Bluetooth Connectivity', 'Leather Seats',
        ];

        return view('cars.edit', compact('car', 'carTypes', 'fuelTypes', 'features'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        // Vérifier que l'utilisateur est propriétaire de la voiture
        if ($car->user_id !== Auth::id()) {
            return redirect()->route('cars.index')->with('error', 'Vous n\'êtes pas autorisé à modifier cette voiture.');
        }

        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:'.(date('Y') + 1),
            'price' => 'required|numeric|min:0',
            'type' => 'required|string|max:255',
            'mileage' => 'required|integer|min:0',
            'fuel_type' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'vin' => 'required|string|max:255',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'images.*' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url',
        ]);

        $data = $request->all();
        $data['features'] = $request->features ?? [];

        $car->update($data);

        // Gérer les nouvelles images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('cars', 'public');
                $car->images()->create([
                    'image' => $path,
                    'position' => $car->images()->count() + $index,
                ]);
            }
        }

        return redirect()->route('cars.my-cars')->with('success', 'Voiture modifiée avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $car = Car::findOrFail($id);

        // Vérifier que l'utilisateur est propriétaire de la voiture
        if ($car->user_id !== Auth::id()) {
            return redirect()->route('cars.index')->with('error', 'Vous n\'êtes pas autorisé à supprimer cette voiture.');
        }

        // Supprimer les images
        foreach ($car->images as $image) {
            Storage::disk('public')->delete($image->image);
        }

        $car->delete();

        return redirect()->route('cars.my-cars')->with('success', 'Voiture supprimée avec succès !');
    }

    /**
     * Afficher les voitures de l'utilisateur connecté.
     */
    public function myCars()
    {
        $user = Auth::user();
        $cars = Car::byUser($user->id)->with('images')->paginate(10);

        return view('cars.my-cars', compact('cars'));
    }

    /**
     * Gérer les images d'une voiture.
     */
    public function manageImages($id)
    {
        $car = Car::with('images')->findOrFail($id);

        // Vérifier que l'utilisateur est propriétaire de la voiture
        if ($car->user_id !== Auth::id()) {
            return redirect()->route('cars.index')->with('error', 'Vous n\'êtes pas autorisé à gérer les images de cette voiture.');
        }

        return view('cars.manage-images', compact('car'));
    }

    /**
     * Mettre à jour les positions des images.
     */
    public function updateImagePositions(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        if ($car->user_id !== Auth::id()) {
            return response()->json(['error' => 'Non autorisé'], 403);
        }

        $request->validate([
            'positions' => 'required|array',
            'positions.*.id' => 'required|exists:car_images,id',
            'positions.*.position' => 'required|integer|min:0',
        ]);

        foreach ($request->positions as $item) {
            CarImage::where('id', $item['id'])->update(['position' => $item['position']]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Supprimer une image.
     */
    public function deleteImage($carId, $imageId)
    {
        $car = Car::findOrFail($carId);
        $image = CarImage::findOrFail($imageId);

        if ($car->user_id !== Auth::id() || $image->car_id !== $car->id) {
            return response()->json(['error' => 'Non autorisé'], 403);
        }

        Storage::disk('public')->delete($image->image);
        $image->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Ajouter des images à une voiture existante.
     */
    public function addImages(Request $request, $id)
    {
        \Log::info('addImages method called', ['car_id' => $id, 'request_data' => $request->all()]);

        $car = Car::findOrFail($id);

        // Vérifier que l'utilisateur est propriétaire de la voiture
        if ($car->user_id !== Auth::id()) {
            \Log::warning('Unauthorized access attempt', ['user_id' => Auth::id(), 'car_user_id' => $car->user_id]);

            return redirect()->route('cars.index')->with('error', 'Vous n\'êtes pas autorisé à modifier cette voiture.');
        }

        $request->validate([
            'images.*' => 'required|image|max:2048',
        ]);

        \Log::info('Validation passed', ['has_files' => $request->hasFile('images'), 'files_count' => $request->hasFile('images') ? count($request->file('images')) : 0]);

        if ($request->hasFile('images')) {
            $currentPosition = $car->images()->count();
            \Log::info('Processing images', ['current_position' => $currentPosition, 'files_count' => count($request->file('images'))]);

            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('cars', 'public');
                \Log::info('Image stored', ['original_name' => $image->getClientOriginalName(), 'stored_path' => $path]);

                $carImage = $car->images()->create([
                    'image' => $path,
                    'position' => $currentPosition + $index,
                ]);

                \Log::info('CarImage created', ['car_image_id' => $carImage->id]);
            }

            return redirect()->route('cars.manage-images', $car->id)->with('success', 'Images ajoutées avec succès !');
        }

        \Log::warning('No images provided');

        return redirect()->route('cars.manage-images', $car->id)->with('error', 'Aucune image sélectionnée.');
    }

    /**
     * Ajouter une voiture aux favoris de l'utilisateur connecté ou de la session.
     */
    public function addToFavorites($carId)
    {
        $user = Auth::user();

        if ($user) {
            // Utilisateur connecté - utiliser la base de données
            if (! $user->favorites()->where('car_id', $carId)->exists()) {
                $user->favorites()->create(['car_id' => $carId]);
            }
        } else {
            // Utilisateur non connecté - utiliser la session
            $favorites = session('favorites', []);
            if (! in_array($carId, $favorites)) {
                $favorites[] = $carId;
                session(['favorites' => $favorites]);
            }
        }

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Ajouté aux favoris !',
                'isFavorited' => true,
            ]);
        }

        return back()->with('success', 'Ajouté aux favoris !');
    }

    /**
     * Retirer une voiture des favoris de l'utilisateur connecté ou de la session.
     */
    public function removeFromFavorites($carId)
    {
        $user = Auth::user();

        if ($user) {
            // Utilisateur connecté - utiliser la base de données
            $user->favorites()->where('car_id', $carId)->delete();
        } else {
            // Utilisateur non connecté - utiliser la session
            $favorites = session('favorites', []);
            $favorites = array_diff($favorites, [$carId]);
            session(['favorites' => array_values($favorites)]);
        }

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Retiré des favoris !',
                'isFavorited' => false,
            ]);
        }

        return back()->with('success', 'Retiré des favoris !');
    }

    /**
     * Afficher les voitures favorites de l'utilisateur connecté ou de la session.
     */
    public function favorites()
    {
        $user = Auth::user();

        if ($user) {
            // Utilisateur connecté - récupérer depuis la base de données
            $cars = $user->carsFavorited()->with(['images', 'user'])->paginate(8);
        } else {
            // Utilisateur non connecté - récupérer depuis la session
            $favorites = session('favorites', []);
            if (empty($favorites)) {
                // Créer une pagination vide
                $cars = new \Illuminate\Pagination\LengthAwarePaginator(
                    collect([]),
                    0,
                    8,
                    1,
                    ['path' => request()->url()]
                );
            } else {
                $cars = Car::whereIn('id', $favorites)->with(['images', 'user'])->paginate(8);
            }
        }

        return view('favorites', compact('cars'));
    }

    public function carCard($id)
    {
        $car = Car::with(['images', 'user'])->findOrFail($id);

        // On utilise le même composant que sur la page d'accueil
        return view('components.car-card', compact('car'))->render();
    }
}
