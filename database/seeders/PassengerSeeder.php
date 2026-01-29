<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Passenger;

class PassengerSeeder extends Seeder
{
    public function run()
    {
        Passenger::insert([
            ['name' => 'Rahul'],
            ['name' => 'Amit'],
        ]);
    }
}

