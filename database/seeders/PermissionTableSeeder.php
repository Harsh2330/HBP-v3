<?php

namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
                'role-list',
                'role-create',
                'role-edit',
                'role-delete',
                'medical-visit-list',
                'medical-visit-create',
                'medical-visit-edit',
                'medical-visit-delete',
                'medical-visit-update-status',
                'medical-visit-reschedule',
                'user-list',
                'user-create',
                'user-edit',
                'user-delete',
                'patient-list',
                'patient-create',
                'patient-edit',
                'patient-delete',
                'admin-dashboard',
                'doctor-dashboard',
                'nurse-dashboard',
                'user-dashboard',
                'req-list',
                'req-create',
                'req-approve',
                'admin-report-list',
                'admin-report-create',
                'admin-report-export',
                'doctor-report-list',
                'doctor-report-create',
                'doctor-report-export',
                'user-report-list',
                'user-report-create',
                'user-report-export',
        ];
        
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}