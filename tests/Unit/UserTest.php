<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /** @test */

    public function has_projects()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $user->projects);
    }
}
