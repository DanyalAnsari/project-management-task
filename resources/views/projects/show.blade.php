<x-app-layout>
  <div class="d-flex align-items-baseline justify-content-between mb-2">
    <h3 class="mb-0">{{ $project->name }}</h3>
    <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-secondary">Back</a>
  </div>
  @if($project->description)
    <p class="text-muted mb-3">{{ $project->description }}</p>
  @endif

  <div class="row g-3 mb-4">
    <div class="col-md-6">
      <div class="card h-100">
        <div class="card-header">Project Info</div>
        <div class="card-body">
          <p class="mb-1"><strong>Manager:</strong> {{ $project->manager->name }}</p>
          <p class="mb-1"><strong>Created:</strong> {{ $project->created_at->format('Y-m-d') }}</p>
        </div>
      </div>
    </div>

    @can('create', [App\Models\Task::class, $project])
    <div class="col-md-6">
      <div class="card h-100">
        <div class="card-header">Create Task</div>
        <div class="card-body">
          <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <input type="hidden" name="project_id" value="{{ $project->id }}">
            <div class="mb-2">
              <label class="form-label">Title</label>
              <input name="title" class="form-control" required>
            </div>
            <div class="mb-2">
              <label class="form-label">Description</label>
              <textarea name="description" class="form-control" rows="2"></textarea>
            </div>
            <div class="row g-2">
              <div class="col-md-6">
                <label class="form-label">Assign To</label>
                <select name="assigned_to" class="form-select" required>
                  @foreach($employees as $e)
                    <option value="{{ $e->id }}">{{ $e->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label">Due Date</label>
                <input type="date" name="due_date" class="form-control">
              </div>
              <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                  @foreach(['pending','in_progress','done'] as $s)
                    <option value="{{ $s }}">{{ ucfirst(str_replace('_',' ', $s)) }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <button class="btn btn-primary mt-3">Add Task</button>
          </form>
        </div>
      </div>
    </div>
    @endcan
  </div>

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <span>Tasks</span>
      <span class="text-muted small">{{ $project->tasks->count() }} total</span>
    </div>
    <div class="card-body p-0">
      <table class="table mb-0 align-middle">
        <thead>
          <tr>
            <th>Title</th>
            <th>Assignee</th>
            <th>Status</th>
            <th>Due</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
        @forelse($project->tasks as $task)
          @php $overdue = $task->due_date && $task->due_date->isPast() && $task->status !== 'done'; @endphp
          <tr class="{{ $overdue ? 'table-danger' : '' }}">
            <td class="fw-semibold">{{ $task->title }}</td>
            <td>{{ $task->assignedEmployee->name }}</td>
            <td style="max-width: 240px;">
              <form method="POST" action="{{ route('tasks.update', $task) }}">
                @csrf @method('PUT')
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                  @foreach(['pending','in_progress','done'] as $s)
                    <option value="{{ $s }}" @selected($task->status === $s)>{{ ucfirst(str_replace('_',' ', $s)) }}</option>
                  @endforeach
                </select>
              </form>
            </td>
            <td>{{ $task->due_date?->format('Y-m-d') ?? '—' }}</td>
            <td class="text-end">
              @can('delete', $task)
                <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="d-inline" onsubmit="return confirm('Delete this task?');">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
              @endcan
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="text-center text-muted">No tasks</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>
  </div>
</x-app-layout>