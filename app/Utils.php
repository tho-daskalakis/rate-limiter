<?php

namespace App;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class Utils
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    static function hashUserData($user): string
    {
        $userData = [
            'name' => $user->name,
            'password' => $user->password,
            'timezone' => $user->timezone,
        ];

        $sorted = ksort($userData);

        $serialized = serialize($sorted);

        return hash('md5', $serialized);
    }

    static function countCacheItems(): int
    {
        return DB::table('cache')->count();
    }
}
