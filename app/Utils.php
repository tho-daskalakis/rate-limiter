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

    static function hashUserData($name, $pw, $tz): string
    {
        $userData = [
            'name' => $name,
            'password' => $pw,
            'timezone' => $tz,
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
