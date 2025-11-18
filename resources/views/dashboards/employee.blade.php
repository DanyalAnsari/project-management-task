<x-app-layout>
  <h4 class="mb-3">My Tasks</h4>
  <div class="card">
    <div class="card-body p-0">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr>
            <th>Title</th>
            <th>Project</th>
            <th>Status</th>
            <th>Due</th>
          </tr>
        </thead>
        <tbody>
        @forelse($tasks as $task)
          @php $overdue = $task->due_date && $task->due_date->isPast() && $task->status !== 'done'; @endphp
          <tr class="{{ $overdue ? 'table-danger' : '' }}">
            <td class="fw-semibold">{{ $task->title }}</td>
            <td>{{ $task->project->name }}</td>
            <td style="max-width: 240px">
              <form method="POST" action="{{ route('tasks.update', $task) }}">
                @csrf @method('PUT')
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                  @foreach(['pending','in_progress','done'] as $s)
                    <option value="{{ $s }}" @selected($task->status === $s)>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
                  @endforeach
                </select>
              </form>
            </td>
            <td>{{ $task->due_date?->format('Y-m-d') ?? '—' }}</td>
          </tr>
        @empty
          <tr><td colspan="4" class="text-center text-muted">No tasks assigned</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>
  </div>
</x-app-layout>