<?php

namespace App\Services;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;

class TaskService
{
    public function create(array $data, Project $project)
    {
        $data['project_id'] = $project->id;

        return Task::create($data);
    }

    public function update(array $data, Task $task, User $user)
    {
        if ($user->isEmployee()) {
            $data = array_intersect_key($data, ['status' => true]);
        }
        $task->update($data);

        return $task->refresh();
    }

    public function delete(Task $task)
    {
        $task->delete();
    }
}
