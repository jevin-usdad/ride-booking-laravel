<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Ride;
use App\Models\RideDriverRequest;
use App\RideStatus;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function updateLocation(Request $request)
    {
        $data = $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        Driver::findOrFail($data['driver_id'])->update($data);

        return response()->json(['message' => 'Location updated']);
    }

    public function nearbyRides(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $radius = 5; // km

        $rides = Ride::where('status', RideStatus::PENDING->value)
            ->selectRaw("
                *, (6371 * acos(
                    cos(radians(?)) * cos(radians(pickup_lat))
                    * cos(radians(pickup_lng) - radians(?))
                    + sin(radians(?)) * sin(radians(pickup_lat))
                )) AS distance
            ", [$request->latitude, $request->longitude, $request->latitude])
            ->having('distance', '<=', $radius)
            ->orderBy('distance')
            ->get();

        return response()->json($rides);
    }

    public function requestRide(Request $request, Ride $ride)
    {
        $request->validate([
            'driver_id' => 'required|exists:drivers,id'
        ]);

        RideDriverRequest::firstOrCreate([
            'ride_id' => $ride->id,
            'driver_id' => $request->driver_id,
        ]);

        $ride->update(['status' => RideStatus::DRIVER_REQUESTED->value]);

        return response()->json(['message' => 'Ride requested']);
    }

    public function completeRide(Ride $ride)
    {
        $ride->update(['driver_completed' => true]);

        if ($ride->isFullyCompleted()) {
            $ride->update(['status' => RideStatus::COMPLETED->value]);
        }

        return response()->json(['message' => 'Driver marked ride completed']);
    }
}
