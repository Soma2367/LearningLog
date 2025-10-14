@props(['type' => 'button', 'variant' => 'primary'])

@php
$baseClasses = 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150';
@endphp

@php
    $variantClasses = match($variant) {
        'primary' => 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500',
        'secondary' => 'bg-gray-600 hover:bg-gray-700 focus:ring-gray-500',
        'danger' => 'bg-red-600 hover:bg-red-700 focus:ring-red-500',
        default => '',
    };
@endphp
<button type="{{ $type }}" {{ $attributes->class($baseClasses $variantClasses) }}>
    {{ $slot }}
</button>
