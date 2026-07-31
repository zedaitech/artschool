@props(['title', 'subtitle' => null, 'image' => null, 'eyebrow' => null])

<section class="relative flex min-h-[46vh] items-end overflow-hidden bg-brand-maroon-dark pb-14 pt-40">
    @if($image)
        <img src="{{ media_url($image) }}" alt="" class="absolute inset-0 h-full w-full object-cover opacity-45">
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-brand-maroon-dark via-brand-maroon-dark/70 to-brand-maroon-dark/30"></div>
    <div class="absolute inset-0 bg-grid opacity-10"></div>

    <div class="container-x relative">
        @if($eyebrow)
            <span class="eyebrow !text-brand-gold-light">{{ $eyebrow }}</span>
        @endif
        <h1 class="mt-4 max-w-3xl font-display text-4xl leading-tight text-white text-shadow-hero sm:text-5xl lg:text-6xl">{{ $title }}</h1>
        @if($subtitle)
            <p class="mt-5 max-w-2xl text-lg leading-relaxed text-white/80">{{ $subtitle }}</p>
        @endif

        {{-- Breadcrumb --}}
        <nav class="mt-6 flex items-center gap-2 text-sm text-white/60">
            <a href="{{ route('home') }}" class="hover:text-brand-gold-light">{{ __('messages.nav.home') }}</a>
            <span>/</span>
            <span class="text-white/90">{{ $title }}</span>
        </nav>
    </div>
</section>
