<?php

namespace Database\Seeders;

use App\Models\Trip; // Import the Trip model
use App\Models\TripMedia; // Import the TripMedia model
use App\Models\User; // Import the User model
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Import Hash facade

class TripMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the ID of the first user and first trip
        $userId = User::first()->id;
        $tripId = Trip::first()->id;

        // Clear existing trip media to prevent duplicates on re-seeding
        TripMedia::truncate();

        // --- Sample trip media records with various media_types ---

        // Image media for a bike trip
        TripMedia::create([
            'trip_id' => $tripId,
            'user_id' => $userId,
            'media_type' => 'bike',
            'media_url' => 'https://placehold.co/600x400/FF0000/FFFFFF?text=Car_Trip_Pic',
            'uploaded_at' => now(),
        ]);

        // Video media for a car trip
        TripMedia::create([
            'trip_id' => $tripId,
            'user_id' => $userId,
            'media_type' => 'car',
            'media_url' => 'https://placehold.co/600x400/0000FF/FFFFFF?text=Bike_Ride_Vid',
            'uploaded_at' => now()->addMinutes(5),
        ]);

        // Generic photo for a bus trip
        TripMedia::create([
            'trip_id' => $tripId,
            'user_id' => $userId,
            'media_type' => 'bus',
            'media_url' => 'https://placehold.co/600x400/00FF00/FFFFFF?text=Bus_Ticket',
            'uploaded_at' => now()->addMinutes(10),
        ]);

        // Another general image/video
        TripMedia::create([
            'trip_id' => $tripId,
            'user_id' => $userId,
            'media_type' => 'truck',
            'media_url' => 'https://placehold.co/600x400/FFD700/000000?text=GPS_Data',
            'uploaded_at' => now()->addMinutes(15),
        ]);

        $this->command->info('TripMedia seeded successfully!');
    }
}
