<?php

namespace App\Services;

use Carbon\CarbonInterval;
use Illuminate\Support\Carbon;

class RateLimitService
{
    private int $HOURLY_BATCH_REQUEST_LIMIT = 50;

    private Carbon $hourlyCycleTimestamp;
    private int $remainingBatchRequests;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->resetTimestamp();
        $this->resetRemainingBatchRequests();
    }

    public function resetTimestamp(): void
    {
        $this->hourlyCycleTimestamp = now();
    }

    public function getTimeElapsed(): CarbonInterval
    {
        return now()->diff($this->hourlyCycleTimestamp);
    }

    private function resetRemainingBatchRequests(): void
    {
        $this->remainingBatchRequests = $this->HOURLY_BATCH_REQUEST_LIMIT;
    }

    public function resetRateLimits(): void
    {
        $this->resetTimestamp();
        $this->resetRemainingBatchRequests();
    }

    public function getRemainingBatchRequests(): int
    {
        return $this->remainingBatchRequests;
    }
}
