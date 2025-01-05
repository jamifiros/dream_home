<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        // Call the Seeders
        $this->call(AdminSeeder::class);
        $this->call(DataSeeder::class);
        $this->call(ClientSeeder::class);
        //Only use to add new staff:
        // $this->call(NewStaffSeeder::class);   
    }
}
