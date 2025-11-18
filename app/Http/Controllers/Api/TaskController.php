<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends BaseApiController
{
    public function __construct(private TaskService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();
        $project = Project::findOrFail($data['project_id']);
        $user = auth()->user();
        $this->authorize('create', [Task::class, $project]);
        $task = $this->service->create($data, $project, $user);

        return (new TaskResource($task->load('assignedEmployee')))
            ->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $data = $request->validated();
        $user = auth()->user();
        $task = $this->service->update($data, $task, $user);

        return new TaskResource($task->load('assignedEmployee'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
