{{-- Toast Notification Container --}}
<div
    x-data="{
        toasts: [],
        addToast(type, message) {
            const id = Date.now();
            this.toasts.push({ id, type, message, visible: false });
            this.$nextTick(() => {
                const toast = this.toasts.find(t => t.id === id);
                if (toast) toast.visible = true;
            });
            setTimeout(() => this.removeToast(id), 5000);
        },
        removeToast(id) {
            const toast = this.toasts.find(t => t.id === id);
            if (toast) {
                toast.visible = false;
                setTimeout(() => {
                    this.toasts = this.toasts.filter(t => t.id !== id);
                }, 300);
            }
        }
    }"
    x-init="
        @if(session('success'))
            addToast('success', '{{ session('success') }}');
        @endif
        @if(session('error'))
            addToast('error', '{{ session('error') }}');
        @endif
        @if(session('info'))
            addToast('info', '{{ session('info') }}');
        @endif
        @if(session('warning'))
            addToast('warning', '{{ session('warning') }}');
        @endif
        @if($errors->any())
            @foreach($errors->all() as $error)
                addToast('error', '{{ addslashes($error) }}');
            @endforeach
        @endif
    "
    class="fixed top-4 right-4 z-[9999] flex flex-col gap-3 pointer-events-none max-w-md w-full"
    style="max-height: calc(100vh - 2rem);"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div
            x-show="toast.visible"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-x-full"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 translate-x-full"
            class="pointer-events-auto"
        >
            {{-- Success Toast --}}
            <div
                x-show="toast.type === 'success'"
                class="flex items-start gap-3 px-4 py-3 rounded-xl shadow-xl border backdrop-blur-sm
                       bg-emerald-50/95 dark:bg-emerald-900/90 border-emerald-200 dark:border-emerald-700
                       text-emerald-800 dark:text-emerald-100"
            >
                <div class="flex-shrink-0 mt-0.5">
                    <svg class="h-5 w-5 text-emerald-500 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium" x-text="toast.message"></p>
                </div>
                <button
                    @click="removeToast(toast.id)"
                    class="flex-shrink-0 ml-2 text-emerald-500 hover:text-emerald-700 dark:text-emerald-400 dark:hover:text-emerald-200 transition-colors"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Error Toast --}}
            <div
                x-show="toast.type === 'error'"
                class="flex items-start gap-3 px-4 py-3 rounded-xl shadow-xl border backdrop-blur-sm
                       bg-red-50/95 dark:bg-red-900/90 border-red-200 dark:border-red-700
                       text-red-800 dark:text-red-100"
            >
                <div class="flex-shrink-0 mt-0.5">
                    <svg class="h-5 w-5 text-red-500 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium" x-text="toast.message"></p>
                </div>
                <button
                    @click="removeToast(toast.id)"
                    class="flex-shrink-0 ml-2 text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-200 transition-colors"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Info Toast --}}
            <div
                x-show="toast.type === 'info'"
                class="flex items-start gap-3 px-4 py-3 rounded-xl shadow-xl border backdrop-blur-sm
                       bg-blue-50/95 dark:bg-blue-900/90 border-blue-200 dark:border-blue-700
                       text-blue-800 dark:text-blue-100"
            >
                <div class="flex-shrink-0 mt-0.5">
                    <svg class="h-5 w-5 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium" x-text="toast.message"></p>
                </div>
                <button
                    @click="removeToast(toast.id)"
                    class="flex-shrink-0 ml-2 text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-200 transition-colors"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Warning Toast --}}
            <div
                x-show="toast.type === 'warning'"
                class="flex items-start gap-3 px-4 py-3 rounded-xl shadow-xl border backdrop-blur-sm
                       bg-amber-50/95 dark:bg-amber-900/90 border-amber-200 dark:border-amber-700
                       text-amber-800 dark:text-amber-100"
            >
                <div class="flex-shrink-0 mt-0.5">
                    <svg class="h-5 w-5 text-amber-500 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium" x-text="toast.message"></p>
                </div>
                <button
                    @click="removeToast(toast.id)"
                    class="flex-shrink-0 ml-2 text-amber-500 hover:text-amber-700 dark:text-amber-400 dark:hover:text-amber-200 transition-colors"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </template>
</div>
