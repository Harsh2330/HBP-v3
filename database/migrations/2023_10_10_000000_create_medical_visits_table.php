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
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('nurse_id'); // New field added
            $table->string('unique_id'); // Added unique constraint
            $table->date('visit_date');
            $table->string('doctor_name');
            $table->string('nurse_name');
            $table->text('diagnosis')->nullable()->default(null); // Made nullable with default value
            $table->text('simplified_diagnosis')->nullable()->default(null);
            $table->string('blood_pressure')->nullable()->default(null);
            $table->string('heart_rate')->nullable()->default(null);
            $table->string('temperature')->nullable()->default(null);
            $table->string('weight')->nullable()->default(null);
            $table->text('ongoing_treatments')->nullable()->default(null);
            $table->text('medications_prescribed')->nullable()->default(null);
            $table->text('procedures')->nullable()->default(null);
            $table->text('doctor_notes')->nullable()->default(null);
            $table->text('nurse_observations')->nullable()->default(null);
            $table->string('medical_status')->default('todo'); // New field added
            $table->string('is_approved')->default("pending"); // New field added
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('nurse_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key constraint
        });
    }

    public function down()
    {
        Schema::dropIfExists('medical_visits');
    }
}
