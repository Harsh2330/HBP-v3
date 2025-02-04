<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('user_unique_id')->nullable();
            $table->string('pat_unique_id')->nullable();
            $table->string('full_name'); // Ensure this line is included
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->date('date_of_birth');
            $table->string('age_category');
            $table->string('phone_number');
            $table->string('email')->nullable()->unique();
            $table->text('full_address');
            $table->string('religion');
            $table->string('economic_status');
            $table->string('bpl_card_number')->nullable();
            $table->boolean('ayushman_card');
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');
            $table->string('emergency_contact_relationship');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('patients');
    }
}