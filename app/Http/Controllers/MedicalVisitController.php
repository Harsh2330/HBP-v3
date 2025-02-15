<?php

namespace App\Http\Controllers;

use App\Models\MedicalVisit;
use App\Models\Patient;
use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MedicalVisitController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:medical-visit-list|medical-visit-create|medical-visit-edit|medical-visit-delete', ['only' => ['index','show']]);
        $this->middleware('permission:medical-visit-create', ['only' => ['create','store']]);
        $this->middleware('permission:medical-visit-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:medical-visit-delete', ['only' => ['destroy']]);
        $this->middleware('permission:medical-visit-update-status', ['only' => ['updateStatus']]);
    }

    // Display a listing of the medical visits
    public function index(Request $request)
    {
        $query = MedicalVisit::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('patient', function ($q) use ($search) {
                $q->where('pat_unique_id', 'like', "%{$search}%")
                  ->orWhere('full_name', 'like', "%{$search}%");
            })
            ->orWhereHas('doctor', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->orWhereHas('nurse', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->orWhere('visit_date', 'like', "%{$search}%")
            ->orWhere('is_approved', 'like', "%{$search}%");
        }

        $medicalVisits = $query->paginate(10);

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
            'patient_id' => [
                'required',
                'exists:patients,id', // Ensure this validation rule is correct
                Rule::unique('medical_visits')->where(function ($query) use ($request) {
                    return $query->where('patient_id', $request->patient_id)
                                 ->whereDate('visit_date', $request->visit_date);
                }),
            ],
            'visit_date' => 'required|date',
            'doctor_id' => 'required|exists:users,id',
            'nurse_id' => 'required|exists:users,id',
            'treatment_name' => 'required|string', // Add validation for treatment_name
            'is_emergency' => 'boolean', // Add validation for is_emergency
            // Add other validation rules as needed
        ]);

        $patient = Patient::findOrFail($request->patient_id);
        $doctor = User::findOrFail($request->doctor_id);
        $nurse = User::findOrFail($request->nurse_id);

        $medicalVisit = new MedicalVisit();
        $medicalVisit->patient_id = $request->patient_id;
        $medicalVisit->doctor_id = $request->doctor_id;
        $medicalVisit->nurse_id = $request->nurse_id;
        $medicalVisit->unique_id = $patient->pat_unique_id;

        // Format visit_date using Carbon
        $medicalVisit->visit_date = Carbon::parse($request->visit_date)->format('Y-m-d H:i:s');

        $medicalVisit->doctor_name = $doctor->name;
        $medicalVisit->nurse_name = $nurse->name;
        $medicalVisit->treatment_name = $request->treatment_name; // Set treatment_name
        $medicalVisit->is_emergency = $request->is_emergency ?? false; // Set is_emergency with default value
        $medicalVisit->created_by = Auth::id(); // Set the authenticated user's ID
        $medicalVisit->save();

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'description' => 'Created a new medical visit for patient: ' . $patient->full_name,
        ]);

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
            'visit_date' => [
                'required',
                'date',
                Rule::unique('medical_visits')->ignore($id)->where(function ($query) use ($request) {
                    return $query->where('patient_id', $request->patient_id)
                                 ->whereDate('visit_date', $request->visit_date);
                }),
            ],
            'treatment_name' => 'required|string', // Add validation for treatment_name
            'is_emergency' => 'boolean', // Add validation for is_emergency
            'time_slot' => 'required|string', // Add validation for time_slot
        ]);

        $visit = MedicalVisit::findOrFail($id);
        $visit->update($request->all());

        // Ensure is_emergency is set to a default value if not provided
        $visit->is_emergency = $request->is_emergency ?? false;
        $visit->save();

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'description' => 'Updated medical visit for patient: ' . $visit->patient->full_name,
        ]);

        return redirect()->route('medical_visit.show', $visit->id)->with('success', 'Medical visit updated successfully.');
    }

    // Delete a specific medical visit
    public function destroy($id)
    {
        $visit = MedicalVisit::findOrFail($id);
        $visit->delete();

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'description' => 'Deleted medical visit for patient: ' . $visit->patient->full_name,
        ]);

        return redirect()->route('medical_visit.index')->with('success', 'Medical visit deleted successfully.');
    }

    // Approve a specific medical visit
    public function approve(Request $request, $id)
    {
        $visit = MedicalVisit::findOrFail($id);
        $visit->is_approved = 'Approved';
        $visit->time_slot = $request->input('time_slot'); // Set the time slot

        $visit->save();

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'approve',
            'description' => 'Approved medical visit for patient: ' . $visit->patient->full_name,
        ]);

        return redirect()->route('medical_visit.index')->with('success', 'Medical visit approved successfully.');
    }

    // Reject a specific medical visit
    public function reject($id)
    {
        $visit = MedicalVisit::findOrFail($id);
        $visit->is_approved = 'Rejected';
        $visit->save();

        return redirect()->route('medical_visit.index')->with('success', 'Medical visit rejected successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $visit = MedicalVisit::findOrFail($id);
        $visit->is_approved = $request->input('medical_status');
        $visit->save();

        return redirect()->route('medical_visit.index')->with('success', 'Medical status updated successfully.');
    }

    public function calendar()
    {
        $userId = Auth::id();
        $medicalVisits = MedicalVisit::where('created_by', $userId)
            ->orWhere('doctor_id', $userId)
            ->orWhere('nurse_id', $userId)
            ->with('patient') // Include patient relationship
            ->get(['visit_date', 'doctor_name', 'nurse_name', 'simplified_diagnosis', 'patient_id', 'treatment_name', 'is_approved']);

        $events = $medicalVisits->map(function ($visit) {
            return [
                'title' => $visit->patient->full_name . ' - ' . $visit->treatment_name,
                'start' => $visit->visit_date,
                'status' => $visit->is_approved,
                'backgroundColor' => $visit->is_approved === 'Approved' ? 'green' : 'yellow',
                'borderColor' => $visit->is_approved === 'Approved' ? 'green' : 'yellow'
            ];
        });

        return view('calendar', compact('events'));
    }
}
