<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ProcessUserUpdateServiceTest extends TestCase
{
    use RefreshDatabase;
    protected bool $seed = true;

    public function testUserUpdateEndpointReturns_302(): void {
        $user = User::factory()->create();

        $response = $this->patch("/users/$user->id",
            [
                'name' => 'Test User',
                'password' => 'password',
                'timezone' => 'Test Timezone',
            ]);

        $response->assertStatus(302);
    }

    public function testUserUpdateEndpointCreatesPendingUpdateEntry(): void {
        $user = User::factory()->create();

        $response = $this->patch("/users/$user->id",
            [
                'name' => 'Test User',
                'password' => 'password',
                'timezone' => 'Test Timezone',
            ]);

        $this->assertDatabaseCount('pending_updates', 1);
    }

    public function testUserUpdateEndpointDispatchesEvent(): void {
        Event::fake();

        $user = User::factory()->create();

        $response = $this->patch("/users/$user->id",
            [
                'name' => 'Test User',
                'password' => 'password',
                'timezone' => 'Test Timezone',
            ]);

        Event::assertDispatched('UserUpdated');
    }
}
