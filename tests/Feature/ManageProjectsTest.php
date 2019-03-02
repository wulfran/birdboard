<?php

namespace Tests\Feature;

use App\Models\Project;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */

    public function user_can_create_project()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributes = factory(Project::class)->raw(['user_id' => auth()->id()]);

        $this->post('/projects', $attributes)->assertRedirect();

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */

    public function a_project_requires_a_title()
    {
        $this->signIn();

        $attributes = factory('App\Models\Project')->make(['title' => ''])->toArray();

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /**  @test */

    public function a_project_requires_a_description()
    {
        $this->signIn();

        $attributes = factory('App\Models\Project')->make(['description' => ''])->toArray();

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_view_their_project()
    {
        $this->signIn();

//        $this->withoutExceptionHandling();

        $project= factory('App\Models\Project')->create(['user_id' => auth()->id()]);

        $this->get($project->getUrl())
            ->assertStatus(200)
            ->assertSee($project->title)
            ->assertSee(str_limit($project->description, 100))
        ;
    }

    /** @test */
    public function user_can_view_only_his_own_projects()
    {
        $this->signIn();

//        $this->withoutExceptionHandling();

        $project= factory('App\Models\Project')->create();

        $this->get($project->getUrl())->assertStatus(403);
    }

    /** @test */
    public function a_project_requires_an_owner()
    {
        $attributes = factory(Project::class)->raw(['user_id' => NULL]);

        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    /** @test */
    public function guests_may_not_view_projects()
    {
        $this->get(route('projects.list'))->assertRedirect('login');
    }

    /** @test */
    public function guests_cannot_view_a_single_project()
    {
        $project = factory(Project::class)->create();

        $this->get(route('projects.show', ['project' => $project->id]))->assertRedirect('login');
    }

    /** @test */
    public function guest_cannot_create_a_project()
    {
        $this->get(route('projects.create'))->assertRedirect('login');
    }
}
