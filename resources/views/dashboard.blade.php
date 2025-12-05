<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-5">

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- Total Requests -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Total Requests</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalRequests }}</p>
                            </div>
                            <div class="flex-shrink-0 bg-gradient-horizon rounded-xl p-4">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Pending</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $pendingRequests }}</p>
                            </div>
                            <div class="flex-shrink-0 bg-yellow-500 rounded-xl p-4">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Approved Requests -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Approved</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $approvedRequests }}</p>
                            </div>
                            <div class="flex-shrink-0 bg-green-500 rounded-xl p-4">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Denied Requests -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Denied</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $deniedRequests }}</p>
                            </div>
                            <div class="flex-shrink-0 bg-red-500 rounded-xl p-4">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Quick Actions</h3>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('leave-requests.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-horizon border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wide hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 active:scale-[0.98] transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Submit Leave Request
                        </a>
                        <a href="{{ route('leave-requests.index') }}" class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg font-semibold text-sm text-gray-700 dark:text-gray-300 uppercase tracking-wide shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 active:scale-[0.98] transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            View All Requests
                        </a>
                    </div>
                </div>
            </div>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

                <!-- Upcoming Approved Leaves -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Upcoming Time Off</h3>
                            <div class="h-10 w-10 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                                <svg class="h-5 w-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>

                        @if($upcomingLeaves->count() > 0)
                            <div class="space-y-4">
                                @foreach($upcomingLeaves as $leave)
                                    <div class="border-l-4 border-green-500 bg-gradient-to-r from-green-50 to-transparent dark:from-green-900/20 dark:to-transparent p-4 rounded-lg hover:shadow-sm transition-shadow duration-200">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <p class="font-semibold text-gray-900 dark:text-gray-100">
                                                    {{ $leave->leave_type->label() }}
                                                </p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                                    {{ $leave->start_date->format('M d, Y') }} - {{ $leave->end_date->format('M d, Y') }}
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                                    ({{ $leave->start_date->diffInDays($leave->end_date) + 1 }} days)
                                                </p>
                                            </div>
                                            <span class="px-3 py-1 text-xs font-semibold text-green-800 dark:text-green-200 bg-green-200 dark:bg-green-800 rounded-full">
                                                Approved
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                                <div class="mx-auto h-16 w-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mb-4">
                                    <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="font-medium">No upcoming time off scheduled</p>
                                <p class="text-sm mt-1">Your approved leave requests will appear here</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Recent Requests -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Recent Requests</h3>
                            <div class="h-10 w-10 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                                <svg class="h-5 w-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>

                        @if($recentRequests->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentRequests as $request)
                                    <div class="border-l-4 @if($request->status === \App\Enums\LeaveStatus::Pending) border-yellow-500 bg-gradient-to-r from-yellow-50 to-transparent dark:from-yellow-900/20 dark:to-transparent @elseif($request->status === \App\Enums\LeaveStatus::Approved) border-green-500 bg-gradient-to-r from-green-50 to-transparent dark:from-green-900/20 dark:to-transparent @else border-red-500 bg-gradient-to-r from-red-50 to-transparent dark:from-red-900/20 dark:to-transparent @endif p-4 rounded-lg hover:shadow-sm transition-shadow duration-200">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <p class="font-semibold text-gray-900 dark:text-gray-100">
                                                    {{ $request->leave_type->label() }}
                                                </p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                                    {{ $request->start_date->format('M d') }} - {{ $request->end_date->format('M d, Y') }}
                                                </p>
                                                @if($request->manager)
                                                    <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                                        Manager: {{ $request->manager->name }}
                                                    </p>
                                                @endif
                                            </div>
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                                @if($request->status === \App\Enums\LeaveStatus::Pending) text-yellow-800 dark:text-yellow-200 bg-yellow-200 dark:bg-yellow-800
                                                @elseif($request->status === \App\Enums\LeaveStatus::Approved) text-green-800 dark:text-green-200 bg-green-200 dark:bg-green-800
                                                @else text-red-800 dark:text-red-200 bg-red-200 dark:bg-red-800 @endif">
                                                {{ $request->status->label() }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-6">
                                <a href="{{ route('leave-requests.index') }}" class="inline-flex items-center text-sm font-medium text-primary-800 dark:text-primary-400 hover:text-primary-900 dark:hover:text-primary-300 transition-colors">
                                    View all requests
                                    <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                                <div class="mx-auto h-16 w-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mb-4">
                                    <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <p class="font-medium">No leave requests yet</p>
                                <p class="text-sm mt-1 mb-4">Get started by submitting your first request</p>
                                <a href="{{ route('leave-requests.create') }}" class="inline-flex items-center text-sm font-medium text-primary-800 dark:text-primary-400 hover:text-primary-900 dark:hover:text-primary-300 transition-colors">
                                    Submit your first request
                                    <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
