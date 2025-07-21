@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full px-4 py-3 border-l-4 border-primary-500 text-start text-base font-medium text-primary-700 dark:text-primary-300 bg-primary-50 dark:bg-primary-900/30 focus:outline-none focus:text-primary-800 dark:focus:text-primary-200 focus:bg-primary-100 dark:focus:bg-primary-900/50 focus:border-primary-700 dark:focus:border-primary-400 transition-all duration-200 ease-in-out'
            : 'block w-full px-4 py-3 border-l-4 border-transparent text-start text-base font-medium text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-100 hover:bg-neutral-50 dark:hover:bg-neutral-700 hover:border-neutral-300 dark:hover:border-neutral-600 focus:outline-none focus:text-neutral-900 dark:focus:text-neutral-100 focus:bg-neutral-50 dark:focus:bg-neutral-700 focus:border-neutral-300 dark:focus:border-neutral-600 transition-all duration-200 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
