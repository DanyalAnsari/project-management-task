<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(private ProjectService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view', Project::class);

        $projects = $this->service->listFor(auth()->user());

        return ProjectResource::collection($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $this->authorize('create', Project::class);
        $data = $request->validated();
        $user = auth()->user();
        $project = $this->service->create($data, $user);

        return (new ProjectResource($project->load('manager')))
            ->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $this->authorize('view', $project);
        $project->load(['manager', 'tasks.assignedUser']);

        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
