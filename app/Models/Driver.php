<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
    ];

    /**
     * Driver can have many rides
     */
    public function rides()
    {
        return $this->hasMany(Ride::class);
    }

    /**
     * Driver can request many rides
     */
    public function rideRequests()
    {
        return $this->hasMany(RideDriverRequest::class);
    }
}
