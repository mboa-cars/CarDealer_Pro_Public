<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer un administrateur par défaut
        User::create([
            'name' => 'Administrateur',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        $this->command->info('Administrateur créé avec succès !');
        $this->command->info('Email: admin@example.com');
        $this->command->info('Mot de passe: password');
    }
}
