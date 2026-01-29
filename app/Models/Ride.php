<?php

namespace App\Models;

use App\RideStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ride extends Model
{
    use HasFactory;

    protected $fillable = [
        'passenger_id',
        'driver_id',
        'pickup_lat',
        'pickup_lng',
        'destination_lat',
        'destination_lng',
        'status',
        'passenger_completed',
        'driver_completed',
    ];

    protected $casts = [
        'passenger_completed' => 'boolean',
        'driver_completed'    => 'boolean',
        'status' => RideStatus::class,
    ];

    /**
     * Ride belongs to a passenger
     */
    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }

    /**
     * Ride belongs to a driver (nullable)
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    /**
     * Ride can have multiple driver requests
     */
    public function driverRequests()
    {
        return $this->hasMany(RideDriverRequest::class);
    }

    /**
     * Check if ride is fully completed
     */
    public function isFullyCompleted(): bool
    {
        return $this->passenger_completed && $this->driver_completed;
    }
}
