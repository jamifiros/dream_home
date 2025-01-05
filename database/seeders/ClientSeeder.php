<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        // Number of clients to create
        $clientCount = 10;

        // Generate clients using User factory
        $clients = User::factory()
            ->count($clientCount)
            ->state(['role' => 'client'])  // Set role to 'client'
            ->create();

        // Fetch client user IDs for further seeding
        $clientUserIds = $clients->pluck('id')->toArray();

        // Data arrays for random selection
        $places = ['Kalpatta', 'Thalassery', 'Kannur', 'Malappuram', 'Palakkad', 'Eranakulam'];
        $landmarks = ['Malappuram', 'Kannur', 'Wayanad', 'Calicut', 'Vadakara', 'Nilambur'];
        $idProofTypes = ['Aadhaar', 'Driver\'s License', 'PAN Card', 'Voter\'s ID'];

        // Prepare data for clients
        $clientData = [];
        foreach ($clientUserIds as $userId) {
            $clientData[] = [
                'user_id' => $userId,
                'post' => $landmarks[array_rand($landmarks)],
                'pincode' => rand(100000, 999999), // 6 digit pincode
                'place' => $places[array_rand($places)],
                'landmark' => $landmarks[array_rand($landmarks)],
                'contact' => rand(1000000000, 9999999999), // 10 digit number
                'id_proof_type' => $idProofTypes[array_rand($idProofTypes)],
                'id_proof' => 'images/userId/dummy_id.jpg',
                'profile_image' => 'images/users/user_' . $userId . '.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert client data into the 'clients' table
        DB::table('clients')->insert($clientData);
    }
}
