<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Check if admin user already exists
        $adminEmail = 'admin@example.com';
        $adminExists = User::where('email', $adminEmail)->exists();

        if (!$adminExists) {
            User::create([
                'name' => 'Admin',
                'email' => $adminEmail,
                'role' => 'admin',
                'password' => Hash::make('1234'), // Use a secure password
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
