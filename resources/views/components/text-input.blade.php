@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'block w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 dark:text-gray-100 text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 rounded-lg focus:border-primary-500 dark:focus:border-primary-500 focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:ring-opacity-20 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed']) }}>
