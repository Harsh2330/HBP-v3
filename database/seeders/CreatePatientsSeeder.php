<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Spatie\Permission\Models\Role;

class CreatePatientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $currentYear = date('Y');

        // Ensure the Patient role exists with the correct guard name
        $patientRole = Role::firstOrCreate(['name' => 'Patient', 'guard_name' => 'web']);

        for ($i = 1; $i <= 70; $i++) {
            $age = $faker->numberBetween(0, 90);
            $ageCategory = floor($age / 10) * 10 . '-' . (floor($age / 10) * 10 + 9);
            if ($age >= 80) {
                $ageCategory = '80+';
            }

            $lastUser = Patient::whereYear('created_at', $currentYear)->orderBy('id', 'desc')->first();
            $sequenceNumber = $lastUser ? intval(substr($lastUser->pat_unique_id, -4)) + 1 : 1;
            $uniqueId = sprintf('PAT-%s-%04d', $currentYear, $sequenceNumber);

            $newPatientData = [
                'full_name' => $faker->name,
                'gender' => $faker->randomElement(['Male', 'Female']),
                'date_of_birth' => $faker->date('Y-m-d', '-' . $age . ' years'),
                'age_category' => $ageCategory,
                'phone_number' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'full_address' => $faker->address,
                'religion' => $faker->randomElement(['Christianity', 'Islam', 'Hinduism', 'Buddhism', 'Other']),
                'economic_status' => $faker->randomElement(['Poor', 'Lower Medium']),
                'emergency_contact_name' => $faker->name,
                'emergency_contact_phone' => $faker->phoneNumber,
                'emergency_contact_relationship' => $faker->randomElement(['Son', 'Daughter']),
                'pat_unique_id' => $uniqueId,
                "user_unique_id" => 3
            ];

            $newPatient = Patient::create($newPatientData);
            $newPatient->assignRole($patientRole); // Assign Patient role to the new patient
        }
    }
}