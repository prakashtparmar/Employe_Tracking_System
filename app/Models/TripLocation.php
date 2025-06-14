<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Model;

class TripLocation extends Model
{
    protected $fillable = [
        'trip_id', 'user_id', 'latitude', 'longitude',
        'recorded_at', 'battery_level', 'speed', 'accuracy'
    ];

    public function trip(): BelongsTo {
        return $this->belongsTo(Trip::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
