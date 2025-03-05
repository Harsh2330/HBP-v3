<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Patient extends Model
{
    use SoftDeletes, HasFactory, HasRoles;

    protected $guard_name = 'web'; // Specify the guard name

    protected $fillable = [
        'full_name',
        'gender',
        'date_of_birth',
        'age_category',
        'phone_number',
        'email',
        'full_address',
        'religion',
        'economic_status',
        'bpl_card_number',
        'ayushman_card',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relationship',
        'is_approved',
        'user_unique_id',
        'pat_unique_id',
    ];

    // Add an accessor for the full_name attribute
    public function getFullNameAttribute()
    {
        return $this->attributes['full_name'];
    }

    // public function appointments()
    // {
    //     return $this->hasMany(Appointment::class, 'id');
    // }

    // public function history()
    // {
    //     return $this->hasMany(AppointmentHistory::class, 'id');
    // }
}
