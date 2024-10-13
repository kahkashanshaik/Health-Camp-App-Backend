<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div
        class="min-h-screen row flex flex-col-reverse lg:flex-row justify-center items-center   pt-6 sm:pt-0 bg-primary-light">
        <div class="column w-full lg:w-1/2 lg:pt-11 ">
            <x-signup-illustration />
        </div>
        <div class="flex flex-col w-full lg:w-1/2 sm:max-w-md prose px-7 mb-10 lg:mb-0 lg:px-0">
            <x-application-logo class="w-28" />
            {{-- <h1 class="text-center text-primary">Shaheen Health Campp App</h1> --}}
            <div class="px-6 py-4 bg-white shadow-3xl overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
