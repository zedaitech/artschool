@php
    $nav = [
        ['route' => 'home', 'label' => __('messages.nav.home')],
        ['route' => 'centers.index', 'label' => __('messages.nav.centers')],
        ['route' => 'gallery', 'label' => __('messages.nav.gallery')],
        ['route' => 'events.index', 'label' => __('messages.nav.events')],
        ['route' => 'contact', 'label' => __('messages.nav.contact')],
    ];
@endphp

{{--
    The header floats over the dark hero, so its default state is light-on-dark.
    Scrolling past 24px adds `is-scrolled`, which brings in the cream background
    and flips every child back to the dark palette via group-[.is-scrolled]:.
    Keeping the light colours as the static default means the text stays legible
    even in the moment before Alpine hydrates.
--}}
<header x-data="{ scrolled: false, open: false }"
        x-init="scrolled = window.scrollY > 24; window.addEventListener('scroll', () => scrolled = window.scrollY > 24)"
        :class="scrolled ? 'is-scrolled bg-brand-cream/95 shadow-[0_4px_30px_-12px_rgba(43,35,32,0.25)] backdrop-blur' : 'bg-transparent'"
        class="group fixed inset-x-0 top-0 z-50 transition-all duration-300">
    {{-- Top strip --}}
    <div class="hidden border-b border-brand-maroon/10 bg-brand-maroon text-white/90 lg:block">
        <div class="container-x flex h-9 items-center justify-between gap-4 overflow-hidden whitespace-nowrap text-xs">
            <div class="flex min-w-0 items-center gap-5">
                @if($settings['contact_phone'] ?? null)
                    <a href="tel:{{ preg_replace('/\s+/', '', $settings['contact_phone']) }}" class="flex items-center gap-1.5 hover:text-brand-gold-light">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h2.6a1 1 0 01.98.8l.8 3.2a1 1 0 01-.5 1.1L8 9a12 12 0 007 7l.9-1.5a1 1 0 011.1-.5l3.2.8a1 1 0 01.8 1V19a2 2 0 01-2 2A16 16 0 013 5z"/></svg>
                        {{ $settings['contact_phone'] }}
                    </a>
                @endif
                @if($settings['contact_email'] ?? null)
                    <a href="mailto:{{ $settings['contact_email'] }}" class="flex items-center gap-1.5 hover:text-brand-gold-light">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l9 6 9-6M5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"/></svg>
                        {{ $settings['contact_email'] }}
                    </a>
                @endif
                @if($headerWhatsapp = whatsapp_url(__('messages.whatsapp.floating_intro')))
                    <a href="{{ $headerWhatsapp }}" target="_blank" rel="noopener" class="flex items-center gap-1.5 hover:text-brand-gold-light">
                        <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3.5A8.5 8.5 0 004.6 16.2L3.5 20.5l4.4-1.1A8.5 8.5 0 1012 3.5zm0 15.3a6.8 6.8 0 01-3.5-.95l-.25-.15-2.6.68.7-2.53-.16-.26A6.8 6.8 0 1112 18.8zm3.7-5.1c-.2-.1-1.2-.6-1.4-.65s-.32-.1-.46.1-.53.65-.64.78-.23.15-.43.05a5.6 5.6 0 01-1.64-1 6.2 6.2 0 01-1.14-1.42c-.12-.2 0-.32.09-.42s.2-.23.3-.35a1.4 1.4 0 00.2-.33.37.37 0 000-.35c0-.1-.46-1.1-.63-1.5s-.33-.34-.46-.34h-.4a.76.76 0 00-.55.26 2.3 2.3 0 00-.72 1.7 4 4 0 00.84 2.12 9.1 9.1 0 003.5 3.1c.49.2.87.33 1.17.43a2.8 2.8 0 001.3.08 2.1 2.1 0 001.4-1 1.7 1.7 0 00.12-1c-.05-.08-.18-.13-.38-.23z"/></svg>
                        {{ __('messages.contact.whatsapp_label') }}
                    </a>
                @endif
            </div>
            <div class="flex shrink-0 items-center gap-4">
                <span class="tracking-widest text-white/60">{{ __('messages.established') }}</span>
                @include('partials.social-icons', ['class' => 'text-white/80'])
            </div>
        </div>
    </div>

    {{-- flex-nowrap + min-w-0 keep the bar on one line: the brand text truncates
         rather than wrapping the whole row onto a second line. --}}
    <nav class="container-x flex flex-nowrap items-center justify-between gap-4 py-3">
        {{-- Brand --}}
        <a href="{{ route('home') }}" class="flex min-w-0 items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" alt="{{ __('messages.school_name') }}"
                 class="h-14 w-14 shrink-0 rounded-full object-contain drop-shadow-sm sm:h-16 sm:w-16">
            <span class="hidden min-w-0 leading-tight sm:block">
                <span class="block truncate font-display text-base text-white text-shadow-hero transition-colors group-[.is-scrolled]:text-brand-maroon group-[.is-scrolled]:[text-shadow:none] lg:text-lg">{{ __('messages.school_name') }}</span>
                <span class="hidden truncate text-[11px] font-medium uppercase tracking-[0.14em] text-brand-gold-light transition-colors group-[.is-scrolled]:text-brand-gold xl:block">{{ __('messages.tagline') }}</span>
            </span>
        </a>

        {{-- Desktop nav --}}
        <div class="hidden shrink-0 items-center gap-1 xl:flex">
            @foreach($nav as $item)
                @php $active = request()->routeIs($item['route']) || request()->routeIs(\Illuminate\Support\Str::before($item['route'], '.').'.*'); @endphp
                <a href="{{ route($item['route']) }}"
                   class="relative rounded-full px-4 py-2 text-sm font-semibold transition {{ $active
                       ? 'text-white text-shadow-hero group-[.is-scrolled]:text-brand-maroon group-[.is-scrolled]:[text-shadow:none]'
                       : 'text-white/85 text-shadow-hero hover:text-white group-[.is-scrolled]:text-brand-ink/70 group-[.is-scrolled]:[text-shadow:none] group-[.is-scrolled]:hover:text-brand-maroon' }}">
                    {{ $item['label'] }}
                    @if($active)<span class="absolute inset-x-4 -bottom-0.5 h-0.5 rounded-full bg-gold-gradient"></span>@endif
                </a>
            @endforeach
        </div>

        <div class="flex shrink-0 items-center gap-2">
            @include('partials.language-switcher')
            <a href="{{ route('contact') }}" class="hidden btn-primary whitespace-nowrap !px-5 !py-2.5 text-xs ring-1 ring-white/30 group-[.is-scrolled]:ring-0 sm:inline-flex">
                {{ __('messages.enquire_now') }}
            </a>

            {{-- Mobile toggle --}}
            <button @click="open = !open" class="grid h-11 w-11 place-items-center rounded-full text-white transition-colors group-[.is-scrolled]:text-brand-maroon xl:hidden" aria-label="Menu">
                <svg x-show="!open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/></svg>
                <svg x-show="open" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M6 6l12 12M18 6L6 18"/></svg>
            </button>
        </div>
    </nav>

    {{-- Mobile menu --}}
    <div x-show="open" x-cloak x-transition
         class="border-t border-brand-maroon/10 bg-brand-cream/98 backdrop-blur xl:hidden">
        <div class="container-x space-y-1 py-4">
            @foreach($nav as $item)
                <a href="{{ route($item['route']) }}"
                   class="block rounded-xl px-4 py-3 text-base font-semibold text-brand-ink/80 hover:bg-white hover:text-brand-maroon">
                    {{ $item['label'] }}
                </a>
            @endforeach
            <a href="{{ route('contact') }}" class="btn-primary mt-2 w-full">{{ __('messages.enquire_now') }}</a>
            @if($headerWhatsapp ?? false)
                <a href="{{ $headerWhatsapp }}" target="_blank" rel="noopener"
                   class="mt-2 flex w-full items-center justify-center gap-2 rounded-xl bg-brand-green px-5 py-3 text-sm font-semibold text-white">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3.5A8.5 8.5 0 004.6 16.2L3.5 20.5l4.4-1.1A8.5 8.5 0 1012 3.5zm0 15.3a6.8 6.8 0 01-3.5-.95l-.25-.15-2.6.68.7-2.53-.16-.26A6.8 6.8 0 1112 18.8zm3.7-5.1c-.2-.1-1.2-.6-1.4-.65s-.32-.1-.46.1-.53.65-.64.78-.23.15-.43.05a5.6 5.6 0 01-1.64-1 6.2 6.2 0 01-1.14-1.42c-.12-.2 0-.32.09-.42s.2-.23.3-.35a1.4 1.4 0 00.2-.33.37.37 0 000-.35c0-.1-.46-1.1-.63-1.5s-.33-.34-.46-.34h-.4a.76.76 0 00-.55.26 2.3 2.3 0 00-.72 1.7 4 4 0 00.84 2.12 9.1 9.1 0 003.5 3.1c.49.2.87.33 1.17.43a2.8 2.8 0 001.3.08 2.1 2.1 0 001.4-1 1.7 1.7 0 00.12-1c-.05-.08-.18-.13-.38-.23z"/></svg>
                    {{ __('messages.contact.send_whatsapp') }}
                </a>
            @endif
        </div>
    </div>
</header>
