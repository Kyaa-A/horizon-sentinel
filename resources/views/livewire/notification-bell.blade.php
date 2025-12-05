<div class="relative" x-data="{ open: @entangle('showDropdown') }" @click.away="open = false">
    <!-- Bell Button -->
    <button
        @click="open = !open"
        class="relative p-2 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-primary-500 rounded-lg transition-colors duration-200"
    >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>

        <!-- Badge -->
        @if($this->unreadCount > 0)
            <span class="absolute -top-1 -right-1 inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full animate-pulse">
                {{ $this->unreadCount > 9 ? '9+' : $this->unreadCount }}
            </span>
        @endif
    </button>

    <!-- Dropdown -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden z-50"
        style="display: none;"
    >
        <!-- Header -->
        <div class="px-4 py-3 bg-gradient-horizon text-white flex items-center justify-between">
            <h3 class="font-semibold">Notifications</h3>
            @if($this->unreadCount > 0)
                <button
                    wire:click="markAllAsRead"
                    class="text-xs text-white/80 hover:text-white transition-colors"
                >
                    Mark all as read
                </button>
            @endif
        </div>

        <!-- Notifications List -->
        <div class="max-h-96 overflow-y-auto">
            @forelse($this->notifications as $notification)
                <div
                    wire:key="notification-{{ $notification->id }}"
                    class="px-4 py-3 border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors"
                >
                    <div class="flex items-start gap-3">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                {{ $notification->data['title'] ?? 'Notification' }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 line-clamp-2">
                                {{ $notification->data['message'] ?? '' }}
                            </p>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                {{ $notification->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <button
                            wire:click="markAsRead('{{ $notification->id }}')"
                            class="flex-shrink-0 p-1 text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors"
                            title="Mark as read"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            @empty
                <div class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <p class="text-sm">No new notifications</p>
                </div>
            @endforelse
        </div>

        <!-- Footer -->
        @if($this->unreadCount > 0)
            <div class="px-4 py-2 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
                <a
                    href="{{ route('notifications.index') }}"
                    class="block text-center text-sm font-medium text-primary-600 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 transition-colors"
                >
                    View all notifications
                </a>
            </div>
        @endif
    </div>
</div>
