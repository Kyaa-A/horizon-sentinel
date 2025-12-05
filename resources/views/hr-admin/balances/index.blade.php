<x-app-layout>
    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                    Leave Balance Management
                </h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">View and manage employee leave balances</p>
            </div>

            {{-- Filters --}}
            <div class="mb-6 overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <form method="GET" action="{{ route('hr-admin.balances') }}" class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div>
                            <label for="user_id" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Employee</label>
                            <select name="user_id" id="user_id" class="w-full px-4 py-2.5 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 text-gray-900 focus:border-primary-500 dark:focus:border-primary-500 focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:ring-opacity-20 transition-all duration-200">
                                <option value="">All Employees</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="leave_type" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Leave Type</label>
                            <select name="leave_type" id="leave_type" class="w-full px-4 py-2.5 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 text-gray-900 focus:border-primary-500 dark:focus:border-primary-500 focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:ring-opacity-20 transition-all duration-200">
                                <option value="">All Types</option>
                                <option value="vacation" {{ request('leave_type') === 'vacation' ? 'selected' : '' }}>Vacation</option>
                                <option value="sick_leave" {{ request('leave_type') === 'sick_leave' ? 'selected' : '' }}>Sick Leave</option>
                                <option value="paid_time_off" {{ request('leave_type') === 'paid_time_off' ? 'selected' : '' }}>Paid Time Off</option>
                                <option value="unpaid_leave" {{ request('leave_type') === 'unpaid_leave' ? 'selected' : '' }}>Unpaid Leave</option>
                            </select>
                        </div>

                        <div class="flex items-end gap-3">
                            <button type="submit" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-horizon border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wide hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 active:scale-[0.98] transition-all duration-200 shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                Filter
                            </button>
                            <a href="{{ route('hr-admin.balances') }}" class="inline-flex items-center px-4 py-3 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg font-semibold text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                                Clear
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Balances Table --}}
            <div class="overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300">
                                    Employee
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300">
                                    Leave Type
                                </th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300">
                                    Total Allocated
                                </th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300">
                                    Available
                                </th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300">
                                    Used
                                </th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300">
                                    Pending
                                </th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                            @forelse($balances as $balance)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $balance->user->name }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $balance->user->email }}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                        {{ $balance->leave_type->label() }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-900 dark:text-gray-100">
                                        {{ number_format($balance->total_allocated, 1) }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right">
                                        <span class="text-sm font-semibold text-green-600 dark:text-green-400">{{ number_format($balance->available, 1) }}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right">
                                        <span class="text-sm font-semibold text-blue-600 dark:text-blue-400">{{ number_format($balance->used, 1) }}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right">
                                        <span class="text-sm font-semibold text-yellow-600 dark:text-yellow-400">{{ number_format($balance->pending, 1) }}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-center text-sm font-medium">
                                        <a href="{{ route('hr-admin.balances.edit', $balance) }}" class="text-primary-600 dark:text-primary-400 hover:text-primary-900 dark:hover:text-primary-300 font-semibold">
                                            Adjust
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                        No balances found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($balances->hasPages())
                    <div class="border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-4 py-3">
                        {{ $balances->links() }}
                    </div>
                @endif
            </div>

            {{-- Balance Legend --}}
            <div class="mt-4 rounded-xl bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 p-4">
                <h4 class="mb-2 text-sm font-semibold text-blue-900 dark:text-blue-200">Balance Breakdown:</h4>
                <div class="grid grid-cols-1 gap-2 text-sm text-blue-800 dark:text-blue-300 md:grid-cols-3">
                    <div><span class="font-semibold text-green-600 dark:text-green-400">Available:</span> Days the employee can request</div>
                    <div><span class="font-semibold text-blue-600 dark:text-blue-400">Used:</span> Days from approved leave requests</div>
                    <div><span class="font-semibold text-yellow-600 dark:text-yellow-400">Pending:</span> Days reserved for pending requests</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
