<?php

namespace App\Services;

use App\Events\UserUpdated;
use App\Models\PendingUpdate;
use App\Models\User;
use App\Utils;
use Illuminate\Support\Facades\DB;

class ProcessUserUpdateService
{
    /**
     * Check the state of the user's data the first time they update, until synced.
     * Only keep the state of the data at that point in time, which is the data that
     * the third party owns. When the sync action is dispatched, it will check for
     * an updated state of the user's data.
     * @param User $user The user making the request to update their data.
     * @param object $userData The user's data from the request.
     */
    function checkForExistingUserEntry(User $user, object $userData): void {
        $currentUserHash = Utils::hashUserData($user->name, $user->password, $user->timezone);

        // If no changes are made, return.
        if (Utils::hashUserData($userData->name, $userData->password, $userData->timezone)) return;

        // Check if user-update record already exists.
        $userRecord = DB::table('pending_updates')->select()->where('user_id', '=', $user->id)->first();
        if ($userRecord !== null) return;

        // User has their data changed and no record exists.
        // Add new entry to db & dispatch user-updated event.
        $pendingUpdate = new PendingUpdate([
            'user_id' => $user->id,
            'data_hash' => $currentUserHash,
        ]);
        $pendingUpdate->save();

        UserUpdated::dispatch($user);
    }
}
