{{--
    Every tag a crawler or a share preview needs, in one place.

    $metaTitle / $metaDesc / $metaImage are prepared by the layout; $schema is
    an optional array of JSON-LD nodes contributed by the page.
--}}
@php
    $canonical = LaravelLocalization::getLocalizedURL(app()->getLocale(), null, [], true);
    $siteName = __('messages.school_name');
    $localeTag = str_replace('-', '_', LaravelLocalization::getCurrentLocaleRegional() ?: app()->getLocale());
@endphp

<title>{{ $metaTitle }}</title>
<meta name="description" content="{{ $metaDesc }}">
<link rel="canonical" href="{{ $canonical }}">
<meta name="robots" content="{{ ($noindex ?? false) ? 'noindex, nofollow' : 'index, follow, max-image-preview:large, max-snippet:-1' }}">
<meta name="theme-color" content="#7A1A2A">

{{-- Open Graph — Facebook, WhatsApp, LinkedIn --}}
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDesc }}">
<meta property="og:type" content="{{ $ogType ?? 'website' }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $metaImage }}">
<meta property="og:image:alt" content="{{ $metaTitle }}">
<meta property="og:locale" content="{{ $localeTag }}">
@foreach(LaravelLocalization::getSupportedLocales() as $code => $props)
    @continue($code === app()->getLocale())
    <meta property="og:locale:alternate" content="{{ str_replace('-', '_', $props['regional'] ?? $code) }}">
@endforeach

{{-- Twitter / X --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDesc }}">
<meta name="twitter:image" content="{{ $metaImage }}">

{{-- hreflang: one per locale, plus x-default so the right language is served --}}
@foreach(LaravelLocalization::getSupportedLocales() as $code => $props)
    <link rel="alternate" hreflang="{{ $code }}"
          href="{{ LaravelLocalization::getLocalizedURL($code, null, [], true) }}">
@endforeach
<link rel="alternate" hreflang="x-default"
      href="{{ LaravelLocalization::getLocalizedURL(config('app.locale'), null, [], true) }}">

{{-- Structured data: the organisation always, plus whatever the page adds --}}
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => array_merge([\App\Support\StructuredData::school()], $schema ?? []),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
