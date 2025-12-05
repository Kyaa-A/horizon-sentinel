<x-app-layout>
    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-6 flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    Notifications
                </h2>
                @if($unreadCount > 0)
                    <form method="POST" action="{{ route('notifications.mark-all-read') }}">
                        @csrf
                        <button type="submit" class="rounded-md bg-primary-600 dark:bg-primary-500 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700 dark:hover:bg-primary-600 shadow-sm transition-colors">
                            Mark All as Read
                        </button>
                    </form>
                @endif
            </div>

            @if($notifications->count() > 0)
                <div class="overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($notifications as $notification)
                            @php
                                $data = $notification->data;
                                $isUnread = is_null($notification->read_at);
                                $type = class_basename($notification->type);
                            @endphp

                            <div class="flex items-start gap-4 p-6 hover:bg-gray-50 dark:hover:bg-gray-700/50 {{ $isUnread ? 'bg-blue-50 dark:bg-blue-900/20' : '' }}">
                                {{-- Icon --}}
                                <div class="shrink-0">
                                    @if($type === 'LeaveRequestSubmitted')
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-yellow-100 dark:bg-yellow-900/30">
                                            <svg class="h-6 w-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    @elseif($type === 'LeaveRequestApproved')
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/30">
                                            <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    @elseif($type === 'LeaveRequestDenied')
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/30">
                                            <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    @elseif($type === 'LeaveRequestCancelled')
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700">
                                            <svg class="h-6 w-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </div>
                                    @else
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/30">
                                            <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                {{-- Content --}}
                                <div class="flex-1">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-gray-100">
                                                {{ $data['message'] ?? 'Notification' }}
                                            </p>
                                            <div class="mt-1 space-y-1 text-sm text-gray-600 dark:text-gray-400">
                                                @if(isset($data['employee_name']))
                                                    <p><span class="font-medium">Employee:</span> {{ $data['employee_name'] }}</p>
                                                @endif
                                                @if(isset($data['manager_name']))
                                                    <p><span class="font-medium">Manager:</span> {{ $data['manager_name'] }}</p>
                                                @endif
                                                @if(isset($data['leave_type']))
                                                    <p><span class="font-medium">Type:</span> {{ \App\Enums\LeaveType::tryFrom($data['leave_type'])?->label() ?? ucwords(str_replace('_', ' ', $data['leave_type'])) }}</p>
                                                @endif
                                                @if(isset($data['start_date']) && isset($data['end_date']))
                                                    <p><span class="font-medium">Dates:</span> {{ \Carbon\Carbon::parse($data['start_date'])->format('M d, Y') }} - {{ \Carbon\Carbon::parse($data['end_date'])->format('M d, Y') }}</p>
                                                @endif
                                                @if(isset($data['total_days']))
                                                    <p><span class="font-medium">Duration:</span> {{ $data['total_days'] }} day(s)</p>
                                                @endif
                                                @if(isset($data['manager_notes']))
                                                    <p class="mt-2"><span class="font-medium">Notes:</span> {{ $data['manager_notes'] }}</p>
                                                @endif
                                            </div>
                                            <p class="mt-2 text-xs text-gray-500 dark:text-gray-500">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>
                                        </div>

                                        {{-- Unread Indicator --}}
                                        @if($isUnread)
                                            <span class="ml-2 h-2 w-2 shrink-0 rounded-full bg-blue-600 dark:bg-blue-400"></span>
                                        @endif
                                    </div>

                                    {{-- Actions --}}
                                    <div class="mt-4 flex items-center gap-3">
                                        @if(isset($data['action_url']))
                                            <form method="POST" action="{{ route('notifications.mark-as-read', $notification->id) }}">
                                                @csrf
                                                <button type="submit" class="text-sm font-medium text-primary-600 dark:text-primary-400 hover:text-primary-900 dark:hover:text-primary-300">
                                                    View Details
                                                </button>
                                            </form>
                                        @endif

                                        @if($isUnread)
                                            <form method="POST" action="{{ route('notifications.mark-as-read', $notification->id) }}">
                                                @csrf
                                                <button type="submit" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200">
                                                    Mark as Read
                                                </button>
                                            </form>
                                        @endif

                                        <form method="POST" action="{{ route('notifications.destroy', $notification->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    @if($notifications->hasPages())
                        <div class="border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-4 py-3">
                            {{ $notifications->links() }}
                        </div>
                    @endif
                </div>

                {{-- Clear Read Button --}}
                @if($notifications->where('read_at', '!=', null)->count() > 0)
                    <div class="mt-4 text-center">
                        <form method="POST" action="{{ route('notifications.clear-read') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200">
                                Clear All Read Notifications
                            </button>
                        </form>
                    </div>
                @endif
            @else
                {{-- Empty State --}}
                <div class="overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No notifications</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">You're all caught up!</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
