<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Users-staffs,clients
        $this->seedUsers();

        // Seed Plans
        $this->seedPlans();


        // Seed Designs
        $this->seedDesigns();

    }

    private function seedUsers()
    {
        // Define roles and their counts
        $roles = [
            'client' => 5,
            'designer' => 2,
            'architect' => 2,
        ];
    
        $usersData = [];
    
        // Generate users based on roles
        foreach ($roles as $role => $count) {
            for ($i = 1; $i <= $count; $i++) {
                $email = strtolower($role) . $i . '@gmail.com';
                $usersData[] = [
                    'name' => ucfirst($role) . " " . str_pad($i, 2, '0', STR_PAD_LEFT), // e.g., Client 01, Architect 02
                    'email' => $email, // e.g., client1@gmail.com
                    'role' => $role,
                    'password' => Hash::make('1234'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }
    
        // Insert users and get their IDs
        DB::table('users')->insert($usersData);
        $userIds = DB::table('users')->whereIn('email', array_column($usersData, 'email'))->get(['id', 'email']);
    
        // Prepare data for clients and staff
        $places = ['Kalpatta', 'Thalassery', 'Kannur', 'Malappuram', 'Palakkad', 'Eranakulam'];
        $landmarks = ['Malappuram', 'Kannur', 'Wayanad', 'Calicut', 'Vadakara', 'Nilambur'];
        $idProofTypes = ['Aadhaar', 'Driver\'s License', 'PAN Card', 'Voter\'s ID'];
    
        // Initialize arrays to hold user IDs by role
        $clientUserIds = [];
        $staffUserIds = [];
    
        // Split user IDs based on roles
        foreach ($userIds as $user) {
            if ($user->email[0] === 'c') { // Clients: client1@gmail.com, client2@gmail.com, etc.
                $clientUserIds[] = $user->id;
            } else { // Staff: designers and architects
                $staffUserIds[] = $user->id;
            }
        }
    
        // Client data
        $clients = [];
        foreach ($clientUserIds as $userId) {
            $clients[] = [
                'user_id' => $userId,
                'post' => $landmarks[array_rand($landmarks)],
                'pincode' => rand(100000, 999999), // 6 digit pincode
                'place' => $places[array_rand($places)],
                'landmark' => $landmarks[array_rand($landmarks)],
                'contact' => rand(1000000000, 9999999999), // 10 digit number
                'id_proof_type' => $idProofTypes[array_rand($idProofTypes)],
                'id_proof' => 'images/userId/id'.$userId.'.jpg',
                'profile_image' => 'images/users/user'. $userId.'.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
    
        // Insert clients data
        DB::table('clients')->insert($clients);
    
        // Staff data
        $posts = ['Malappuram', 'Kannur', 'Wayanad', 'Calicut', 'Vadakara', 'Nilambur'];
        $staff = [];
    
        foreach ($staffUserIds as $userId) {
            $staff[] = [
                'user_id' => $userId,
                'age' => rand(20, 40),
                'gender' => ['Male', 'Female', 'Other'][rand(0, 2)],
                'profile_image' => 'images/users/user'.$userId.'.jpg',
                'contact' => rand(1000000000, 9999999999), // 10 digit number
                'pincode' => rand(100000, 999999), // 6 digit pincode
                'post' => $posts[array_rand($posts)], // Random post
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
    
        // Insert staff data
        DB::table('staff')->insert($staff);
    }
    
    

// plan seeder   
    private function seedPlans()
{
    // Insert 10 Plans
    $planTypes = ['Modern', 'Traditional', 'Minimalist', 'Luxury', 'Villa', 'Eco Friendly'];
        $plans = [];

        for ($i = 1; $i <= 15; $i++) {
            // Generating random sqft between 650 and 5000
            $sqft = rand(650, 5000);

            // Generating random number of BHK based on sqft
            if ($sqft <= 1000) {
                $no_bhk = rand(1, 3);
            } elseif ($sqft <= 2000) {
                $no_bhk = rand(3, 5);
            } elseif ($sqft <= 3000) {
                $no_bhk = rand(3, 6);
            } else {
                $no_bhk = rand(4, 6);
            }

            // Generating random number of bathrooms based on BHK
            $no_bathroom = rand($no_bhk - 2, $no_bhk - 1);

            // Generating random number of floors based on sqft
            if ($sqft <= 1000) {
                $no_floor = 1;
            } elseif ($sqft <= 2000) {
                $no_floor = rand(1, 2);
            } else {
                $no_floor = rand(2, 3);
            }

            // Estimated cost is sqft * 2000 INR
            $estimated_cost = $sqft * 2000;

            $plans[] = [
                'plan_name' => 'Plan ' . $i,
                'plan_type' => $planTypes[array_rand($planTypes)], // Random plan type
                'plan_image' => 'images/plans/plan'.$i. '.jpg', // Plan image
                'no_bhk' => $no_bhk,
                'no_bathroom' => $no_bathroom,
                'no_floor' => $no_floor,
                'sqft' => $sqft,
                'estimated_cost' => (string) $estimated_cost, // Estimated cost in INR
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('plans')->insert($plans);
    }

    private function seedDesigns()
{
    // Design types
    $designTypes = ['Modern', 'Contemporary', 'Minimalist', 'Traditional'];
    $designs = [];

    for ($i = 1; $i <= 10; $i++) {
        // Generating random estimated cost between 200000 and 1500000
        $estimated_cost = rand(200000, 1500000);

        $designs[] = [
            'design_name' => 'Design ' . $i,
            'design_type' => $designTypes[array_rand($designTypes)], // Random design type
            'estimated_cost' => number_format($estimated_cost, 2, '.', ''), // Estimated cost with 2 decimal precision
            'design_image' => 'images/designs/design'.$i.'.jpg', // Design image
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    DB::table('designs')->insert($designs);
}

}


