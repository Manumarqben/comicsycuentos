@props(['active'])

@php
    $class = ($active ?? false) 
        ? 'border-b-2 border-indigo-400 dark:border-indigo-600 leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
        : 'border-b-2 border-transparent leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';

@endphp

<button {{ $attributes->merge(['class' => 'flex justify-center items-center min-h-10 shadow-inner dark:shadow-gray-800 cursor-pointer text-center p-2 ' . $class]) }} wire:loading.attr="disabled">
    {{ $slot }}
</button>