<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\RateLimitService;

class ResetRateLimits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ratelimit:reset-limits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset the hourly timestamp and remaining batch requests in the RateLimitService';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(RateLimitService $rateLimitService)
    {
        $rateLimitService->resetRateLimits();
        $this->info('Rate limits have been reset.');
    }
}
