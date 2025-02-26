<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'date_of_birth' => '2000-01-01', // Add date_of_birth
            'phone_number' => '1234567890', // Add phone_number
            'password' => bcrypt('12341234'), // Add password
            'unique_id' => 'USR-2023-0001',             
        ]);

        $this->call([
            PermissionTableSeeder::class,
            CreateAdminUserSeeder::class,
          
        ]);
    }
}
