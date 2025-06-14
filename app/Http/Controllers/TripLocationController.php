<?php

namespace App\Http\Controllers;

use App\Models\TripLocation;
use App\Models\Trip;
use Illuminate\Http\Request;
use Auth;

class TripLocationController extends Controller
{
    public function store(Request $request, Trip $trip) {
        $data = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'recorded_at' => 'required|date',
            'battery_level' => 'nullable|integer',
            'speed' => 'nullable|numeric',
            'accuracy' => 'nullable|numeric'
        ]);
        $data['user_id'] = Auth::id();
        $trip->locations()->create($data);
        return response()->json(['status' => 'success']);
    }

    public function index(Trip $trip) {
        $locations = $trip->locations;
        return response()->json($locations);
    }
}
