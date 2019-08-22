<?php

namespace Tests\Feature;

use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_tasks_to_projects()
    {
        $project = ProjectFactory::create();
        $this->post($project->tasksPath())->assertRedirect('login');
    }

    /** @test */
    public function only_the_owner_of_a_project_may_add_tasks()
    {
        $this->signIn();
        $project = ProjectFactory::create();

        $attributes = ['body' => 'Test Task'];

        $this->post($project->tasksPath(), $attributes)->assertStatus(403);
        $this->assertDatabaseMissing('tasks', $attributes);
    }

    /** @test */
    public function only_the_owner_of_a_project_may_update_tasks()
    {
        $this->signIn();
        $project = ProjectFactory::withTasks(1)->create();

        $attributes = ['body' => 'Changed'];

        $this->patch($project->tasks->first()->path(), $attributes)->assertStatus(403);
        $this->assertDatabaseMissing('tasks', $attributes);
    }

    /** @test */
    public function a_project_can_have_tasks()
    {
        $project = ProjectFactory::ownedBy($this->signIn())->create();
        
        $this->post($project->tasksPath(), ['body' => 'Test Task']);
        $this->get($project->path())->assertSee('Test Task');
    }

    /** @test */
    function a_task_can_be_updated()
    {
        $project = ProjectFactory::ownedBy($this->signIn())->withTasks(1)->create();

        $changeData = [
            'body' => 'changed',
            'completed' => true
        ];

        $this->patch($project->tasks->first()->path(), $changeData);
        $this->assertDatabaseHas('tasks', $changeData);
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $project = ProjectFactory::ownedBy($this->signIn())->create();

        $attributes = factory('App\Task')->raw(['body' => '']);
        $this->post($project->tasksPath(), $attributes)->assertSessionHasErrors('body');
    }
}
