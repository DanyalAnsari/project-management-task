<?php

use App\Models\Project;

class ProjectService
{
    public function create(array $data)
    {
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
