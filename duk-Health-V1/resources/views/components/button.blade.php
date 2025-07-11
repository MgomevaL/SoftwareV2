<div>
    @props([
        'type' => 'button',
        'href' => null,
        'variant' => 'primary' , 'secondary', 'danger',
        'size' => 'md', // sm, md, lg
        'icon' => null,
        'loading' => false,
    ])

    @php
        $baseClasses =
            'inline-flex items-center justify-center border font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 transition disabled:opacity-50 disabled:cursor-not-allowed';
        $variants = [
            'primary' => 'bg-indigo-600 text-white hover:bg-indigo-700 focus:ring-indigo-500',
            'secondary' => 'bg-gray-100 text-gray-800 hover:bg-gray-200 focus:ring-gray-400',
            'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500',
            'success' => 'bg-green-900 text-white hover:bg-green-700 focus:ring-green-500',
        ];
        $sizes = [
            'sm' => 'px-3 py-1.5 text-sm',
            'md' => 'px-4 py-2 text-sm',
            'lg' => 'px-5 py-3 text-base',
        ];

        $classes =
            $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
    @endphp

    @if ($href)
        <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
            @if ($loading)
                <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 00-8 8z" />
                </svg>
            @elseif ($icon)
                <x-dynamic-component :component="$icon" class="-ml-1 mr-2 h-5 w-5" />
            @endif
            <span>{{ $slot }}</span>
        </a>
    @else
        <button type="{{ $type }}"
            {{ $attributes->merge([
                'class' => $classes,
                'disabled' => $loading ? 'disabled' : null,
            ]) }}>
            @if ($loading)
                <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4" />
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 00-8 8z" />
                </svg>
            @elseif ($icon)
                <x-dynamic-component :component="$icon" class="-ml-1 mr-2 h-5 w-5" />
            @endif
            <span>{{ $slot }}</span>
        </button>
    @endif


</div>
