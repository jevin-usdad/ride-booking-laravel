<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS (CDN – OK for assessments) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold text-gray-800">
                Ride Booking Admin
            </h1>

            <nav class="space-x-4">
                <a href="{{ url('/admin/rides') }}" class="text-gray-600 hover:text-indigo-600 font-medium">
                    Rides
                </a>
            </nav>
        </div>
    </header>

    <!-- Page Content -->
    <main class="flex-1 max-w-7xl mx-auto w-full px-6 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t">
        <div class="max-w-7xl mx-auto px-6 py-4 text-sm text-gray-500 text-center">
            © {{ date('Y') }} Ride Booking System
        </div>
    </footer>

</body>

</html>
