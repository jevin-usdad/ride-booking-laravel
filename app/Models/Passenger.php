<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * A passenger can have many rides
     */
    public function rides()
    {
        return $this->hasMany(Ride::class);
    }
}
