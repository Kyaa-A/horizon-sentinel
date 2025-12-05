<x-app-layout>
    <div class="py-8">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                    Edit User
                </h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Update information for {{ $user->name }}</p>
            </div>

            <div class="overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <form method="POST" action="{{ route('hr-admin.users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        <div class="mb-5">
                            <label for="name" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                   class="w-full px-4 py-2.5 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 text-gray-900 focus:border-primary-500 dark:focus:border-primary-500 focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:ring-opacity-20 transition-all duration-200 @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-5">
                            <label for="email" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                                   class="w-full px-4 py-2.5 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 text-gray-900 focus:border-primary-500 dark:focus:border-primary-500 focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:ring-opacity-20 transition-all duration-200 @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-5">
                            <label for="password" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Password</label>
                            <input type="password" name="password" id="password"
                                   class="w-full px-4 py-2.5 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 text-gray-900 focus:border-primary-500 dark:focus:border-primary-500 focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:ring-opacity-20 transition-all duration-200 @error('password') border-red-500 @enderror">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave blank to keep current password</p>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-5">
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="w-full px-4 py-2.5 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 text-gray-900 focus:border-primary-500 dark:focus:border-primary-500 focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:ring-opacity-20 transition-all duration-200">
                        </div>

                        {{-- Role --}}
                        <div class="mb-5">
                            <label for="role" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Role <span class="text-red-500">*</span></label>
                            <select name="role" id="role" required
                                    class="w-full px-4 py-2.5 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 text-gray-900 focus:border-primary-500 dark:focus:border-primary-500 focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:ring-opacity-20 transition-all duration-200 @error('role') border-red-500 @enderror">
                                <option value="">Select a role...</option>
                                <option value="employee" {{ old('role', $user->role->value ?? $user->role) === 'employee' ? 'selected' : '' }}>Employee</option>
                                <option value="manager" {{ old('role', $user->role->value ?? $user->role) === 'manager' ? 'selected' : '' }}>Manager</option>
                                <option value="hr_admin" {{ old('role', $user->role->value ?? $user->role) === 'hr_admin' ? 'selected' : '' }}>HR Admin</option>
                            </select>
                            @error('role')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Department --}}
                        <div class="mb-5">
                            <label for="department" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Department</label>
                            <input type="text" name="department" id="department" value="{{ old('department', $user->department) }}" list="departments"
                                   class="w-full px-4 py-2.5 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 text-gray-900 focus:border-primary-500 dark:focus:border-primary-500 focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:ring-opacity-20 transition-all duration-200 @error('department') border-red-500 @enderror">
                            <datalist id="departments">
                                @foreach($departments as $dept)
                                    <option value="{{ $dept }}">
                                @endforeach
                            </datalist>
                            @error('department')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Manager --}}
                        <div class="mb-6">
                            <label for="manager_id" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Manager</label>
                            <select name="manager_id" id="manager_id"
                                    class="w-full px-4 py-2.5 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 text-gray-900 focus:border-primary-500 dark:focus:border-primary-500 focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:ring-opacity-20 transition-all duration-200 @error('manager_id') border-red-500 @enderror">
                                <option value="">No manager</option>
                                @foreach($managers as $manager)
                                    <option value="{{ $manager->id }}" {{ old('manager_id', $user->manager_id) == $manager->id ? 'selected' : '' }}>
                                        {{ $manager->name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Required for employees</p>
                            @error('manager_id')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('hr-admin.users') }}" class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg font-semibold text-sm text-gray-700 dark:text-gray-300 uppercase tracking-wide shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 active:scale-[0.98] transition-all duration-200">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-horizon border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wide hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 active:scale-[0.98] transition-all duration-200 shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Update User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
