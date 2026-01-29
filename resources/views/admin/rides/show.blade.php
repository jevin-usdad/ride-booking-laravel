@extends('layouts.app')

@section('title', 'Ride Details')

@section('content')

    <div class="max-w-4xl mx-auto bg-white shadow rounded-lg">

        <!-- Header -->
        <div class="flex items-center justify-between p-6 border-b">
            <h2 class="text-2xl font-semibold text-gray-800">
                Ride #{{ $ride->id }}
            </h2>

            <span class="px-4 py-1 rounded-full text-sm font-semibold {{ $ride->status->badge() }}">
                {{ $ride->status->label() }}
            </span>
        </div>

        <div class="p-6 space-y-6">

            <!-- Passenger & Driver -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-500">Passenger</p>
                    <p class="text-lg font-medium text-gray-800">
                        {{ $ride->passenger->name }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Driver</p>
                    <p class="text-lg font-medium text-gray-800">
                        {{ optional($ride->driver)->name ?? 'Not assigned' }}
                    </p>
                </div>
            </div>

            <!-- Pickup & Destination -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500 mb-1">Pickup</p>
                    <p class="font-mono">{{ $ride->pickup_lat }}, {{ $ride->pickup_lng }}</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500 mb-1">Destination</p>
                    <p class="font-mono">{{ $ride->destination_lat }}, {{ $ride->destination_lng }}</p>
                </div>
            </div>

            <!-- Map -->
            <div id="map" class="w-full h-80 rounded border" data-pickup-lat="{{ $ride->pickup_lat }}"
                data-pickup-lng="{{ $ride->pickup_lng }}" data-destination-lat="{{ $ride->destination_lat }}"
                data-destination-lng="{{ $ride->destination_lng }}"
                data-driver-lat="{{ optional($ride->driver)->latitude }}"
                data-driver-lng="{{ optional($ride->driver)->longitude }}">
            </div>


        </div>

        <!-- Timestamps -->
        <div class="bg-gray-50 p-6 rounded-lg border">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Ride Timestamps
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">

                <div class="flex justify-between">
                    <span class="text-gray-500">Ride Created</span>
                    <span class="font-medium text-gray-800">
                        {{ $ride->created_at->diffForHumans() }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-500">Last Updated</span>
                    <span class="font-medium text-gray-800">
                        {{ $ride->updated_at->diffForHumans() }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-500">Passenger Completed</span>
                    <span class="font-medium {{ $ride->passenger_completed ? 'text-green-600' : 'text-gray-400' }}">
                        {{ $ride->passenger_completed ? 'Yes' : 'Pending' }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-500">Driver Completed</span>
                    <span class="font-medium {{ $ride->driver_completed ? 'text-green-600' : 'text-gray-400' }}">
                        {{ $ride->driver_completed ? 'Yes' : 'Pending' }}
                    </span>
                </div>

                <div class="flex justify-between md:col-span-2">
                    <span class="text-gray-500">Ride Fully Completed</span>
                    <span class="font-semibold {{ $ride->isFullyCompleted() ? 'text-green-700' : 'text-red-600' }}">
                        {{ $ride->isFullyCompleted() ? 'Completed' : 'In Progress' }}
                    </span>
                </div>

            </div>
        </div>


    </div>



    {{-- Load JS --}}
    <script src="{{ asset('js/admin/ride-map.js') }}"></script>


@endsection
