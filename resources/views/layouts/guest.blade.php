<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Pahinga - Login</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('pahinga.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('pahinga.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex items-center justify-center bg-gradient-horizon-soft dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 relative overflow-hidden">
            <!-- Animated gradient background -->
            <div class="absolute inset-0 bg-gradient-navy opacity-5 dark:opacity-10"></div>

            <!-- Background decorative elements -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute -top-40 -right-40 w-96 h-96 bg-primary-800 dark:bg-primary-900 rounded-full mix-blend-multiply dark:mix-blend-soft-light filter blur-3xl opacity-20 dark:opacity-15 animate-pulse-slow"></div>
                <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-secondary-500 dark:bg-secondary-800 rounded-full mix-blend-multiply dark:mix-blend-soft-light filter blur-3xl opacity-20 dark:opacity-15 animate-pulse-slow" style="animation-delay: 1s;"></div>
                <div class="absolute top-1/2 left-1/3 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-teal-400 dark:bg-teal-900 rounded-full mix-blend-multiply dark:mix-blend-soft-light filter blur-3xl opacity-20 dark:opacity-10 animate-pulse-slow" style="animation-delay: 2s;"></div>
            </div>

            <!-- Content -->
            <div class="relative z-10 flex items-center justify-center gap-12 w-full max-w-5xl px-4 py-12">
                <!-- Left Side - Logo & Branding (Desktop Only) -->
                <div class="hidden lg:flex flex-col items-center justify-center text-center flex-1">
                    <img src="{{ asset('pahinga.png') }}" alt="Pahinga" class="w-44 h-44 mb-6">
                    <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-200 mb-3">PAHINGA</h1>
                    <p class="text-gray-600 dark:text-gray-400 text-base max-w-sm">Personnel Absence & Holiday Integrated Notification Gateway Application</p>
                </div>

                <!-- Right Side - Login Form -->
                <div class="w-full max-w-md flex-shrink-0">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-horizon-lg p-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
