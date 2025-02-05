<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id', // New field added
        'nurse_id', // New field added
        'unique_id',
        'visit_date',
        'doctor_name',
        'nurse_name',
        'diagnosis',
        'simplified_diagnosis',
        'blood_pressure',
        'heart_rate',
        'temperature',
        'weight',
        'ongoing_treatments',
        'medications_prescribed',
        'procedures',
        'doctor_notes',
        'nurse_observations',
        'is_approved' // New field added
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id'); // New relationship added
    }

    public function nurse()
    {
        return $this->belongsTo(User::class, 'nurse_id'); // Ensure nurse relationship is defined
    }
}
