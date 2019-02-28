<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_have_tasks()
    {
        $this->signIn();

        $project = factory(Project::class)->create(['user_id' => auth()->id()]);

        $this->post(route('projects.tasks.add', ['project' => $project]), ['body' => 'Test task']);

        $this->get(route('projects.show', ['project' => $project]))
            ->assertSee('Test task');
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(
            factory(Project::class)->raw()
        );

        $data = factory(Task::class)->raw(['body' => '']);

        $this->post(route('projects.tasks.add', ['project' => $project]), $data)
            ->assertSessionHasErrors('body')
        ;
    }
}