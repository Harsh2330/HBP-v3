<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'nurse_id',
        'unique_id',
        'visit_date',
        'doctor_name',
        'nurse_name',
        'diagnosis',
        'simplified_diagnosis',
        'sugar_level',
        'heart_rate',
        'temperature',
        'oxygen_level',
        'ongoing_treatments',
        'medications_prescribed',
        'procedures',
        'doctor_notes',
        'nurse_observations',
        'is_approved',
        'created_by',
        'treatment_name',
        'patient_name',
        'notes',
        'is_emergency',
        'time_slot',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function nurse()
    {
        return $this->belongsTo(User::class, 'nurse_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
