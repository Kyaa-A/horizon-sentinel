<div
    x-data="{
        darkMode: localStorage.getItem('darkMode') === 'true' || (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches),
        init() {
            this.applyTheme();
            // Watch for system preference changes
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                if (!localStorage.getItem('darkMode')) {
                    this.darkMode = e.matches;
                    this.applyTheme();
                }
            });
        },
        toggle() {
            this.darkMode = !this.darkMode;
            localStorage.setItem('darkMode', this.darkMode);
            this.applyTheme();
        },
        applyTheme() {
            if (this.darkMode) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
    }"
    x-init="init()"
>
    <button
        @click="toggle()"
        class="relative p-2 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-primary-500 rounded-lg transition-colors duration-200"
        :title="darkMode ? 'Switch to light mode' : 'Switch to dark mode'"
    >
        <!-- Sun icon (shown in dark mode) -->
        <svg
            x-show="darkMode"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 rotate-90 scale-0"
            x-transition:enter-end="opacity-100 rotate-0 scale-100"
            class="w-6 h-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>

        <!-- Moon icon (shown in light mode) -->
        <svg
            x-show="!darkMode"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -rotate-90 scale-0"
            x-transition:enter-end="opacity-100 rotate-0 scale-100"
            class="w-6 h-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
        </svg>
    </button>
</div>
