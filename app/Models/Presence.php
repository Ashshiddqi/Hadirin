<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// App\Models\Presence.php
class Presence extends Model
{
    protected $fillable = [
        'user_id',
        'event_id',
        'scan_time',
    ];

    protected $casts = [
        'scan_time' => 'datetime', // ✅ Ini penting
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}

