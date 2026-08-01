@php
    $footerNav = [
        ['route' => 'home', 'label' => __('messages.nav.home')],
        ['route' => 'centers.index', 'label' => __('messages.nav.centers')],
        ['route' => 'franchise', 'label' => __('messages.nav.franchise')],
        ['route' => 'gallery', 'label' => __('messages.nav.gallery')],
        ['route' => 'events.index', 'label' => __('messages.nav.events')],
        ['route' => 'contact', 'label' => __('messages.nav.contact')],
        ['url' => route('contact').'#donate', 'label' => __('messages.donate.nav')],
    ];
@endphp
<footer class="relative mt-24 overflow-hidden bg-maroon-gradient text-white/80">
    <div class="absolute inset-0 bg-grid opacity-[0.15]"></div>
    <div class="absolute -right-24 -top-24 h-72 w-72 rounded-full bg-brand-gold/10 blur-3xl"></div>

    <div class="container-x relative py-16">
        <div class="grid gap-12 lg:grid-cols-12">
            {{-- Brand --}}
            <div class="lg:col-span-4">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="{{ __('messages.school_name') }}"
                         class="h-16 w-16 rounded-full bg-white/95 object-contain p-0.5">
                    <span class="leading-tight">
                        <span class="block font-display text-xl text-white">{{ __('messages.school_name') }}, {{ __('messages.school_city') }}</span>
                        <span class="block text-xs text-brand-gold-light">({{ __('messages.school_type') }})</span>
                    </span>
                </div>
                <p class="mt-5 max-w-sm text-sm leading-relaxed text-white/70">{{ __('messages.footer.about') }}</p>
                <div class="mt-6">@include('partials.social-icons')</div>

                {{-- Registration mark: the logo is drawn for white, so it keeps
                     its own light chip rather than sitting on the maroon. --}}
                <div class="mt-7">
                    <p class="text-xs font-semibold uppercase tracking-wide text-white/45">{{ __('messages.msme.footer_label') }}</p>
                    <img src="{{ asset_v('images/msme-registered.jpg') }}" alt="{{ __('messages.msme.label') }}" loading="lazy"
                         class="mt-2 h-14 w-auto rounded-lg bg-white p-1.5">
                </div>
            </div>

            {{-- Links --}}
            <div class="lg:col-span-3 lg:col-start-6">
                <h4 class="font-display text-lg text-brand-gold-light">{{ __('messages.footer.quick_links') }}</h4>
                <ul class="mt-5 space-y-3 text-sm">
                    @foreach($footerNav as $item)
                        <li>
                            <a href="{{ $item['url'] ?? route($item['route']) }}" class="inline-flex min-h-[28px] items-center gap-2 text-white/70 transition hover:text-brand-gold-light">
                                <span class="h-1 w-1 rounded-full bg-brand-gold"></span>{{ $item['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact --}}
            <div class="lg:col-span-4">
                <h4 class="font-display text-lg text-brand-gold-light">{{ __('messages.footer.contact') }}</h4>
                <ul class="mt-5 space-y-4 text-sm text-white/70">
                    @if($settings['contact_address'] ?? null)
                        <li class="flex gap-3">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-brand-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21s7-5.5 7-11a7 7 0 10-14 0c0 5.5 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>
                            <span>{{ $settings['contact_address'] }}</span>
                        </li>
                    @endif
                    @if($settings['contact_phone'] ?? null)
                        <li class="flex gap-3">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-brand-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h2.6a1 1 0 01.98.8l.8 3.2a1 1 0 01-.5 1.1L8 9a12 12 0 007 7l.9-1.5a1 1 0 011.1-.5l3.2.8a1 1 0 01.8 1V19a2 2 0 01-2 2A16 16 0 013 5z"/></svg>
                            <a href="tel:{{ preg_replace('/\s+/', '', $settings['contact_phone']) }}" class="inline-flex min-h-[24px] items-center hover:text-brand-gold-light">{{ $settings['contact_phone'] }}</a>
                        </li>
                    @endif
                    @if($footerWhatsapp = whatsapp_url(__('messages.whatsapp.floating_intro')))
                        <li class="flex gap-3">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-brand-gold" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3.5A8.5 8.5 0 004.6 16.2L3.5 20.5l4.4-1.1A8.5 8.5 0 1012 3.5zm0 15.3a6.8 6.8 0 01-3.5-.95l-.25-.15-2.6.68.7-2.53-.16-.26A6.8 6.8 0 1112 18.8zm3.7-5.1c-.2-.1-1.2-.6-1.4-.65s-.32-.1-.46.1-.53.65-.64.78-.23.15-.43.05a5.6 5.6 0 01-1.64-1 6.2 6.2 0 01-1.14-1.42c-.12-.2 0-.32.09-.42s.2-.23.3-.35a1.4 1.4 0 00.2-.33.37.37 0 000-.35c0-.1-.46-1.1-.63-1.5s-.33-.34-.46-.34h-.4a.76.76 0 00-.55.26 2.3 2.3 0 00-.72 1.7 4 4 0 00.84 2.12 9.1 9.1 0 003.5 3.1c.49.2.87.33 1.17.43a2.8 2.8 0 001.3.08 2.1 2.1 0 001.4-1 1.7 1.7 0 00.12-1c-.05-.08-.18-.13-.38-.23z"/></svg>
                            <a href="{{ $footerWhatsapp }}" target="_blank" rel="noopener" class="inline-flex min-h-[24px] items-center hover:text-brand-gold-light">
                                {{ $settings['contact_whatsapp'] ?? '' }} &middot; {{ __('messages.contact.whatsapp_label') }}
                            </a>
                        </li>
                    @endif
                    @if($settings['contact_email'] ?? null)
                        <li class="flex gap-3">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-brand-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l9 6 9-6M5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"/></svg>
                            <a href="mailto:{{ $settings['contact_email'] }}" class="inline-flex min-h-[24px] items-center break-all hover:text-brand-gold-light">{{ $settings['contact_email'] }}</a>
                        </li>
                    @endif
                    @if($settings['contact_hours'] ?? null)
                        <li class="flex gap-3">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-brand-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path stroke-linecap="round" d="M12 7v5l3 2"/></svg>
                            <span>{{ $settings['contact_hours'] }}</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="mt-14 flex flex-col items-center justify-between gap-4 border-t border-white/10 pt-8 text-xs text-white/50 sm:flex-row">
            <p>&copy; {{ date('Y') }} {{ __('messages.school_name') }}. {{ __('messages.footer.rights') }}</p>
            <p class="flex items-center gap-1.5">
                <span class="text-brand-gold">&#10022;</span> {{ __('messages.footer.made_with') }}
            </p>
            <p>
                {{ __('messages.footer.crafted_by') }}
                <a href="https://www.zedai.tech" target="_blank" rel="noopener"
                   class="inline-flex min-h-[24px] items-center font-semibold tracking-wide text-white/70 transition hover:text-brand-gold-light">
                    ZED LABS
                </a>
            </p>
        </div>
    </div>
</footer>
