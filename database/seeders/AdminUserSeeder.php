<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@kantsainstitute.cm'],
            [
                'name' => 'Administrateur KANTSA',
                'password' => Hash::make('change-me-please'), // à changer après la première connexion
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );
    }
}
