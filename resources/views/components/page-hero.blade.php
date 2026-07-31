@props(['title', 'subtitle' => null, 'image' => null, 'eyebrow' => null])

<section class="relative flex min-h-[46vh] items-end overflow-hidden bg-brand-maroon-dark pb-14 pt-40">
    @if($image)
        <img src="{{ media_url($image) }}" alt="" class="absolute inset-0 h-full w-full object-cover opacity-45">
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-brand-maroon-dark via-brand-maroon-dark/70 to-brand-maroon-dark/30"></div>
    {{-- Warm glow from the crest, so inner-page heroes are not flat maroon. --}}
    <div class="absolute -left-24 -top-24 h-80 w-80 rounded-full bg-brand-gold/20 blur-3xl"></div>
    <div class="absolute inset-0 bg-grid opacity-10"></div>
    {{-- Gold edge hands off to the cream page below. --}}
    <div class="absolute inset-x-0 bottom-0 h-1 bg-gold-gradient"></div>

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
            <a href="{{ route('home') }}" class="inline-flex min-h-[24px] items-center hover:text-brand-gold-light">{{ __('messages.nav.home') }}</a>
            <span>/</span>
            <span class="text-white/90">{{ $title }}</span>
        </nav>
    </div>
</section>
