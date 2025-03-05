<?php

namespace Database\Seeders;

use App\Models\MedicalVisit;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CreateMedicalVisitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $patients = Patient::all();
        $doctors = User::role('Doctor')->get();
        $nurses = User::role('Nurse')->get();

        foreach ($patients as $patient) {
            $doctor = $doctors->random();
            $nurse = $nurses->random();
            $visitDate = $faker->dateTimeBetween('now', '+1 year');

            $medicalVisitData = [
                'patient_id' => $patient->id,
                'doctor_id' => $doctor->id,
                'nurse_id' => $nurse->id,
                'unique_id' => 'MV-' . time() . '-' . $patient->id,
                'visit_date' => $visitDate,
                'doctor_name' => $doctor->name,
                'nurse_name' => $nurse->name,
                'diagnosis' => $faker->sentence,
                'simplified_diagnosis' => $faker->sentence,
                'sugar_level' => $faker->randomFloat(2, 70, 150),
                'heart_rate' => $faker->numberBetween(60, 100),
                'temperature' => $faker->randomFloat(1, 97, 99),
                'oxygen_level' => $faker->numberBetween(90, 100),
                'ongoing_treatments' => $faker->sentence,
                'medications_prescribed' => $faker->sentence,
                'procedures' => $faker->sentence,
                'doctor_notes' => $faker->paragraph,
                'nurse_observations' => $faker->paragraph,
                'is_approved' => $faker->randomElement(['approved']),
                'created_by' => $doctor->id,
                'treatment_name' => $faker->word,
                'primary_complaint' => $faker->sentence,
                'is_emergency' => $faker->boolean,
                'time_slot' => $faker->time,
                'appointment_type' => $faker->randomElement(['Routine', 'Emergency']),
            ];

            MedicalVisit::create($medicalVisitData);
        }
    }
}
