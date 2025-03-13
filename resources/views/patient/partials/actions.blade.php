<a href="{{ route('admin.patient.show', $patient->id) }}" class="px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">View</a>
<form action="{{ route('admin.patient.destroy', $patient->id) }}" method="POST" class="inline-block">
    @csrf
    @method('DELETE')
    <button type="submit" class="px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
</form>
