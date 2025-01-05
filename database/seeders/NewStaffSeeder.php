<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class NewStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Users - staff, clients
        $this->seedUsers();

        // Uncomment these if needed later
        // $this->seedPlans();
        // $this->seedDesigns();
        $this->seedUsers();
    }

    private function seedUsers()
    {
        // Seed Architects
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
        ];

        foreach ($users as $user) {
            // Insert user into the `users` table
            $userId = DB::table('users')->insertGetId([
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
                'password' => Hash::make($user['password']), // Hash the password
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Insert corresponding staff details into the `staff` table
            DB::table('staff')->insert([
                'user_id' => $userId, // Associate the user_id with staff
                'age' => $user['age'],
                'gender' => $user['gender'],
                'pincode' => $user['pincode'],
                'contact' => $user['contact'],
                'post' => $user['post'],
                'profile_image' => $user['profile_image'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
