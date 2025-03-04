<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class CreateUniqueUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentYear = date('Y');

        // Ensure the User role exists
        $userRole = Role::firstOrCreate(['name' => 'User']);

        // Create a new unique user
        $newUserData = [
            'name' => 'New User',
            'email' => 'newuser' . time() . '@gmail.com',
            'password' => bcrypt('123456'),
            'date_of_birth' => '2000-01-01',
            'phone_number' => '1234567890',
        ];

        $lastUser = User::whereYear('created_at', $currentYear)->orderBy('id', 'desc')->first();
        $sequenceNumber = $lastUser ? intval(substr($lastUser->unique_id, -4)) + 1 : 1;
        $uniqueId = sprintf('USR-%s-%04d', $currentYear, $sequenceNumber);

        $newUserData['unique_id'] = $uniqueId;

        $newUser = User::create($newUserData);
        $newUser->assignRole([$userRole->id]); // Assign User role to the new unique user
    }
}
