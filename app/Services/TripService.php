<?php

namespace App\Services;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripService
{
    public function addEditTrip(Request $request)
    {
        if (!Auth::guard('admin')->check()) {
            return [
                'success' => false,
                'message' => 'Admin user is not authenticated.',
            ];
        }

        $tripId = $request->input('id');
        $trip = $tripId ? Trip::find($tripId) : new Trip();

        $trip->user_id = Auth::guard('admin')->id();
        $trip->trip_date = $request->input('trip_date');
        $trip->start_time = $request->input('start_time');
        $trip->end_time = $request->input('end_time');
        $trip->start_lat = $request->input('start_lat');
        $trip->start_lng = $request->input('start_lng');
        $trip->end_lat = $request->input('end_lat');
        $trip->end_lng = $request->input('end_lng');
        $trip->total_distance_km = $request->input('total_distance_km');
        $trip->purpose = $request->input('purpose');
        $trip->travel_mode = $request->input('travel_mode');

        $trip->save();

        return [
            'success' => true,
            'message' => $tripId ? 'Trip updated successfully' : 'Trip created successfully',
            'trip' => $trip
        ];
    }

    public function deleteTrip($id)
    {
        Trip::where('id', $id)->delete();
        $message = 'Trip deleted successfully!';
        return ['message' => $message];
    }

    public function approveTrip($trip)
    {
        $trip->update([
            'approval_status' => 'approved',
            'approved_by' => Auth::guard('admin')->user()->id,
            'approved_at' => now(),
        ]);
    }


    public function denyTrip(Trip $trip, string $reason)
    {
        $trip->update([
            'approval_status' => 'Rejected',
            'approval_reason' => $reason,
            'approved_by' => Auth::guard('admin')->user()->id,
            'approved_at' => now(),
        ]);
    }
}
