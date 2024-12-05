<?php

namespace App\Listeners;

use App\Events\NewUsersCacheEntry;
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
    public function handle(NewUsersCacheEntry $event): void
    {
        //
    }
}
