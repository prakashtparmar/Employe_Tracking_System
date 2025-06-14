<?php

namespace App\Http\Controllers;

use App\Models\TripMedia;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;

class TripMediaController extends Controller
{
    public function store(Request $request, Trip $trip) {
        $data = $request->validate([
            'media_type' => 'required|in:photo,video,receipt',
            'media_file' => 'required|file|mimes:jpeg,png,jpg,mp4,pdf'
        ]);

        $path = $request->file('media_file')->store('trip_media');
        TripMedia::create([
            'trip_id' => $trip->id,
            'user_id' => Auth::id(),
            'media_type' => $data['media_type'],
            'media_url' => $path,
            'uploaded_at' => now()
        ]);

        return back()->with('success', 'Media uploaded');
    }
}
