<div class="btn-group" role="group" aria-label="Actions">
    @can('medical-visit-create', $visit)
    <a class="btn btn-info btn-sm" href="{{ route('medical_visit.show', $visit->id) }}"><i class="fas fa-list"></i> Show</a>
    @endcan
    @can('medical-visit-edit', $visit)
    <a class="btn btn-primary btn-sm" href="{{ route('medical_visit.edit', $visit->id) }}"><i class="fas fa-pencil-alt"></i> Edit</a>
    @endcan
    @can('medical-visit-delete', $visit)
    <form action="{{ route('medical_visit.destroy', $visit->id) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger btn-sm delete-visit" data-id="{{ $visit->id }}"><i class="fas fa-trash"></i> Delete</button>
    </form>
    @endcan
    @can('medical-visit-reschedule', $visit)
    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#rescheduleModal-{{ $visit->id }}"><i class="fas fa-calendar-alt"></i> Reschedule</button>
    @endcan
</div>
