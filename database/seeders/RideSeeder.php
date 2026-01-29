<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ride;

class RideSeeder extends Seeder
{
    public function run()
    {
        Ride::create([
            'passenger_id' => 1,
            'pickup_lat' => 23.01,
            'pickup_lng' => 72.57,
            'destination_lat' => 23.05,
            'destination_lng' => 72.60,
            'status' => 'pending',
        ]);
    }
}

