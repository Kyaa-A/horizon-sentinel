<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <!-- Welcome Header -->
    <div class="mb-8 text-center">
        <!-- Mobile Logo (only shown on small screens) -->
        <div class="lg:hidden mb-4">
            <img src="{{ asset('pahinga.png') }}" alt="Pahinga" class="w-16 h-16 mx-auto">
        </div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Welcome Back</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400">Sign in to the Pahinga Platform.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <div class="mt-2 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <x-text-input
                    id="email"
                    class="block w-full pl-10"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="Enter your email address"
                />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <div class="mt-2 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <x-text-input
                    id="password"
                    class="block w-full pl-10"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="Enter your password"
                />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input
                id="remember_me"
                type="checkbox"
                class="h-4 w-4 rounded border-gray-300 dark:border-gray-600 text-teal-600 focus:ring-teal-500 dark:bg-gray-700 cursor-pointer"
                name="remember"
            >
            <label for="remember_me" class="ml-2 block text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
                {{ __('Keep me signed in for 30 days') }}
            </label>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" style="background-color: #14b8a6;" class="w-full flex justify-center items-center px-6 py-3 text-white font-semibold rounded-full shadow-lg hover:opacity-90 transition-all duration-200">
                <span>Sign in</span>
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </button>
        </div>

        <!-- HR Contact Note -->
        <div class="text-center pt-4">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                For account assistance, please contact your HR Administrator.
            </p>
        </div>
    </form>
</x-guest-layout>
