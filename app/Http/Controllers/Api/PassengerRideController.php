<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Passenger\CreateRideRequest;
use App\Models\Ride;
use Illuminate\Http\Request;

class PassengerRideController extends Controller
{
    public function store(CreateRideRequest $request)
    {
        $ride = Ride::create($request->validated());

        return response()->json($ride, 201);
    }

    public function approveDriver(Request $request, Ride $ride)
    {
        $request->validate([
            'driver_id' => 'required|exists:drivers,id'
        ]);

        $ride->update([
            'driver_id' => $request->driver_id,
            'status' => 'approved'
        ]);

        return response()->json(['message' => 'Driver approved']);
    }

    public function completeRide(Ride $ride)
    {
        $ride->update(['passenger_completed' => true]);

        if ($ride->isFullyCompleted()) {
            $ride->update(['status' => 'completed']);
        }

        return response()->json(['message' => 'Passenger marked ride completed']);
    }
}
