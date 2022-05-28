@php
$color = $attributes['color'] ? $attributes['color'] : 'blue';
@endphp
@if (!$attributes['links'])
    <button {{ $attributes->merge([ 'type' => 'submit', 'class' => "inline-block px-6 py-2.5 bg-{$color}-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-{$color}-700 hover:shadow-lg focus:bg-{$color}-700 focus:shadow-lg focus:outline-none focus:ring ring-{$color}-300 active:bg-{$color}-800 active:shadow-lg transition duration-150 ease-in-out"]) }}>
        {{ $slot }}
    </button>
@else
    <a {{ $attributes->merge([ 'href' => '#', 'class' => "inline-block px-6 py-2.5 bg-{$color}-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-{$color}-700 hover:shadow-lg focus:bg-{$color}-700 focus:shadow-lg focus:outline-none focus:ring ring-{$color}-300 active:bg-{$color}-800 active:shadow-lg transition duration-150 ease-in-out"]) }}>
        {{ $slot }}
    </a>
@endif
