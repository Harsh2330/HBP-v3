<?php

namespace App\Http\Controllers;

use App\Models\MedicalVisit;
use App\Models\User;
use Illuminate\Http\Request;

class MedicalVisitController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:medical-visit-list|medical-visit-create|medical-visit-edit|medical-visit-delete', ['only' => ['index','show']]);
        $this->middleware('permission:medical-visit-create', ['only' => ['create','store']]);
        $this->middleware('permission:medical-visit-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:medical-visit-delete', ['only' => ['destroy']]);
    }

    // Display a listing of the medical visits
    public function index()
    {
        $medicalVisits = MedicalVisit::with(['patient', 'doctor', 'nurse'])->paginate(10); // Include 'nurse' relationship
        return view('medical_visit.index', compact('medicalVisits'));
    }

    // Show the form for creating a new medical visit
    public function create()
    {
        $patients = User::all();
        $doctors = User::all();
        $nurses = User::all();

        return view('medical_visit.create', compact('patients', 'doctors', 'nurses'));
    }

    // Store a newly created medical visit
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:users,id',
            'visit_date' => 'required|date',
            'doctor_id' => 'required|exists:users,id',
            'nurse_id' => 'required|exists:users,id',
            // ...existing code...
        ]);

        $patient = User::findOrFail($request->patient_id);
        $doctor = User::findOrFail($request->doctor_id);
        $nurse = User::findOrFail($request->nurse_id);

        $medicalVisit = new MedicalVisit();
        $medicalVisit->patient_id = $request->patient_id;
        $medicalVisit->doctor_id = $request->doctor_id; // Set doctor_id
        $medicalVisit->nurse_id = $request->nurse_id; // Ensure nurse_id is set
        $medicalVisit->unique_id = $patient->unique_id; // Ensure unique_id is set
        $medicalVisit->visit_date = $request->visit_date;
        $medicalVisit->doctor_name = $doctor->first_name . ' ' . $doctor->middle_name . ' ' . $doctor->last_name;
        $medicalVisit->nurse_name = $nurse->first_name . ' ' . $nurse->middle_name . ' ' . $nurse->last_name;
        $medicalVisit->save();

        return redirect()->route('medical_visit.index')->with('success', 'Medical visit created successfully.');
    }

    // Show the details of a specific medical visit
    public function show($id)
    {
        $visit = MedicalVisit::with(['patient', 'doctor', 'nurse'])->findOrFail($id); // Include 'nurse' relationship
        return view('medical_visit.show', compact('visit'));
    }

    // Show the form for editing a specific medical visit
    public function edit($id)
    {
        $visit = MedicalVisit::findOrFail($id);
        $patients = User::all();
        $doctors = User::all();
        $nurses = User::all();

        return view('medical_visit.edit', compact('visit', 'patients', 'doctors', 'nurses'));
    }

    // Update a specific medical visit
    public function update(Request $request, $id)
    {
        $request->validate([
            'diagnosis' => 'nullable|string',
            'simplified_diagnosis' => 'nullable|string',
            'blood_pressure' => 'nullable|string',
            'heart_rate' => 'nullable|string',
            'temperature' => 'nullable|string',
            'weight' => 'nullable|string',
            'ongoing_treatments' => 'nullable|string',
            'medications_prescribed' => 'nullable|string',
            'procedures' => 'nullable|string',
            'doctor_notes' => 'nullable|string',
            'nurse_observations' => 'nullable|string',
            // 'visit_date' => [
            //     'required',
            //     'date',
            //     Rule::unique('medical_visits')->ignore($id)->where(function ($query) use ($request) {
            //         return $query->where('doctor_id', $request->doctor_id)
            //                      ->orWhere('nurse_id', $request->nurse_id)
            //                      ->where('visit_date', $request->visit_date);
            //     })
            // ],
        ]);

        $visit = MedicalVisit::findOrFail($id);
        $visit->update($request->all());

        return redirect()->route('medical_visit.show', $visit->id)->with('success', 'Medical visit updated successfully.');
    }

    // Delete a specific medical visit
    public function destroy($id)
    {
        $visit = MedicalVisit::findOrFail($id);
        $visit->delete();

        return redirect()->route('medical_visit.index')->with('success', 'Medical visit deleted successfully.');
    }
}
