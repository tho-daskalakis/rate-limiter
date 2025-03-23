<?php

namespace App\Services;

use App\Events\UserUpdated;
use App\Models\PendingUpdate;
use App\Models\User;
use App\Utils;
use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\InvalidArgumentException;

class ProcessUserUpdateService
{
    /**
     * Check the state of the user's data the first time they update, until synced.
     * Only keep the state of the data at that point in time, which is the data that
     * the third party owns. When the sync action is dispatched, it will check for
     * an updated state of the user's data.
     * @param User $user The user making the request to update their data.
     * @param array $userData The user's data from the request.
     */
    function checkForExistingUserEntry(User $user, array $userData): void {
        $currentUserHash = Utils::hashUserData($userData);

        // If no changes are made, return.
        if (Utils::hashUserData($user->only(['name', 'password', 'timezone']) == $currentUserHash)) return;

        // Check if user-update record already exists.
        try {
            // User's email record exists, don't recreate entry.
            // TODO: check in db instead of cache
            if (Cache::store('redis')->has($user->email)) return;
        } catch (InvalidArgumentException $e) {
            // Handle exception...
            return;
        }

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
