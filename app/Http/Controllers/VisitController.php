<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\VisitScheduled;

class VisitController extends Controller
{
    public function scheduleVisit(Request $request)
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:users,id',
            'visit_date' => 'required|date',
            'time_slot' => 'required',
            'doctor_id' => 'required|exists:users,id',
            'nurse_id' => 'nullable|exists:users,id',
            'appointment_type' => 'required|string',
            'primary_complaint' => 'required|string',
        ]);

        $visit = Visit::create($validatedData);

        $patient = User::find($validatedData['patient_id']);
        Mail::to($patient->email)->send(new VisitScheduled($visit));

        return redirect()->route('medical_visit.index')->with('success', 'Visit scheduled successfully and email notification sent.');
    }
}
