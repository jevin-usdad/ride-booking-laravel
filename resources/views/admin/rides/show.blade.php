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

    </div>

    <!-- Fullscreen Modal -->
    <div id="mapModal" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50">
        <div class="bg-white w-11/12 h-5/6 rounded-lg relative">
            <button id="closeMapBtn" class="absolute top-3 right-4 text-xl text-gray-600 hover:text-black">
                ✕
            </button>

            <div id="mapFullscreen" class="w-full h-full rounded-lg"></div>
        </div>
    </div>

    {{-- Load JS --}}
    <script src="{{ asset('js/admin/ride-map.js') }}"></script>


@endsection
