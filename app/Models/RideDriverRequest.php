<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RideDriverRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'ride_id',
        'driver_id',
    ];

    /**
     * Request belongs to a ride
     */
    public function ride()
    {
        return $this->belongsTo(Ride::class);
    }

    /**
     * Request belongs to a driver
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
