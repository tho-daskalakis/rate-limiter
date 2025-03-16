<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChangeUserDataCommandTest extends TestCase
{
    use RefreshDatabase;
    protected bool $seed = true;

    public function testUserCount(): void {
        $this->assertDatabaseCount('users', 20);
    }

}
