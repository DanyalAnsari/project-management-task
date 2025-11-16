<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use ProjectService;

class ProjectController extends Controller
{
    public function __construct(private ProjectService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Project::class);
        $user = auth()->user();
        $projects = $this->service->listFor($user);
        return $projects;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validated();
        $user = auth()->user();

        $project = $this->service->create($data, $user);

        return redirect()->route('projects.show', $project)->with('success', 'project created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $this->authorize('view', $project);

        $project->load(['manager', 'tasks.assignedEmployee']);
        $employees = User::where('role', 'employee')->orderBy('name')->get();

        return ['projects' => $project, 'employees' => $employees];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $data = $request->validated();
        $this->service->update($data, $project);

        return back()->with('success', 'Project updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        $this->service->delete($project);

        return redirect()->route('projects.index')->with('success', 'Project deleted!');
    }
}
