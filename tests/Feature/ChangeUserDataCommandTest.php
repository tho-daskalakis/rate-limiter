<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ChangeUserDataCommandTest extends TestCase
{
    use RefreshDatabase;
    protected bool $seed = true;

    public function testUserCount(): void {
        $this->assertDatabaseCount('users', 20);
    }

    public function testUserNameChanged(): void {
        $user1 = DB::table('users')->where('id', 1)->first();

        // Run the command
        $this->artisan('app:change-user-data');

        $changedUser1 = DB::table('users')->where('id', 1)->first();
        //         print "$user1->name, $user1->email\n";`
        //         print "$changedUser1->name, $user1->email\n";

        $this->assertNotEquals($changedUser1->name, $user1->name);
    }

}
