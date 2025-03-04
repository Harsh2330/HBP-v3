<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalVisitsTable extends Migration
{
    public function up()
    {
        Schema::create('medical_visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->string('appointment_type');
            $table->text('primary_complaint');
            $table->text('symptoms')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable()->default(null);
            $table->unsignedBigInteger('nurse_id')->nullable()->default(null);
            $table->string('unique_id')->nullable()->default(null);
            $table->date('visit_date')->nullable()->default(null);
            $table->string('doctor_name')->nullable()->default(null);
            $table->string('nurse_name')->nullable()->default(null);
            $table->text('diagnosis')->nullable()->default(null); 
            $table->text('simplified_diagnosis')->nullable()->default(null);
            $table->string('sugar_level')->nullable()->default(null);
            $table->string('heart_rate')->nullable()->default(null);
            $table->string('temperature')->nullable()->default(null);
            $table->string('oxygen_level')->nullable()->default(null);
            $table->text('ongoing_treatments')->nullable()->default(null);
            $table->text('medications_prescribed')->nullable()->default(null);
            $table->text('procedures')->nullable()->default(null);
            $table->text('doctor_notes')->nullable()->default(null);
            $table->text('nurse_observations')->nullable()->default(null);  
            $table->string('medical_status')->default('pending'); 
            $table->string('is_approved')->default("pending"); 
            $table->unsignedBigInteger('created_by'); 
            $table->string('treatment_name')->nullable(); 
            $table->string('time_slot')->nullable()->default(null); 
            $table->boolean('is_emergency')->default(false); 
            $table->date('preferred_visit_date')->nullable()->default(null); // New column
            $table->string('preferred_time_slot')->nullable()->default(null); // New column
            $table->timestamps();
            $table->softDeletes();
            
        });

        // Explicitly define the foreign key constraints after creating the table
        Schema::table('medical_visits', function (Blueprint $table) {
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade'); // Foreign key constraint for patient_id
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('nurse_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key constraint
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('medical_visits');
    }
}