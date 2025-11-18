<x-app-layout>
  <div class="row g-3 mb-4">
    <div class="col-md-2">
      <div class="card text-bg-dark">
        <div class="card-body">
          <div class="small text-uppercase">Users</div>
          <div class="display-6">{{ $stats['users'] }}</div>
          <div class="small">Managers: {{ $stats['managers'] }}, Employees: {{ $stats['employees'] }}</div>
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card text-bg-primary"><div class="card-body">
        <div class="small text-uppercase">Projects</div>
        <div class="display-6">{{ $stats['projects'] }}</div>
      </div></div>
    </div>
    <div class="col-md-2">
      <div class="card text-bg-secondary"><div class="card-body">
        <div class="small text-uppercase">Tasks</div>
        <div class="display-6">{{ $stats['tasks'] }}</div>
      </div></div>
    </div>
    <div class="col-md-6">
      <div class="card h-100">
        <div class="card-header">Task Status</div>
        <div class="card-body">
          @php
            $statuses = ['pending'=>'Pending','in_progress'=>'In Progress','done'=>'Done'];
          @endphp
          <div class="d-flex gap-3">
            @foreach($statuses as $key=>$label)
              <div>
                <div class="fw-semibold">{{ $label }}</div>
                <div class="display-6">{{ $statusCounts[$key] ?? 0 }}</div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-4">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">Latest Projects</div>
        <div class="card-body p-0">
          <table class="table mb-0">
            <thead><tr><th>Name</th><th>Manager</th></tr></thead>
            <tbody>
            @forelse($latestProjects as $p)
              <tr>
                <td><a href="{{ route('projects.show', $p) }}">{{ $p->name }}</a></td>
                <td>{{ $p->manager->name }}</td>
              </tr>
            @empty
              <tr><td colspan="2" class="text-center text-muted">No projects</td></tr>
            @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">Latest Tasks</div>
        <div class="card-body p-0">
          <table class="table mb-0">
            <thead><tr><th>Title</th><th>Project</th><th>Assignee</th><th>Status</th></tr></thead>
            <tbody>
            @forelse($latestTasks as $t)
              <tr>
                <td>{{ $t->title }}</td>
                <td>{{ $t->project->name }}</td>
                <td>{{ $t->assignedEmployee->name }}</td>
                <td><span class="badge text-bg-light">{{ ucfirst(str_replace('_',' ', $t->status)) }}</span></td>
              </tr>
            @empty
              <tr><td colspan="4" class="text-center text-muted">No tasks</td></tr>
            @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>