<?php

namespace App\Listeners;

use Illuminate\Cache\Events\KeyWritten;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RunPostEntryActions
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
    public function handle(KeyWritten $event): void
    {
        //
    }
}
