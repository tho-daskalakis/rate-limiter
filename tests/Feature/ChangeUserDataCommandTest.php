<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChangeUserDataCommandTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCount(): void {
        $this->seed();
        $this->assertDatabaseCount('users', 20);
    }

}
