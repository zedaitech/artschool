<section class="py-20">
    <div class="container-x">
        <div data-reveal class="relative overflow-hidden rounded-[2.5rem] bg-maroon-gradient px-8 py-14 text-center shadow-soft sm:px-16">
            <div class="absolute inset-0 bg-grid opacity-10"></div>
            <div class="absolute -left-16 -top-16 h-56 w-56 rounded-full bg-brand-gold/15 blur-3xl"></div>
            <div class="relative mx-auto max-w-2xl">
                <h2 class="font-display text-3xl text-white sm:text-4xl">{{ __('messages.home.cta_title') }}</h2>
                <p class="mx-auto mt-4 max-w-xl text-white/80">{{ __('messages.home.cta_text') }}</p>
                <div class="mt-8 flex flex-wrap justify-center gap-4">
                    <a href="{{ route('contact') }}" class="btn-gold">{{ __('messages.enquire_now') }}</a>
                    @if($ctaWhatsapp = whatsapp_url(__('messages.whatsapp.enquiry_intro')))
                        <a href="{{ $ctaWhatsapp }}" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2 rounded-full bg-brand-green px-6 py-3.5 text-sm font-semibold text-white shadow-sm transition hover:brightness-110">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3.5A8.5 8.5 0 004.6 16.2L3.5 20.5l4.4-1.1A8.5 8.5 0 1012 3.5zm0 15.3a6.8 6.8 0 01-3.5-.95l-.25-.15-2.6.68.7-2.53-.16-.26A6.8 6.8 0 1112 18.8zm3.7-5.1c-.2-.1-1.2-.6-1.4-.65s-.32-.1-.46.1-.53.65-.64.78-.23.15-.43.05a5.6 5.6 0 01-1.64-1 6.2 6.2 0 01-1.14-1.42c-.12-.2 0-.32.09-.42s.2-.23.3-.35a1.4 1.4 0 00.2-.33.37.37 0 000-.35c0-.1-.46-1.1-.63-1.5s-.33-.34-.46-.34h-.4a.76.76 0 00-.55.26 2.3 2.3 0 00-.72 1.7 4 4 0 00.84 2.12 9.1 9.1 0 003.5 3.1c.49.2.87.33 1.17.43a2.8 2.8 0 001.3.08 2.1 2.1 0 001.4-1 1.7 1.7 0 00.12-1c-.05-.08-.18-.13-.38-.23z"/></svg>
                            {{ __('messages.contact.send_whatsapp') }}
                        </a>
                    @endif
                    <a href="{{ route('centers.index') }}" class="btn-ghost-light">{{ __('messages.explore_centers') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
