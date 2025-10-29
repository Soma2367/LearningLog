@props(['type' => 'button', 'variant' => 'primary', 'href' => null]);

@php
 $baseClasses = 'inline-flex items-center px-5 py-3  border border-transparent rounded-lg font-semibold text-base text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150';
@endphp

@php
    $variantClasses = match($variant) {
        'primary' => 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500',
        'secondary' => 'bg-gray-600 hover:bg-gray-700 focus:ring-gray-500',
        'danger' => 'bg-red-600 hover:bg-red-700 focus:ring-red-500',
        default => '',
    };
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => "$baseClasses $variantClasses"]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->class("$baseClasses $variantClasses") }}>
        {{ $slot }}
    </button>
@endif
