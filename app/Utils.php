<?php

namespace App;

class Utils
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    static function hashUserData($userData): string
    {
        $sorted = ksort($userData);

        $serialized = serialize($sorted);

        return hash('md5', $serialized);
    }
}
