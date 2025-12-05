<x-app-layout>
    <div class="py-8">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                    Adjust Leave Balance
                </h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Manually adjust an employee's leave balance</p>
            </div>

            <div class="overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    {{-- Current Balance Info --}}
                    <div class="mb-6 rounded-lg bg-gray-50 dark:bg-gray-700/50 p-4 border border-gray-200 dark:border-gray-600">
                        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-gray-100">Current Balance</h3>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Employee</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-gray-100">{{ $balance->user->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Leave Type</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-gray-100">{{ $balance->leave_type->label() }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Total Allocated</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-gray-100">{{ number_format($balance->total_allocated, 1) }} days</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Available Days</p>
                                <p class="text-base font-semibold text-green-600 dark:text-green-400">{{ number_format($balance->available, 1) }} days</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Used Days</p>
                                <p class="text-base font-semibold text-blue-600 dark:text-blue-400">{{ number_format($balance->used, 1) }} days</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Pending Days</p>
                                <p class="text-base font-semibold text-yellow-600 dark:text-yellow-400">{{ number_format($balance->pending, 1) }} days</p>
                            </div>
                        </div>
                    </div>

                    {{-- Adjustment Form --}}
                    <form method="POST" action="{{ route('hr-admin.balances.update', $balance) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-5">
                            <label for="available" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                New Available Days <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="available" id="available"
                                   value="{{ old('available', $balance->available) }}"
                                   step="0.5" min="0" required
                                   class="w-full px-4 py-2.5 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 text-gray-900 focus:border-primary-500 dark:focus:border-primary-500 focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:ring-opacity-20 transition-all duration-200 @error('available') border-red-500 @enderror">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Current: {{ number_format($balance->available, 1) }} days.
                                This will adjust only the available balance.
                            </p>
                            @error('available')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="reason" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                Reason for Adjustment <span class="text-red-500">*</span>
                            </label>
                            <textarea name="reason" id="reason" rows="3" required
                                      class="w-full px-4 py-2.5 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 text-gray-900 focus:border-primary-500 dark:focus:border-primary-500 focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:ring-opacity-20 transition-all duration-200 @error('reason') border-red-500 @enderror">{{ old('reason') }}</textarea>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Provide a clear explanation for this manual adjustment (will be recorded in balance history)
                            </p>
                            @error('reason')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Warning Notice --}}
                        <div class="mb-6 rounded-lg border border-yellow-200 dark:border-yellow-800 bg-yellow-50 dark:bg-yellow-900/30 p-4">
                            <div class="flex">
                                <div class="shrink-0">
                                    <svg class="h-5 w-5 text-yellow-500 dark:text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-semibold text-yellow-800 dark:text-yellow-200">Important Notice</h3>
                                    <div class="mt-1 text-sm text-yellow-700 dark:text-yellow-300">
                                        <p>Manual balance adjustments will be recorded in the employee's balance history. Make sure to provide a clear reason for auditing purposes.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('hr-admin.balances') }}" class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg font-semibold text-sm text-gray-700 dark:text-gray-300 uppercase tracking-wide shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 active:scale-[0.98] transition-all duration-200">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-horizon border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wide hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 active:scale-[0.98] transition-all duration-200 shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Update Balance
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
