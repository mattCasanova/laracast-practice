<?php

namespace Tests\Feature;

use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TriggerActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function creating_a_project()
    {
        $project = ProjectFactory::create();

        $this->assertCount(1, $project->activity);
        $this->assertEquals('created', $project->activity[0]->description);
    }

    /** @test */
    function updating_a_project() 
    {
        $project = ProjectFactory::create();

        $project->update(['title' => 'Changed']);

        $this->assertCount(2, $project->activity);
        $this->assertEquals('updated', $project->activity->last()->description);
    }

    /** @test */
    function creating_a_new_task() 
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->assertCount(2, $project->activity);
        $this->assertEquals('created_task', $project->activity->last()->description);
    }

      /** @test */
      function completing_a_task() 
      {
          $project = ProjectFactory::withTasks(1)->ownedBy($this->signIn())->create();
  
          $this->patch($project->tasks[0]->path(), [
              'body' => 'foobar',
              'completed' => true
          ]);

          $this->assertCount(3, $project->activity);
          $this->assertEquals('completed_task', $project->activity->last()->description);
      }

    /** @test */
    function marking_a_task_incomplete() 
    {
        $project = ProjectFactory::withTasks(1)->ownedBy($this->signIn())->create();
    
        $this->patch($project->tasks[0]->path(), [
            'body' => 'foobar',
            'completed' => true
        ]);
  
        $this->assertCount(3, $project->activity);

        $this->patch($project->tasks[0]->path(), [
            'body' => 'foobar',
            'completed' => false
        ]);

        $project = $project->fresh();

        $this->assertCount(4, $project->activity);
        $this->assertEquals('incompleted_task', $project->activity->last()->description);
    }

    /** @test */
    public function deleting_a_task()
    {
        $project = ProjectFactory::withTasks(1)->ownedBy($this->signIn())->create();

        $project->tasks[0]->delete();

        $this->assertCount(3, $project->activity);
    }
}
