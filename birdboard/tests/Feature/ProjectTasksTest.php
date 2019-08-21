<?php

namespace Tests\Feature;

use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_tasks_to_projects()
    {
        $project = factory('App\Project')->create();
        $this->post($project->tasksPath())->assertRedirect('login');
    }

    /** @test */
    public function only_the_owner_of_a_project_may_add_tasks()
    {
        $this->signIn();
        $project = factory('App\Project')->create();

        $this->post($project->tasksPath(), ['body' => 'Test Task'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test Task']);
    }

        /** @test */
        public function only_the_owner_of_a_project_may_update_tasks()
        {
            $this->signIn();
            $project = factory('App\Project')->create();
            $task = $project->addTask('Test Task');
    
            $this->patch($task->path(), ['body' => 'Changed'])
                ->assertStatus(403);
    
            $this->assertDatabaseMissing('tasks', ['body' => 'Changed']);
        }

    /** @test */
    public function a_project_can_have_tasks() 
    {
        $this->withoutExceptionHandling();

        $this->signIn();
        $project = auth()->user()->projects()->create(
            factory(Project::class)->raw()
        );

        $this->post($project->tasksPath(), ['body' => 'Test Task']);
        $this->get($project->path())->assertSee('Test Task');
    }
    
    /** @test */
    function a_task_can_be_updated() 
    {
        $this->withoutExceptionHandling();

        $this->signIn();
        $project = auth()->user()->projects()->create(
            factory(Project::class)->raw()
        );

        $task = $project->addTask('Test task');

        $changeData = [
            'body' => 'changed',
            'completed' => true
        ];

        $this->patch($task->path(), $changeData);
        $this->assertDatabaseHas('tasks', $changeData);
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        //$this->withoutExceptionHandling();
        $this->signIn();
        $project = auth()->user()->projects()->create(
            factory(Project::class)->raw()
        );

        $attributes = factory('App\Task')->raw(['body' => '']);

        $this->post($project->tasksPath(), $attributes)->assertSessionHasErrors('body');
    }
}
