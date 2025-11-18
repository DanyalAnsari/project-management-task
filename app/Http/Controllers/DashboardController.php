<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function matchUserWithDashboard()
    {
        $user = auth()->user();

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'manager' => redirect()->route('manager.dashboard'),
            default => redirect()->route('employee.dashboard'),
        };
    }

    public function employeeDashboard()
    {
        $employee = auth()->user();
        $tasks = $employee->assignedTasks()->with('project')->latest()->get();

        return view('dashboards.employee', compact('tasks'));
    }

    public function managerDashboard()
    {
        $manager = auth()->user();
        $projects = $manager->projects()->withCount('tasks')->latest()->get();
        $employees = User::where('role', 'employee')->orderBy('name')->get();

        return view('dashboards.manager', compact('projects', 'employees'));
    }
    public function adminDashboard()
    {
        $stats = [
            'users' => User::count(),
            'managers' => User::where('role', 'manager')->count(),
            'employees' => User::where('role', 'employee')->count(),
            'projects' => Project::count(),
            'tasks' => Task::count(),
        ];

        // Count all status and group them according to their status

        $statusCounts = Task::select('status', DB::raw('count(*) as total'))->groupBy('status')->pluck('total', 'status');

        $latestProjects = Project::with('manager')->latest()->take(5)->get();
        $latestTasks    = Task::with(['project', 'assignedEmployee'])->latest()->take(5)->get();

        return view('dashboards.admin', compact('stats', 'statusCounts', 'latestProjects', 'latestTasks'));
    }
}
