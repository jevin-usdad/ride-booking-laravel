<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Driver;

class DriverSeeder extends Seeder
{
    public function run()
    {
        Driver::insert([
            ['name' => 'Driver One', 'latitude' => 23.01, 'longitude' => 72.57],
            ['name' => 'Driver Two', 'latitude' => 23.03, 'longitude' => 72.58],
        ]);
    }
}

