<?php

namespace App\Http\Requests\Passenger;

use Illuminate\Foundation\Http\FormRequest;

class CreateRideRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'passenger_id' => 'required|exists:passengers,id',
            'pickup_lat' => 'required|numeric',
            'pickup_lng' => 'required|numeric',
            'destination_lat' => 'required|numeric',
            'destination_lng' => 'required|numeric',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
