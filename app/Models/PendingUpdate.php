<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PendingUpdate extends Model
{
    protected $attributes = [
        'user_id' => 'int',
        'data_hash' => 'string',
        'status' => 'pending',
        'tries' => 0
    ];
}
