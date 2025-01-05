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
    //seed Architects
    $users = [
        [
            'name' => ' Raghavendra Iyer',
            'email' => ' raghavendra@dreambuilder.com',
            'role' => 'architect',
            'password' => '1234', 
            'age' => '35',
            'gender' => 'Male',
            'pincode' => '682004',
            'contact' => '9876543210',
            'post' => 'Ernakulam',
            'profile_image' => 'images/users/user_1.jpg'
        ],
        [
            'name' => 'Meenakshi Venkatesan',
            'email' => 'meenakshi@dreambuilder.com',
            'role' => 'architect',
            'password' => 'staff_arc@dreambuilder', 
            'age' => '28',
            'gender' => 'Female',
            'pincode' => '695043',
            'contact' => '8765432109',
            'post' => 'Thiruvananthapuram',
            'profile_image' => 'images/users/user_2.jpg',
        ],
        [
            'name' => 'Arvind Natarajan',
            'email' => 'arvind@dreambuilder.com',
            'role' => 'architect',
            'password' => 'staff_arc@dreambuilder', 
            'age' => '24',
            'gender' => 'Male',
            'pincode' => '670028',
            'contact' => '9123456789',
            'post' => 'Kozhikode',
            'profile_image' => 'images/users/user_3.jpg',
        ],
        [
            'name' => 'Lakshmi Priya Rajan',
            'email' => 'lakshmi@dreambuilder.com',
            'role' => 'architect',
            'password' => 'staff_arc@dreambuilder', 
            'age' => '26',
            'gender' => 'Female',
            'pincode' => '683007',
            'contact' => '9987654321',
            'post' => 'Kottayam',
            'profile_image' => 'images/users/user_4.jpg',
        ],
        [
            'name' => 'Faizan Mohammed',
            'email' => 'faizan@dreambuilder.com',
            'role' => 'architect',
            'password' => 'staff123', 
            'age' => '31',
            'gender' => 'Male',
            'pincode' => '670002',
            'contact' => '8456789012',
            'post' => 'Malappuram',
            'profile_image' => 'images/users/user_5.jpg',
        ],

        //seed Designers

        [
            'name' => 'Anand Kumar',
            'email' => 'anand@dreambuilder.com',
            'role' => 'designer',
            'password' => 'staff_des@dreambuilder', 
            'age' => '23',
            'gender' => 'Male',
            'pincode' => '683111',
            'contact' => '7598432106',
            'post' => 'Thrissur',
            'profile_image' => 'images/users/user_6.jpg',
        ],
        [
            'name' => 'Kavitha Narayanan',
            'email' => 'kavitha@dreambuilder.com',
            'role' => 'designer',
            'password' => 'staff_des@dreambuilder', 
            'age' => '37',
            'gender' => 'Female',
            'pincode' => '682018',
            'contact' => '8234567890',
            'post' => 'Kochi',
            'profile_image' => 'images/users/user_7.jpg',
        ],
        [
            'name' => 'Faiza Qureshi',
            'email' => 'faiza@dreambuilder.com',
            'role' => 'designer',
            'password' => 'staff_des@dreambuilder', 
            'age' => '34',
            'gender' => 'Female',
            'pincode' => '686065',
            'contact' => '6342198765',
            'post' => 'Pathanamthitta',
            'profile_image' => 'images/users/user_8.jpg',
        ],
        [
            'name' => 'David Mathew',
            'email' => 'david@dreambuilder.com',
            'role' => 'designer',
            'password' => 'staff_des@dreambuilder', 
            'age' => '29',
            'gender' => 'Male',
            'pincode' => '685009',
            'contact' => '7412345678',
            'post' => 'Idukki',
            'profile_image' => 'images/users/user_9.jpg',
        ],
        [
            'name' => 'Maria DSouza',
            'email' => 'maria@dreambuilder.com',
            'role' => 'designer',
            'password' => 'staff_des@dreambuilder', 
            'age' => '42',
            'gender' => 'Female',
            'pincode' => '678095',
            'contact' => '85674 31902',
            'post' => 'Palakkad',
            'profile_image' => 'images/users/user_10.jpg',
        ],
        
    ];


    foreach ($users as $user) {
        // Insert user and get the inserted user ID
        $userId = DB::table('users')->insertGetId([
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
            'password' => Hash::make($user['password']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Insert staff with the retrieved user ID
        DB::table('staff')->insert([
            'user_id' => $userId,  // Add user_id here
            'age' => $user['age'],
            'gender' => $user['gender'],
            'pincode' => $user['pincode'],
            'contact' => $user['contact'],
            'post' => $user['post'],
            'profile_image' =>$user['profile_image'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
    
    

// plan seeder   
private function seedPlans()
{
    // seed Plans
    $plans = [

        //LUXURY

        [
            'plan_name' => '1',
            'plan_type' => 'luxury',
            'plan_image' => 'images/plans/luxury_1.jpg',
            'no_bhk' => 3,
            'no_bathroom' => 2,
            'no_floor' => 1,
            'sqft' => 990,
            'estimated_cost' => 15000000,
        ],
        [
            'plan_name' => '2',
            'plan_type' => 'luxury',
            'plan_image' => 'images/plans/luxury_2.jpg',
            'no_bhk' => 3,
            'no_bathroom' => 3,
            'no_floor' => 2,
            'sqft' => 2800,
            'estimated_cost' => 31250000,
        ],
        [
            'plan_name' => '3',
            'plan_type' => 'luxury',
            'plan_image' => 'images/plans/luxury_3.jpg',
            'no_bhk' => 4,
            'no_bathroom' => 4,
            'no_floor' => 2,
            'sqft' => 5500,
            'estimated_cost' => 75000000,
        ],

        // MODERN

        [
            'plan_name' => '1',
            'plan_type' => 'modern',
            'plan_image' => 'images/plans/modern_1.jpg',
            'no_bhk' => 2,
            'no_bathroom' => 2,
            'no_floor' => 1,
            'sqft' => 850,
            'estimated_cost' => 3500000,
        ],
        [
            'plan_name' => '2',
            'plan_type' => 'modern',
            'plan_image' => 'images/plans/modern_2.jpg',
            'no_bhk' => 4,
            'no_bathroom' => 4,
            'no_floor' => 2,
            'sqft' => 2650,
            'estimated_cost' => 8500000,
        ],
        [
            'plan_name' => '3',
            'plan_type' => 'modern',
            'plan_image' => 'images/plans/modern_3.jpg',
            'no_bhk' => 3,
            'no_bathroom' => 3,
            'no_floor' => 2,
            'sqft' => 3950,
            'estimated_cost' => 13500000,
        ],

        // TRADITIONAL

        [
            'plan_name' => '1',
            'plan_type' => 'traditional',
            'plan_image' => 'images/plans/traditional_1.jpg',
            'no_bhk' => 3,
            'no_bathroom' => 2,
            'no_floor' => 1,
            'sqft' => 790,
            'estimated_cost' => 1500000,
        ],
        [
            'plan_name' => '2',
            'plan_type' => 'traditional',
            'plan_image' => 'images/plans/traditional_2.jpg',
            'no_bhk' => 4,
            'no_bathroom' => 3,
            'no_floor' => 2,
            'sqft' => 2300,
            'estimated_cost' => 5500000,
        ],
        [
            'plan_name' => '3',
            'plan_type' => 'traditional',
            'plan_image' => 'images/plans/traditional_3.jpg',
            'no_bhk' => 4,
            'no_bathroom' => 3,
            'no_floor' => 2,
            'sqft' => 3300,
            'estimated_cost' => 8000000,
        ],
        // add more data here
    ];

    foreach ($plans as $plan) {
        DB::table('plans')->insert([
            'plan_name' => $plan['plan_name'],
            'plan_type' => $plan['plan_type'],
            'plan_image' => $plan['plan_image'],
            'no_bhk' => $plan['no_bhk'],
            'no_bathroom' => $plan['no_bathroom'],
            'no_floor' => $plan['no_floor'],
            'sqft' => $plan['sqft'],
            'estimated_cost' => $plan['estimated_cost'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

private function seedDesigns()
{
    // Seed designs
    $designs = [

        //LUXURY

        [
            'design_name' => '1',
            'design_image' => 'images/designs/Luxury_1.jpg',
            'estimated_cost' => '2500000',
            'design_type'=> 'luxury',
        ],
        [
            'design_name' => '2',
            'design_image' => 'images/designs/Luxury_2.jpg',
            'estimated_cost' => '4000000',
            'design_type'=> 'luxury',
        ],
        [
            'design_name' => '3',
            'design_image' => 'images/designs/Luxury_3.jpg',
            'estimated_cost' => '5500000',
            'design_type'=> 'luxury',
        ],

        // MODERN

        [
            'design_name' => '1',
            'design_image' => 'images/designs/Modern_1.jpg',
            'estimated_cost' => '1500000',
            'design_type'=> 'modern',
        ],
        [
            'design_name' => '2',
            'design_image' => 'images/designs/Modern_2.jpg',
            'estimated_cost' => '2200000',
            'design_type'=> 'modern',
        ],
        [
            'design_name' => '3',
            'design_image' => 'images/designs/Modern_3.jpg',
            'estimated_cost' => '3500000',
            'design_type'=> 'modern',
        ],

        // TRADITIONAL

        [
            'design_name' => '1',
            'design_image' => 'images/designs/Traditional_1.jpg',
            'estimated_cost' => '900000',
            'design_type'=> 'traditional',
        ],
        [
            'design_name' => '2',
            'design_image' => 'images/designs/Traditional_2.jpg',
            'estimated_cost' => '1800000',
            'design_type'=> 'traditional',
        ],
        [
            'design_name' => '3',
            'design_image' => 'images/designs/Traditional_3.jpg',
            'estimated_cost' => '2400000',
            'design_type'=> 'traditional',
        ],
        
    ];

    foreach ($designs as $design) {
        DB::table('designs')->insert([
            'design_name' => $design['design_name'],
            'design_image' => $design['design_image'],
            'estimated_cost' => $design['estimated_cost'],
            'design_type'=> $design['design_type'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

}
