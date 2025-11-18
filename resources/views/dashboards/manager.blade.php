<x-app-layout>
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h4 class="mb-0">My Projects</h4>
    <div class="d-flex gap-2">
      @can('create', App\Models\Project::class)
        <!-- Optional: link to Projects page or a modal to create a project -->
        <a class="btn btn-outline-secondary" href="{{ route('projects.index') }}">Manage Projects</a>
      @endcan
      @if($projects->count())
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTaskModal">Create Task</button>
      @endif
    </div>
  </div>

  <div class="card">
    <div class="card-body p-0">
      <table class="table table-hover mb-0">
        <thead><tr><th>Project</th><th>Tasks</th><th>Created</th><th class="text-end">Open</th></tr></thead>
        <tbody>
        @forelse($projects as $p)
          <tr>
            <td class="fw-semibold">{{ $p->name }}</td>
            <td><span class="badge text-bg-secondary">{{ $p->tasks_count }}</span></td>
            <td>{{ $p->created_at->format('Y-m-d') }}</td>
            <td class="text-end">
              <a class="btn btn-sm btn-outline-secondary" href="{{ route('projects.show', $p) }}">Open</a>
            </td>
          </tr>
        @empty
          <tr><td colspan="4" class="text-center text-muted">No projects yet</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Create Task Modal (assign to employee under any of manager's projects) -->
  <div class="modal fade" id="createTaskModal" tabindex="-1">
    <div class="modal-dialog">
      <form class="modal-content" method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Create Task</h5>
        </div>
        <div class="modal-body">
          <div class="mb-2">
            <label class="form-label">Project</label>
            <select name="project_id" class="form-select" required>
              @foreach($projects as $p)
                <option value="{{ $p->id }}">{{ $p->name }}</option>
              @endforeach
            </select>
          </div>
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
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
          <button class="btn btn-primary">Create Task</button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>