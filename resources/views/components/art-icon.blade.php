@props(['name' => 'palette'])
@php
    $icons = [
        'pencil' => '<path stroke-linecap="round" stroke-linejoin="round" d="M16.9 3.9l3.2 3.2L8 19.2l-4 .8.8-4L16.9 3.9z"/>',
        'palette' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 3a9 9 0 000 18c1 0 1.5-.8 1.5-1.6 0-.5-.2-.8-.5-1.1-.3-.3-.5-.7-.5-1.1 0-.9.7-1.6 1.6-1.6H16a5 5 0 005-5c0-3.9-4-7-9-7z"/><circle cx="7.5" cy="11.5" r="1"/><circle cx="10" cy="7.5" r="1"/><circle cx="15" cy="7.5" r="1"/>',
        'cube' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 3l8 4.5v9L12 21l-8-4.5v-9L12 3zm0 0v18m8-13.5L12 12 4 7.5"/>',
        'device' => '<rect x="4" y="3" width="16" height="18" rx="2"/><path stroke-linecap="round" d="M9 7h6M9 11h6M9 15h3"/>',
        'star' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 3.5l2.6 5.3 5.9.9-4.3 4.1 1 5.8L12 17l-5.2 2.7 1-5.8-4.3-4.1 5.9-.9L12 3.5z"/>',
        'brush' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.5 4.5l4 4L11 17c-1.5 1.5-4 2-5.5 1.5.5-1.5 0-2.5-1-3.5L15.5 4.5zM4 20c1.5 0 3-1 3-2.5"/>',
    ];
@endphp
<svg {{ $attributes->merge(['class' => 'h-6 w-6']) }} fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
    {!! $icons[$name] ?? $icons['palette'] !!}
</svg>
