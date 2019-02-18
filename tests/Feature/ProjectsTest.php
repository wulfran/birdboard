<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase, WithoutMiddleware;

    /** @test */

    public function user_can_create_project()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $this->post('/projects', $attributes)->assertRedirect();

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */

    public function a_project_requires_a_title()
    {
        $attributes = factory('App\Models\Project')->make(['title' => ''])->toArray();

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /**  @test */

    public function a_project_requires_a_description()
    {
        $attributes = factory('App\Models\Project')->make(['description' => ''])->toArray();

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_view_a_project(){
        $this->withoutExceptionHandling();

        $project= factory('App\Models\Project')->create();

        $this->get($project->getUrl())
            ->assertStatus(200)
            ->assertSee('Birdboard')
            ->assertSee($project->title)
            ->assertSee($project->description)
        ;
    }
}
