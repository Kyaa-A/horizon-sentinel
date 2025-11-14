<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Horizon Sentinel - Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-horizon-soft dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 relative overflow-hidden">
            <!-- Animated gradient background -->
            <div class="absolute inset-0 bg-gradient-navy opacity-5 dark:opacity-10"></div>
            
            <!-- Background decorative elements -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute -top-40 -right-40 w-96 h-96 bg-primary-800 dark:bg-primary-900 rounded-full mix-blend-multiply dark:mix-blend-soft-light filter blur-3xl opacity-20 dark:opacity-15 animate-pulse-slow"></div>
                <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-secondary-500 dark:bg-secondary-800 rounded-full mix-blend-multiply dark:mix-blend-soft-light filter blur-3xl opacity-20 dark:opacity-15 animate-pulse-slow" style="animation-delay: 1s;"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-primary-900 dark:bg-primary-950 rounded-full mix-blend-multiply dark:mix-blend-soft-light filter blur-3xl opacity-15 dark:opacity-10 animate-pulse-slow" style="animation-delay: 2s;"></div>
            </div>

            <!-- Branding -->
            <div class="relative z-10 mb-10 animate-fade-in">
                <a href="/" class="flex flex-col items-center group">
                    <h1 class="text-5xl font-bold text-gray-900 dark:text-white group-hover:scale-105 transition-transform duration-300 drop-shadow-lg">
                        Horizon Sentinel
                    </h1>
                </a>
            </div>

            <!-- Main content card -->
            <div class="relative z-10 w-full sm:max-w-md mt-6 px-8 py-10 bg-white dark:bg-gray-800 backdrop-blur-xl shadow-horizon-lg overflow-hidden sm:rounded-3xl border border-gray-200 dark:border-gray-700 animate-slide-up">
                <!-- Decorative corner elements -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary-800/10 dark:bg-primary-900/20 rounded-full -mr-16 -mt-16 blur-2xl"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-secondary-500/10 dark:bg-secondary-900/20 rounded-full -ml-16 -mb-16 blur-2xl"></div>
                
                <div class="relative z-10">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
