<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [
            [
                'brand' => 'Lexus',
                'model' => 'RX200t',
                'year' => 2016,
                'price' => 1200,
                'description' => 'SUV de luxe en excellent état',
                'type' => 'SUV',
                'city' => 'Douala',
                'mileage' => 45000,
                'state' => 'Excellent',
                'fuel_type' => 'Essence',
                'vin' => 'LEXUS123456789',
                'address' => 'Douala, Cameroun',
                'phone' => '+237 123456789'
            ],
            [
                'brand' => 'Toyota',
                'model' => 'Hilux',
                'year' => 2022,
                'price' => 2700,
                'description' => 'Pick-up robuste et fiable',
                'type' => 'Pickup Truck',
                'city' => 'Douala',
                'mileage' => 32000,
                'state' => 'Très bon',
                'fuel_type' => 'Diesel',
                'vin' => 'TOYOTA987654321',
                'address' => 'Douala, Cameroun',
                'phone' => '+237 987654321'
            ],
            [
                'brand' => 'Renault',
                'model' => 'Clio',
                'year' => 2021,
                'price' => 1800,
                'description' => 'Citadine économique',
                'type' => 'Hatchback',
                'city' => 'Yaoundé',
                'mileage' => 55000,
                'state' => 'Bon',
                'fuel_type' => 'Essence',
                'vin' => 'RENAULT456789123',
                'address' => 'Yaoundé, Cameroun',
                'phone' => '+237 456789123'
            ],
            [
                'brand' => 'Ford',
                'model' => 'Ranger',
                'year' => 2023,
                'price' => 3200,
                'description' => 'Pick-up tout-terrain',
                'type' => 'Pickup Truck',
                'city' => 'Douala',
                'mileage' => 28000,
                'state' => 'Excellent',
                'fuel_type' => 'Diesel',
                'vin' => 'FORD789123456',
                'address' => 'Douala, Cameroun',
                'phone' => '+237 789123456'
            ],
            [
                'brand' => 'Volkswagen',
                'model' => 'Golf',
                'year' => 2022,
                'price' => 2200,
                'description' => 'Berline compacte premium',
                'type' => 'Hatchback',
                'city' => 'Yaoundé',
                'mileage' => 38000,
                'state' => 'Très bon',
                'fuel_type' => 'Essence',
                'vin' => 'VW123789456',
                'address' => 'Yaoundé, Cameroun',
                'phone' => '+237 123789456'
            ]
        ];

        // Créer un utilisateur par défaut si aucun n'existe
        $defaultUser = \App\Models\User::first();
        
        if (!$defaultUser) {
            $defaultUser = \App\Models\User::create([
                'name' => 'Default User',
                'email' => 'default@example.com',
                'password' => bcrypt('password'),
                'phone' => '1234567890'
            ]);
        }

        foreach ($cars as $carData) {
            $carData['user_id'] = $defaultUser->id;
            $carData['is_published'] = true;
            $car = Car::create($carData);
            
            // Ajouter des images pour toutes les voitures
            $images = [];
            
            if ($car->brand === 'Lexus' && $car->model === 'RX200t') {
                $images = [
                    'cars/Lexus-RX200t-2016/1.jpeg',
                    'cars/Lexus-RX200t-2016/2.jpeg',
                    'cars/Lexus-RX200t-2016/3.jpeg',
                    'cars/Lexus-RX200t-2016/4.jpeg',
                    'cars/Lexus-RX200t-2016/5.jpeg',
                    'cars/Lexus-RX200t-2016/6.jpeg',
                    'cars/Lexus-RX200t-2016/7.jpeg'
                ];
            } elseif ($car->brand === 'Toyota' && $car->model === 'Hilux') {
                $images = [
                    'cars/Lexus-RX200t-2016/1.jpeg',
                    'cars/Lexus-RX200t-2016/2.jpeg',
                    'cars/Lexus-RX200t-2016/3.jpeg'
                ];
            } elseif ($car->brand === 'Renault' && $car->model === 'Clio') {
                $images = [
                    'cars/Lexus-RX200t-2016/4.jpeg',
                    'cars/Lexus-RX200t-2016/5.jpeg',
                    'cars/Lexus-RX200t-2016/6.jpeg'
                ];
            } elseif ($car->brand === 'Ford' && $car->model === 'Ranger') {
                $images = [
                    'cars/Lexus-RX200t-2016/2.jpeg',
                    'cars/Lexus-RX200t-2016/3.jpeg',
                    'cars/Lexus-RX200t-2016/4.jpeg'
                ];
            } elseif ($car->brand === 'Volkswagen' && $car->model === 'Golf') {
                $images = [
                    'cars/Lexus-RX200t-2016/5.jpeg',
                    'cars/Lexus-RX200t-2016/6.jpeg',
                    'cars/Lexus-RX200t-2016/7.jpeg'
                ];
            }
            
            // Copier les images du dossier public vers le storage
            foreach ($images as $index => $imagePath) {
                $sourcePath = public_path('images/' . $imagePath);
                
                if (file_exists($sourcePath)) {
                    // Copier l'image vers le storage
                    $storagePath = \Illuminate\Support\Facades\Storage::disk('public')->putFileAs(
                        'cars',
                        $sourcePath,
                        $car->id . '_' . $index . '_' . basename($imagePath)
                    );
                    
                    \App\Models\CarImage::create([
                        'car_id' => $car->id,
                        'image' => $storagePath,
                        'position' => $index
                    ]);
                }
            }
        }
    }
} 