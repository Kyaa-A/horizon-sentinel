<x-app-layout>
    <div class="py-8">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                    Add Company Holiday
                </h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Create a new holiday for the company calendar</p>
            </div>

            <div class="overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <form method="POST" action="{{ route('hr-admin.holidays.store') }}">
                        @csrf

                        {{-- Holiday Name --}}
                        <div class="mb-5">
                            <label for="name" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                Holiday Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                   placeholder="e.g., Christmas Day, New Year's Day"
                                   class="w-full px-4 py-2.5 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 text-gray-900 focus:border-primary-500 dark:focus:border-primary-500 focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:ring-opacity-20 transition-all duration-200 @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Date --}}
                        <div class="mb-5">
                            <label for="date" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                Date <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="date" id="date" value="{{ old('date') }}" required
                                   class="w-full px-4 py-2.5 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 text-gray-900 focus:border-primary-500 dark:focus:border-primary-500 focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:ring-opacity-20 transition-all duration-200 @error('date') border-red-500 @enderror">
                            @error('date')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Region --}}
                        <div class="mb-5">
                            <label for="region" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                Region <span class="text-gray-400 font-normal">(Optional)</span>
                            </label>
                            <input type="text" name="region" id="region" value="{{ old('region') }}"
                                   placeholder="e.g., Engineering, Marketing (leave blank for all)"
                                   class="w-full px-4 py-2.5 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 text-gray-900 focus:border-primary-500 dark:focus:border-primary-500 focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:ring-opacity-20 transition-all duration-200">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave blank to apply this holiday to all departments</p>
                        </div>

                        {{-- Recurring --}}
                        <div class="mb-6">
                            <div class="flex items-center">
                                <input type="checkbox" name="is_recurring" id="is_recurring" value="1" {{ old('is_recurring') ? 'checked' : '' }}
                                       class="h-4 w-4 rounded border-gray-300 dark:border-gray-600 text-primary-600 focus:ring-primary-500 dark:bg-gray-900">
                                <label for="is_recurring" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                    This is a recurring holiday (appears every year)
                                </label>
                            </div>
                            <p class="ml-6 mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Check this for holidays like Christmas, New Year's Day, Independence Day, etc.
                            </p>
                        </div>

                        {{-- Example Box --}}
                        <div class="mb-6 rounded-lg border border-blue-200 dark:border-blue-800 bg-blue-50 dark:bg-blue-900/30 p-4">
                            <h4 class="mb-2 text-sm font-medium text-blue-900 dark:text-blue-200">Examples:</h4>
                            <ul class="list-inside list-disc space-y-1 text-sm text-blue-800 dark:text-blue-300">
                                <li><strong>Recurring:</strong> Christmas Day (December 25), New Year's Day (January 1)</li>
                                <li><strong>Non-recurring:</strong> Company Anniversary (one-time celebration), Special Closure Day</li>
                            </ul>
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('hr-admin.holidays') }}" class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg font-semibold text-sm text-gray-700 dark:text-gray-300 uppercase tracking-wide shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 active:scale-[0.98] transition-all duration-200">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-horizon border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wide hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 active:scale-[0.98] transition-all duration-200 shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Create Holiday
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
