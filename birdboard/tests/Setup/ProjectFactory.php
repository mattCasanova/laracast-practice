<?php

namespace Tests\Setup;

use App\Project;
use App\Task;
use App\User;

class ProjectFactory 
{

    protected $taskCount = 0;


    public function withTasks(int $count): ProjectFactory
    {
        $this->taskCount = $count;
        return $this;
    }

    public function ownedBy(User $user)
    {
        $this->user = $user;
        return $this;
    }

    public function create(): Project
    {
        $project = factory(Project::class)->create([
            'owner_id' => $this->user ?? factory(User::class)
        ]);

        $tasks = factory(Task::class, $this->taskCount)->create([
            'project_id' => $project->id
        ]);

        return $project;
    }
}
