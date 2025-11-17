<?php

namespace App\Services;

use App\Models\Project;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProjectService
{
    public function listFor(User $user): LengthAwarePaginator
    {
        if ($user->isAdmin()) {
            return Project::with('manager')->latest()->paginate(10);
        }

        if ($user->isManager()) {
            return Project::with('manager')->where('manager_id', $user->id)->latest()->paginate(10);
        }

        // employees no projects list
        return Project::whereRaw('1=0')->paginate(10);
    }

    public function create(array $data, $user)
    {
        if ($user->isManager()) {
            $data['manager_id'] = $user->id;
        }

        return Project::create($data);
    }

    public function update(array $data, Project $project)
    {
        $project->update($data);

        return $project->refresh();
    }

    public function delete(Project $project)
    {
        $project->delete();
    }
}
