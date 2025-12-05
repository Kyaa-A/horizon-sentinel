<x-app-layout>
    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-6 flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    Company Holidays
                </h2>
                <a href="{{ route('hr-admin.holidays.create') }}" class="rounded-md bg-green-600 dark:bg-green-500 px-4 py-2 text-sm font-medium text-white hover:bg-green-700 dark:hover:bg-green-600 shadow-sm transition-colors">
                    Add Holiday
                </a>
            </div>

            {{-- Year Filter --}}
            <div class="mb-6 overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <form method="GET" action="{{ route('hr-admin.holidays') }}" class="flex items-end gap-4">
                        <div>
                            <label for="year" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Year</label>
                            <select name="year" id="year" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                                @for($y = now()->year - 1; $y <= now()->year + 2; $y++)
                                    <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <button type="submit" class="rounded-md bg-primary-600 dark:bg-primary-500 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700 dark:hover:bg-primary-600 transition-colors">
                            Filter
                        </button>
                    </form>
                </div>
            </div>

            {{-- Holidays List --}}
            <div class="overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                @if($holidays->count() > 0)
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($holidays as $holiday)
                            <div class="flex items-center justify-between p-6 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <div class="flex items-center gap-4">
                                    {{-- Date Badge --}}
                                    <div class="flex h-16 w-16 flex-col items-center justify-center rounded-lg bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400">
                                        <span class="text-xs font-medium">{{ $holiday->date->format('M') }}</span>
                                        <span class="text-2xl font-bold">{{ $holiday->date->format('d') }}</span>
                                    </div>

                                    {{-- Holiday Info --}}
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $holiday->name }}</h3>
                                            @if($holiday->is_recurring)
                                                <span class="rounded-full bg-blue-100 dark:bg-blue-900/30 px-2 py-1 text-xs font-medium text-blue-800 dark:text-blue-300">Recurring</span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $holiday->date->format('l, F j, Y') }}</p>
                                        @if($holiday->date->isPast())
                                            <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">{{ $holiday->date->diffForHumans() }}</p>
                                        @else
                                            <p class="mt-1 text-xs text-primary-600 dark:text-primary-400">{{ $holiday->date->diffForHumans() }}</p>
                                        @endif
                                    </div>
                                </div>

                                {{-- Actions --}}
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('hr-admin.holidays.edit', $holiday) }}" class="text-primary-600 dark:text-primary-400 hover:text-primary-900 dark:hover:text-primary-300">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('hr-admin.holidays.destroy', $holiday) }}" onsubmit="return confirm('Are you sure you want to delete this holiday?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-6 text-center text-gray-500 dark:text-gray-400">
                        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="mt-2 text-sm">No holidays found for {{ $selectedYear }}.</p>
                        <p class="mt-1 text-sm">
                            <a href="{{ route('hr-admin.holidays.create') }}" class="text-primary-600 dark:text-primary-400 hover:text-primary-900 dark:hover:text-primary-300">
                                Add your first holiday →
                            </a>
                        </p>
                    </div>
                @endif
            </div>

            {{-- Info Box --}}
            <div class="mt-6 rounded-lg bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 p-4">
                <h4 class="mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">About Company Holidays:</h4>
                <ul class="list-inside list-disc space-y-1 text-sm text-gray-700 dark:text-gray-300">
                    <li>Company holidays are non-working days for all employees</li>
                    <li>Recurring holidays will automatically appear each year (e.g., Christmas, New Year's Day)</li>
                    <li>Holidays are excluded from leave request calculations</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
