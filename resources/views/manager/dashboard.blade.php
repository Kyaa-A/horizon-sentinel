<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Pending Requests Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl transition-all duration-300 hover:shadow-md border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-yellow-500 rounded-xl p-4">
                                <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-semibold text-gray-600 dark:text-gray-400 truncate">
                                        Pending Requests
                                    </dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                                            {{ $pendingCount }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('manager.pending-requests') }}" class="text-sm text-primary-800 dark:text-primary-400 hover:text-primary-900 dark:hover:text-primary-300 font-semibold inline-flex items-center">
                                Review now 
                                <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Approved This Month Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl transition-all duration-300 hover:shadow-md border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-xl p-4">
                                <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-semibold text-gray-600 dark:text-gray-400 truncate">
                                        Approved This Month
                                    </dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                                            {{ $approvedThisMonth }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Size Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl transition-all duration-300 hover:shadow-md border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-horizon rounded-xl p-4">
                                <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-semibold text-gray-600 dark:text-gray-400 truncate">
                                        Team Members
                                    </dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                                            {{ $teamSize }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('manager.team-calendar') }}" class="text-sm text-primary-800 dark:text-primary-400 hover:text-primary-900 dark:hover:text-primary-300 font-semibold inline-flex items-center">
                                View calendar 
                                <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Availability & Conflicts Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Team Availability Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4 flex items-center">
                            <svg class="h-5 w-5 mr-2 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Team Availability (Next 30 Days)
                        </h3>
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                @php
                                    $percentage = $currentAvailability['percentage'];
                                    $barColor = $percentage >= 70 ? 'bg-green-500' : ($percentage >= 50 ? 'bg-yellow-500' : 'bg-red-500');
                                    $textColor = $percentage >= 70 ? 'text-green-600 dark:text-green-400' : ($percentage >= 50 ? 'text-yellow-600 dark:text-yellow-400' : 'text-red-600 dark:text-red-400');
                                @endphp
                                <div class="mb-4">
                                    <div class="flex items-baseline">
                                        <span class="text-5xl font-bold {{ $textColor }}">{{ $percentage }}%</span>
                                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400 font-medium">available</span>
                                    </div>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4 mb-6">
                                    <div class="{{ $barColor }} h-4 rounded-full transition-all duration-300" style="width: {{ $percentage }}%"></div>
                                </div>
                                <div class="grid grid-cols-3 gap-4 text-center text-sm">
                                    <div class="p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                        <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $currentAvailability['team_size'] }}</div>
                                        <div class="text-gray-600 dark:text-gray-400 font-medium">Team</div>
                                    </div>
                                    <div class="p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                                        <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $currentAvailability['available'] }}</div>
                                        <div class="text-gray-600 dark:text-gray-400 font-medium">Available</div>
                                    </div>
                                    <div class="p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                                        <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $currentAvailability['on_leave'] }}</div>
                                        <div class="text-gray-600 dark:text-gray-400 font-medium">On Leave</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Conflicts Summary Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4 flex items-center">
                            <svg class="h-5 w-5 mr-2 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            Conflict Summary
                        </h3>
                        @if ($conflictSummary['total_conflicts'] > 0)
                            <div class="space-y-3">
                                <div class="flex items-center justify-between p-4 bg-red-50 dark:bg-red-900/20 rounded-xl border border-red-200 dark:border-red-800">
                                    <div class="flex items-center">
                                        <svg class="h-8 w-8 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        <div class="ml-3">
                                            <p class="text-sm font-semibold text-red-800 dark:text-red-200">Critical Conflicts</p>
                                            <p class="text-xs text-red-600 dark:text-red-400">Requires immediate attention</p>
                                        </div>
                                    </div>
                                    <span class="text-3xl font-bold text-red-600 dark:text-red-400">{{ $conflictSummary['critical_conflicts'] }}</span>
                                </div>

                                <div class="flex items-center justify-between p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-xl border border-yellow-200 dark:border-yellow-800">
                                    <div class="flex items-center">
                                        <svg class="h-8 w-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        <div class="ml-3">
                                            <p class="text-sm font-semibold text-yellow-800 dark:text-yellow-200">High Conflicts</p>
                                            <p class="text-xs text-yellow-600 dark:text-yellow-400">Review carefully</p>
                                        </div>
                                    </div>
                                    <span class="text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ $conflictSummary['high_conflicts'] }}</span>
                                </div>

                                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <a href="{{ route('manager.pending-requests') }}" class="text-sm text-primary-800 dark:text-primary-400 hover:text-primary-900 dark:hover:text-primary-300 font-semibold inline-flex items-center">
                                        Review {{ $conflictSummary['pending_requests'] }} pending request(s)
                                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="mx-auto h-16 w-16 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center mb-4">
                                    <svg class="h-8 w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <p class="text-base font-semibold text-green-600 dark:text-green-400">No conflicts detected</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">All pending requests look good</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Pending Requests -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Recent Pending Requests</h3>
                            @if ($pendingCount > 0)
                                <a href="{{ route('manager.pending-requests') }}" class="text-sm text-primary-800 dark:text-primary-400 hover:text-primary-900 dark:hover:text-primary-300 font-semibold">
                                    View all
                                </a>
                            @endif
                        </div>

                        @if ($recentRequests->isEmpty())
                            <div class="text-center py-12">
                                <div class="mx-auto h-12 w-12 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mb-3">
                                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">No pending requests</p>
                            </div>
                        @else
                            <div class="space-y-3">
                                @foreach ($recentRequests as $request)
                                    <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                        <div class="flex-1">
                                            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                                {{ $request->user->name }}
                                            </p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                                                {{ $request->leave_type->label() }} • {{ $request->start_date->format('M d') }} - {{ $request->end_date->format('M d') }}
                                            </p>
                                        </div>
                                        <a href="{{ route('manager.show-request', $request) }}" class="ml-4 inline-flex items-center px-4 py-2 bg-primary-800 dark:bg-primary-700 text-white rounded-lg text-xs font-semibold hover:bg-primary-900 dark:hover:bg-primary-600 transition-colors">
                                            Review
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Upcoming Team Leaves -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Upcoming Team Leaves</h3>
                            <a href="{{ route('manager.team-calendar') }}" class="text-sm text-primary-800 dark:text-primary-400 hover:text-primary-900 dark:hover:text-primary-300 font-semibold">
                                Calendar
                            </a>
                        </div>

                        @if ($upcomingLeaves->isEmpty())
                            <div class="text-center py-12">
                                <div class="mx-auto h-12 w-12 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mb-3">
                                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">No upcoming leaves</p>
                            </div>
                        @else
                            <div class="space-y-3">
                                @foreach ($upcomingLeaves as $leave)
                                    <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                        <div class="flex-1">
                                            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                                {{ $leave->user->name }}
                                            </p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                                                {{ $leave->start_date->format('M d') }} - {{ $leave->end_date->format('M d, Y') }} ({{ $leave->start_date->diffInDays($leave->end_date) + 1 }} days)
                                            </p>
                                        </div>
                                        <span class="ml-4 px-3 py-1 text-xs font-semibold rounded-full bg-green-200 text-green-800 dark:bg-green-800 dark:text-green-200">
                                            Approved
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
