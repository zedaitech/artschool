@props([
    'title' => null,
    'description' => null,
    'image' => null,      // Share image for this page; falls back to the site default.
    'ogType' => 'website',
    'schema' => [],       // Extra JSON-LD nodes contributed by the page.
    'noindex' => false,
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        // The homepage takes the admin-set meta title verbatim; inner pages get
        // "Page — School Name" so results read well without repeating the brand.
        $metaTitle = $title
            ? trim($title.' — '.__('messages.school_name'), ' —')
            : ($settings['meta_title'] ?? __('messages.school_name'));
        $metaDesc = \Illuminate\Support\Str::limit(
            strip_tags($description ?? ($settings['meta_description'] ?? __('messages.footer.about'))),
            160,
        );
        // Share previews want a wide image, so the square logo is a poor default;
        // the school banner is the fallback unless an admin sets one in Settings.
        $metaImage = url(media_url(
            $image ?? ($settings['og_image'] ?? null),
            asset('images/hero/banner-creativity-blossoms.jpg'),
        ));
    @endphp

    @include('partials.seo')

    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

    {{-- Fonts. Marcellus and Cormorant Garamond carry no Kannada glyphs, so the
         Kannada locale loads its own display + text pair instead of falling back
         to whatever the operating system happens to ship. Each locale downloads
         only the faces it actually renders. --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @if(app()->getLocale() === 'kn')
        <link href="https://fonts.googleapis.com/css2?family=Anek+Kannada:wght@400;500;600;700&family=Noto+Serif+Kannada:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @else
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=Marcellus&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:z-50 focus:m-4 focus:rounded-lg focus:bg-brand-maroon focus:px-4 focus:py-2 focus:text-white">
        {{ __('messages.nav.home') }}
    </a>

    @include('partials.header')

    <main id="main">
        @include('partials.flash')
        {{ $slot }}
    </main>

    @include('partials.footer')

    {{-- Chat on WhatsApp — always one tap away, on every page --}}
    @if($waLink = whatsapp_url(__('messages.whatsapp.floating_intro')))
        @php $side = LaravelLocalization::getCurrentLocaleDirection() === 'rtl' ? 'right' : 'left'; @endphp
        <a href="{{ $waLink }}" target="_blank" rel="noopener"
           class="group fixed bottom-6 {{ $side === 'right' ? 'right-6' : 'left-6' }} z-40 flex items-center gap-2 rounded-full bg-brand-green py-3 pl-3 pr-4 text-sm font-semibold text-white shadow-soft transition hover:brightness-110"
           aria-label="{{ __('messages.contact.send_whatsapp') }}">
            <svg class="h-6 w-6 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3.5A8.5 8.5 0 004.6 16.2L3.5 20.5l4.4-1.1A8.5 8.5 0 1012 3.5zm0 15.3a6.8 6.8 0 01-3.5-.95l-.25-.15-2.6.68.7-2.53-.16-.26A6.8 6.8 0 1112 18.8zm3.7-5.1c-.2-.1-1.2-.6-1.4-.65s-.32-.1-.46.1-.53.65-.64.78-.23.15-.43.05a5.6 5.6 0 01-1.64-1 6.2 6.2 0 01-1.14-1.42c-.12-.2 0-.32.09-.42s.2-.23.3-.35a1.4 1.4 0 00.2-.33.37.37 0 000-.35c0-.1-.46-1.1-.63-1.5s-.33-.34-.46-.34h-.4a.76.76 0 00-.55.26 2.3 2.3 0 00-.72 1.7 4 4 0 00.84 2.12 9.1 9.1 0 003.5 3.1c.49.2.87.33 1.17.43a2.8 2.8 0 001.3.08 2.1 2.1 0 001.4-1 1.7 1.7 0 00.12-1c-.05-.08-.18-.13-.38-.23z"/></svg>
            <span class="hidden sm:inline">{{ __('messages.contact.whatsapp_label') }}</span>
        </a>
    @endif

    {{-- Scroll to top --}}
    <button x-data="{ show: false }"
            x-init="window.addEventListener('scroll', () => show = window.scrollY > 600)"
            x-show="show" x-transition
            @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="fixed bottom-6 {{ LaravelLocalization::getCurrentLocaleDirection() === 'rtl' ? 'left-6' : 'right-6' }} z-40 grid h-12 w-12 place-items-center rounded-full bg-brand-maroon text-white shadow-soft transition hover:bg-brand-maroon-dark"
            aria-label="Scroll to top">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/>
        </svg>
    </button>
</body>
</html>
