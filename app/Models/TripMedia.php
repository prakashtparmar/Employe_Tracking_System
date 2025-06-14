<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TripMedia extends Model
{
    protected $fillable = ['trip_id', 'user_id', 'media_type', 'media_url', 'uploaded_at'];

    public function trip(): BelongsTo {
        return $this->belongsTo(Trip::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
