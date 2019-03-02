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
    public function guests_cannot_add_tast_to_projects()
    {
        $project = factory(Project::class)->create();

        $this->post(route('projects.tasks.add', ['project' => $project]))->assertRedirect(route('login'));
    }

    /** @test */

    public function only_owner_can_add_tasks()
    {
        $this->signIn();

        $project = factory(Project::class)->create();

        $this->post(route('projects.tasks.add', ['project' => $project]), ['body' => 'Test task #1-only-owner-can-add-tasks'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task #1-only-owner-can-add-tasks']);
    }

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

    /** @test */
    public function a_task_can_be_updated()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(
            factory(Project::class)->raw()
        );

        $task = $project->addTask('Test ask');

        $this->patch(route('projects.tasks.patch', ['project' => $project, 'task' => $task]), [
            'body' => 'changed',
            'completed' => true
        ]);

        $this->assertDatabaseHas('tasks',[
            'body' => 'changed',
            'completed' => true
        ]);
    }

    /** @test */
    public function only_owner_can_update_a_task()
    {
        $this->signIn();

        $project = factory(Project::class)->create();

        $task = $project->addTask('Test task');

        $this->patch(route('projects.tasks.patch', ['project' => $project, 'task' => $task]), [
            'body' => 'Failed update',
        ])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', [
            'body' => 'Failed Update',
        ]);
    }
}