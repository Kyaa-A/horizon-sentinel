<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Date Selector -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4 flex items-center">
                        <svg class="h-5 w-5 mr-2 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Select Date
                    </h3>
                    <form method="GET" action="{{ route('manager.team-status') }}" class="flex flex-wrap items-end gap-4">
                        <div class="flex-1 min-w-[250px]">
                            <label for="date" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                View Status For
                            </label>
                            <input type="date"
                                   name="date"
                                   id="date"
                                   value="{{ $selectedDate->format('Y-m-d') }}"
                                   class="w-full px-4 py-2.5 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 text-gray-900 focus:border-primary-500 dark:focus:border-primary-500 focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:ring-opacity-20 transition-all duration-200">
                        </div>
                        <div class="flex gap-3">
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-horizon border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wide hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 active:scale-[0.98] transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Update
                            </button>
                            <a href="{{ route('manager.team-status') }}" class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg font-semibold text-sm text-gray-700 dark:text-gray-300 uppercase tracking-wide shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 active:scale-[0.98] transition-all duration-200">
                                Today
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Summary Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Team -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl transition-all duration-300 hover:shadow-sm-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-horizon rounded-xl p-4">
                                <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="ml-5">
                                <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">Total Team</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $totalTeam }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Available -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl transition-all duration-300 hover:shadow-sm-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-xl p-4">
                                <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-5">
                                <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">Available</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $availableCount }}</p>
                                <p class="text-sm text-green-600 dark:text-green-400 font-semibold">{{ $availabilityPercentage }}%</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- On Leave -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl transition-all duration-300 hover:shadow-sm-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-orange-500 rounded-xl p-4">
                                <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-5">
                                <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">On Leave</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $onLeaveCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Members List -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">
                        Team Members - {{ $selectedDate->format('l, F j, Y') }}
                    </h3>

                    @if(count($teamStatus) > 0)
                        <div class="space-y-3">
                            @foreach($teamStatus as $item)
                                <div class="border-l-4 @if($item['status'] === 'on_leave') border-orange-500 bg-orange-50 dark:bg-orange-900/20 @else border-green-500 bg-green-50 dark:bg-green-900/20 @endif p-5 rounded-r-xl transition-all duration-200 hover:shadow-md">
                                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                        <!-- Employee Info -->
                                        <div class="flex-1">
                                            <div class="flex items-center gap-4">
                                                <div class="flex-shrink-0">
                                                    <div class="h-12 w-12 rounded-full @if($item['status'] === 'on_leave') bg-orange-500 @else bg-green-500 @endif flex items-center justify-center shadow-md">
                                                        <span class="text-white font-bold text-base">
                                                            {{ strtoupper(substr($item['member']->name, 0, 2)) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="font-bold text-gray-900 dark:text-gray-100">
                                                        {{ $item['member']->name }}
                                                    </p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                                        {{ $item['member']->email }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Status -->
                                        <div class="flex flex-col md:items-end gap-2">
                                            <span class="inline-flex px-4 py-2 text-sm font-bold rounded-full w-fit
                                                @if($item['status'] === 'on_leave')
                                                    text-orange-800 bg-orange-200 dark:bg-orange-800 dark:text-orange-200
                                                @else
                                                    text-green-800 bg-green-200 dark:bg-green-800 dark:text-green-200
                                                @endif">
                                                @if($item['status'] === 'on_leave')
                                                    On Leave
                                                @else
                                                    Available
                                                @endif
                                            </span>

                                            @if($item['current_leave'])
                                                <div class="text-sm text-gray-700 dark:text-gray-300">
                                                    <p class="font-semibold">{{ ucfirst(str_replace('_', ' ', $item['current_leave']->leave_type)) }}</p>
                                                    <p class="text-gray-600 dark:text-gray-400">{{ $item['current_leave']->start_date->format('M d') }} - {{ $item['current_leave']->end_date->format('M d, Y') }}</p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-500">({{ $item['current_leave']->start_date->diffInDays($item['current_leave']->end_date) + 1 }} days)</p>
                                                </div>
                                            @endif

                                            @if($item['upcoming_leave'] && !$item['current_leave'])
                                                <div class="text-xs text-primary-700 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20 px-3 py-1 rounded-md">
                                                    <p class="font-semibold">Upcoming: {{ $item['upcoming_leave']->start_date->format('M d') }}</p>
                                                    <p>{{ ucfirst(str_replace('_', ' ', $item['upcoming_leave']->leave_type)) }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16 text-gray-500 dark:text-gray-400">
                            <div class="mx-auto h-16 w-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mb-4">
                                <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <p class="text-base font-semibold">No team members found</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Navigation -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4 flex items-center">
                        <svg class="h-5 w-5 mr-2 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Quick Actions
                    </h3>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('manager.team-calendar') }}" class="inline-flex items-center px-6 py-3 bg-gradient-horizon border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wide hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 active:scale-[0.98] transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            View Team Calendar
                        </a>
                        <a href="{{ route('manager.pending-requests') }}" class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg font-semibold text-sm text-gray-700 dark:text-gray-300 uppercase tracking-wide shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 active:scale-[0.98] transition-all duration-200">
                            View Pending Requests
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
