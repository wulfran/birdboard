<?php

namespace Tests\Unit;

use App\Models\Project;
use App\User;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */

    public function it_has_a_path()
    {
        $project = factory('App\Models\Project')->create();

        $this->assertSame(URL::to('/') .'/projects/' . $project->id, $project->getUrl());
    }

    /** @test */
    public function project_belongs_to_an_user()
    {
        $project = factory(Project::class)->create();

        $this->assertInstanceOf(User::class, $project->user);
    }

    /** @test */
    public function it_can_add_a_task()
    {
        $project = factory(Project::class)->create();

        $task = $project->addTask('Test task');

        $this->assertCount(1,$project->tasks);

        $this->assertTrue($project->tasks->contains($task));
    }
}
