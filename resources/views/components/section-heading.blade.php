@props(['eyebrow' => null, 'title' => null, 'text' => null, 'center' => false, 'light' => false])

<div data-reveal class="{{ $center ? 'mx-auto max-w-2xl text-center' : 'max-w-2xl' }}">
    @if($eyebrow)
        <span class="eyebrow {{ $center ? 'justify-center' : '' }} {{ $light ? '!text-brand-gold-light' : '' }}">{{ $eyebrow }}</span>
    @endif
    @if($title)
        <h2 class="section-title mt-4 {{ $light ? '!text-white' : '' }}">{{ $title }}</h2>
    @endif
    @if($text)
        <p class="mt-4 text-lg leading-relaxed {{ $light ? 'text-white/70' : 'text-brand-ink/65' }}">{{ $text }}</p>
    @endif
    {{ $slot }}
</div>
