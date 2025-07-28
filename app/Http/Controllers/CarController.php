<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarImage;
use App\Models\Favorite;
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
        $carTypes = ['SUV', 'Coupe', 'Minivan', 'Crossover', 'Pickup Truck', 'Hatchback', 'Sedan', 'Jeep', 'Sports Car'];
        $fuelTypes = ['Gasoline', 'Diesel', 'Electric', 'Hybrid'];
        $features = [
            'Air Conditioning', 'Power Windows', 'Power Door Locks', 'Remote Start',
            'GPS Navigation System', 'Climate Control', 'Heated Seats', 'ABS',
            'Cruise Control', 'Rear Parking Sensors', 'Bluetooth Connectivity', 'Leather Seats'
        ];
        
        return view('cars.create', compact('carTypes', 'fuelTypes', 'features'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
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
        $data['user_id'] = Auth::id();
        $data['features'] = $request->features ?? [];

        $car = Car::create($data);

        // Gérer les images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('cars', 'public');
                $car->images()->create([
                    'image' => $path,
                    'position' => $index
                ]);
            }
        }

        return redirect()->route('cars.my-cars')->with('success', 'Voiture ajoutée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $car = Car::with(['images', 'user'])->findOrFail($id);
        $user = Auth::user();
        $isFavorited = $user ? $user->carsFavorited()->where('car_id', $id)->exists() : false;
        
        return view('cars.show', compact('car', 'isFavorited'));
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
            'Cruise Control', 'Rear Parking Sensors', 'Bluetooth Connectivity', 'Leather Seats'
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
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
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
                    'position' => $car->images()->count() + $index
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
            'positions.*.position' => 'required|integer|min:0'
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
     * Ajouter une voiture aux favoris de l'utilisateur connecté.
     */
    public function addToFavorites($carId)
    {
        $user = Auth::user();
        if (!$user) {
            if (request()->expectsJson()) {
                return response()->json(['error' => 'Vous devez être connecté pour ajouter un favori.'], 401);
            }
            return back()->with('error', 'Vous devez être connecté pour ajouter un favori.');
        }
        
        if (!$user->favorites()->where('car_id', $carId)->exists()) {
            $user->favorites()->create(['car_id' => $carId]);
        }
        
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Ajouté aux favoris !',
                'isFavorited' => true
            ]);
        }
        
        return back()->with('success', 'Ajouté aux favoris !');
    }

    /**
     * Retirer une voiture des favoris de l'utilisateur connecté.
     */
    public function removeFromFavorites($carId)
    {
        $user = Auth::user();
        if (!$user) {
            if (request()->expectsJson()) {
                return response()->json(['error' => 'Vous devez être connecté pour retirer un favori.'], 401);
            }
            return back()->with('error', 'Vous devez être connecté pour retirer un favori.');
        }
        
        $user->favorites()->where('car_id', $carId)->delete();
        
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Retiré des favoris !',
                'isFavorited' => false
            ]);
        }
        
        return back()->with('success', 'Retiré des favoris !');
    }

    /**
     * Afficher les voitures favorites de l'utilisateur connecté.
     */
    public function favorites()
    {
        $user = Auth::user();
        $cars = $user->carsFavorited()->with(['images', 'user'])->get();
        return view('favorites', compact('cars'));
    }
}
