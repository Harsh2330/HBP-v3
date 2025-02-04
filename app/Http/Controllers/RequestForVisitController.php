<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalVisit;

class RequestForVisitController extends Controller
{
    public function index()
    {
        $medicalVisits = MedicalVisit::all(); // Fetch all medical visits
        return view('request_for_visit.index', compact('medicalVisits'));
    }

    public function create()
    {
        return view('request_for_visit.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'patient_name' => 'required|string|max:255',
            'visit_date' => 'required|date',
            'doctor_name' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Create a new medical visit
        $medicalVisit = MedicalVisit::create($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('request_for_visit.index')->with('success', 'Medical visit created successfully.');
    }

    public function approve($id)
    {
        $medicalVisit = MedicalVisit::findOrFail($id);
        $medicalVisit->is_approved = 'Approved'; // Set is_approved to "Approved"
        $medicalVisit->save();

        return redirect()->route('request_for_visit.index')->with('success', 'Medical visit approved successfully.');
    }
}
