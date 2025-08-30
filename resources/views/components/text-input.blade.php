@props([
    'disabled' => false,
    'color' => 'blue', // デフォルトは青
])

@php
    $colorClasses = match ($color) {
        'orange' => 'border-gray-300 text-gray-800 focus:border-orange-500 focus:ring-orange-500',
        'blue' => 'border-gray-300 text-gray-800 focus:border-blue-700 focus:ring-blue-700',
        default => 'border-gray-300 text-gray-800 focus:border-gray-500 focus:ring-gray-500',
    };
@endphp

<input @disabled($disabled) {{ $attributes->merge(['class' => "$colorClasses rounded-md shadow-sm"]) }}>
