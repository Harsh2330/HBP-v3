use App\Models\AuditLog;

class PatientController extends Controller
{
    public function store(Request $request)
    {
        // ...existing code...
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'description' => 'Created a new patient.',
        ]);
        // ...existing code...
    }
}
