@extends('layouts.app')

@section('title', 'Ride Details')

@section('content')

    <div class="max-w-7xl mx-auto bg-white shadow rounded-lg">
        <div class="p-6 border-b">
            <h2 class="text-2xl font-semibold text-gray-800">
                All Rides
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                            ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                            Passenger
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                            Driver
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                            Created At
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase">
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($rides as $ride)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm text-gray-700">
                                #{{ $ride->id }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $ride->passenger->name }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $ride->driver->name ?? '—' }}
                            </td>

                            <td class="px-6 py-4 text-sm">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'driver_requested' => 'bg-blue-100 text-blue-800',
                                        'approved' => 'bg-indigo-100 text-indigo-800',
                                        'completed' => 'bg-green-100 text-green-800',
                                    ];
                                @endphp

                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $ride->status->badge() }}">
                                    {{ $ride->status->label() }}
                                </span>

                            </td>

                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $ride->created_at->format('d M Y, h:i A') }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                <a href="{{ url('/admin/rides/' . $ride->id) }}"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium
                                          text-white bg-indigo-600 rounded hover:bg-indigo-700 transition">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                No rides found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
