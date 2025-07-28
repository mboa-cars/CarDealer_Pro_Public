<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class HomeController extends Controller
{
    public function index()
    {
        $latestCars = Car::published()->with('images')->latest()->paginate(8);
        $brands = Car::select('brand')->distinct()->pluck('brand')->filter();
        $models = Car::select('model')->distinct()->pluck('model')->filter();
        $types = Car::select('type')->distinct()->pluck('type')->filter();
        $states = Car::select('state')->distinct()->pluck('state')->filter();
        $cities = Car::select('city')->distinct()->pluck('city')->filter();
        // $fuel_types = Car::select('fuel_type')->distinct()->pluck('fuel_type')->filter(); // colonne inexistante
        $years = Car::select('year')->distinct()->orderBy('year', 'desc')->pluck('year')->filter();
        $mileages = Car::select('mileage')->distinct()->pluck('mileage')->filter();
        $prices = Car::select('price')->distinct()->orderBy('price')->pluck('price')->filter();
        return view('welcome', compact('latestCars', 'brands', 'models', 'types', 'states', 'cities', 'years', 'mileages', 'prices'));
    }
} 