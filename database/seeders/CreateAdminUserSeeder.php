<?php

namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentYear = date('Y');

        $usersData = [
            [
                'name' => 'Parmar Viral', 
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'date_of_birth' => '1990-01-01',
                'phone_number' => '9876543210',
            ],
            [
                'name' => 'Tarun Machhi', 
                'email' => 'tarunmachhi29@gmail.com',
                'password' => bcrypt('12341234'),
                'date_of_birth' => '2005-05-21',
                'phone_number' => '8799554970',
            ]
        ];

        foreach ($usersData as $userData) {
            $lastUser = User::whereYear('created_at', $currentYear)->orderBy('id', 'desc')->first();
            $sequenceNumber = $lastUser ? intval(substr($lastUser->unique_id, -4)) + 1 : 1;
            $uniqueId = sprintf('ADM-%s-%04d', $currentYear, $sequenceNumber);

            $userData['unique_id'] = $uniqueId;

            $user = User::create($userData);
        }

        $role = Role::create(['name' => 'Admin']);
        $userRole = Role::create(['name' => 'User']); // Create User role

        $permissions = Permission::pluck('id','id')->all();
        $userPermissions = Permission::whereIn('name', [
            'patient-list',
            'patient-create',
            'patient-edit',
            'patient-delete'
        ])->pluck('id','id')->all(); // Get basic permissions

        $role->syncPermissions($permissions);
        $userRole->syncPermissions($userPermissions); // Assign basic permissions to User role

        $user->assignRole([$role->id]);
    }
}