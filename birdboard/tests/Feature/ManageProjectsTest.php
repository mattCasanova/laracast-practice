<?php

namespace Tests\Feature;

use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function guests_cannot_manage_projects()
    {
        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        

        $project = ProjectFactory::create();
        $this->get($project->path())->assertRedirect('login');
        $this->get($project->path() . '/edit')->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');
    }

    /** @test */
    public function guests_cannot_create_projects()
    {
        $project = ProjectFactory::create();
        $this->post('/projects', $project->toArray())->assertRedirect('login');
    }

    /** @test */
    public function guests_may_not_view_projects()
    {
        $this->get('/projects')->assertRedirect('login');
    }

    /** @test */
    public function guests_may_not_view_a_single_project()
    {
        $project = ProjectFactory::create();
        $this->get($project->path())->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->signIn();
        $this->get('projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'notes' => 'General notes here.',
        ];

        $response = $this->post('/projects', $attributes);
        $project = Project::where($attributes)->first();

        $response->assertRedirect($project->path());
        $this->assertDatabaseHas('projects', $attributes);
        $this->get($project->path())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    /** @test */
    public function a_user_can_update_a_project()
    {
        $project = ProjectFactory::ownedBy($this->signIn())->create();
        $attributes = [
            'title' => 'Changed', 
            'description' => 'Changed',
            'notes' => 'Changed'
        ];

        $this->patch($project->path(), $attributes)
            ->assertRedirect($project->path());
        $this->get($project->path() . '/edit')->assertOk();
        $this->assertDatabaseHas('projects', $attributes);
    }

    /** @test */
    public function a_user_can_update_a_projects_general_notes()
    {
        $project = ProjectFactory::ownedBy($this->signIn())->create();
        $attributes = ['notes' => 'Changed'];

        $this->patch($project->path(), $attributes);
        $this->get($project->path() . '/edit')->assertOk();
        $this->assertDatabaseHas('projects', $attributes);
    }

    /** @test */
    public function a_user_can_view_thier_project()
    {
        $project = ProjectFactory::ownedBy($this->signIn())->create();

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_project_of_others()
    {
        $this->signIn();
        $project = ProjectFactory::create();
        $this->get($project->path())->assertStatus(403);
    }

    /** @test */
    public function an_authenticated_user_cannot_update_the_project_of_others()
    {
        $this->signIn();

        $project = ProjectFactory::create();
        $this->patch($project->path())->assertStatus(403);
    }

    /** @test */
    public function a_project_requires_a_title()
    {
        $this->signIn();
        $attributes = factory('App\Project')->raw(['title' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $this->signIn();
        $attributes = factory('App\Project')->raw(['description' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
