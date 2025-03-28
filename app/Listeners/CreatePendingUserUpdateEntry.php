<?php

namespace App\Listeners;

use App\Events\UserUpdated;
use App\Jobs\SyncUserDataWithProvider;
use App\Utils;
use Illuminate\Support\Facades\DB;

class CreatePendingUserUpdateEntry
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserUpdated $event): void
    {
        // Access user through $event->user...
        $user = $event->user;

        // Check if entry exists.
        $user_entry = DB::table('pending_updates')->where('user_id', '=', $user->id)->first();
        if ($user_entry) return;

        // Entry doesn't exist, create a new one.
        DB::table('pending_updates')->insert([
            'user_id' => $event->user->id,
            'data_hash' => Utils::hashUserData($user->name, $user->password, $user->timezone),
        ]);

        // Check #entries.
        $entries_count = DB::table('pending_updates')->count();
        if ($entries_count > 999) {
            // Dispatch a sync job.
            SyncUserDataWithProvider::dispatch();
        }
    }
}
