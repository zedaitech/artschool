<x-layouts.app :title="__('messages.nav.contact')" :description="__('messages.contact.subtitle')">
    <x-page-hero
        :title="__('messages.contact.title')"
        :subtitle="__('messages.contact.subtitle')"
        :eyebrow="__('messages.nav.contact')"
        :image="asset('images/hero/students-drawing-class.jpg')" />

    <section class="py-20">
        <div class="container-x grid gap-12 lg:grid-cols-12">
            {{-- Info --}}
            <div class="lg:col-span-5">
                <x-section-heading :eyebrow="__('messages.nav.contact')" :title="__('messages.contact.title')" :text="__('messages.contact.subtitle')" />

                <div class="mt-10 space-y-5">
                    @php
                        $blocks = [
                            ['label' => __('messages.contact.address'), 'value' => $settings['contact_address'] ?? null, 'icon' => 'M12 21s7-5.5 7-11a7 7 0 10-14 0c0 5.5 7 11 7 11z'],
                            ['label' => __('messages.contact.phone_label'), 'value' => $settings['contact_phone'] ?? null, 'icon' => 'M3 5a2 2 0 012-2h2.6a1 1 0 01.98.8l.8 3.2a1 1 0 01-.5 1.1L8 9a12 12 0 007 7l.9-1.5a1 1 0 011.1-.5l3.2.8a1 1 0 01.8 1V19a2 2 0 01-2 2A16 16 0 013 5z'],
                            ['label' => __('messages.contact.email_label'), 'value' => $settings['contact_email'] ?? null, 'icon' => 'M3 8l9 6 9-6M5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z'],
                            ['label' => __('messages.contact.hours'), 'value' => $settings['contact_hours'] ?? null, 'icon' => 'M12 7v5l3 2'],
                        ];
                    @endphp
                    @foreach($blocks as $b)
                        @if($b['value'])
                            <div data-reveal class="flex items-start gap-4 rounded-2xl border border-brand-ink/8 bg-white p-5">
                                <div class="grid h-11 w-11 shrink-0 place-items-center rounded-xl bg-brand-gold-soft text-brand-maroon">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $b['icon'] }}"/>@if($b['label']===__('messages.contact.hours'))<circle cx="12" cy="12" r="9"/>@endif</svg>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wide text-brand-ink/50">{{ $b['label'] }}</p>
                                    <p class="mt-1 font-medium text-brand-ink/85">{{ $b['value'] }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                @if($contactWhatsapp = whatsapp_url(__('messages.whatsapp.floating_intro')))
                    <a href="{{ $contactWhatsapp }}" target="_blank" rel="noopener" data-reveal
                       class="mt-5 flex items-start gap-4 rounded-2xl border border-brand-green/25 bg-brand-green/5 p-5 transition hover:border-brand-green/50">
                        <div class="grid h-11 w-11 shrink-0 place-items-center rounded-xl bg-brand-green text-white">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3.5A8.5 8.5 0 004.6 16.2L3.5 20.5l4.4-1.1A8.5 8.5 0 1012 3.5zm0 15.3a6.8 6.8 0 01-3.5-.95l-.25-.15-2.6.68.7-2.53-.16-.26A6.8 6.8 0 1112 18.8zm3.7-5.1c-.2-.1-1.2-.6-1.4-.65s-.32-.1-.46.1-.53.65-.64.78-.23.15-.43.05a5.6 5.6 0 01-1.64-1 6.2 6.2 0 01-1.14-1.42c-.12-.2 0-.32.09-.42s.2-.23.3-.35a1.4 1.4 0 00.2-.33.37.37 0 000-.35c0-.1-.46-1.1-.63-1.5s-.33-.34-.46-.34h-.4a.76.76 0 00-.55.26 2.3 2.3 0 00-.72 1.7 4 4 0 00.84 2.12 9.1 9.1 0 003.5 3.1c.49.2.87.33 1.17.43a2.8 2.8 0 001.3.08 2.1 2.1 0 001.4-1 1.7 1.7 0 00.12-1c-.05-.08-.18-.13-.38-.23z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-brand-ink/50">{{ __('messages.contact.whatsapp_label') }}</p>
                            <p class="mt-1 font-medium text-brand-ink/85">{{ $settings['contact_whatsapp'] ?? '' }}</p>
                            <p class="mt-1 text-sm text-brand-ink/55">{{ __('messages.contact.whatsapp_note') }}</p>
                        </div>
                    </a>
                @endif

                @if($settings['contact_person_name'] ?? null)
                    <div data-reveal class="mt-5 rounded-2xl bg-maroon-gradient p-6 text-white shadow-soft">
                        <p class="text-xs font-semibold uppercase tracking-wide text-brand-gold-light">{{ $settings['contact_person_role'] ?? '' }}</p>
                        <p class="mt-1 font-display text-2xl">{{ $settings['contact_person_name'] }}</p>
                        <p class="mt-1 text-sm text-white/70">{{ __('messages.school_name') }}</p>
                        <div class="mt-4 flex flex-wrap gap-3">
                            @if($settings['contact_phone'] ?? null)
                                <a href="tel:{{ preg_replace('/\s+/', '', $settings['contact_phone']) }}"
                                   class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-4 py-2.5 text-sm font-semibold transition hover:bg-white/20">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h2.6a1 1 0 01.98.8l.8 3.2a1 1 0 01-.5 1.1L8 9a12 12 0 007 7l.9-1.5a1 1 0 011.1-.5l3.2.8a1 1 0 01.8 1V19a2 2 0 01-2 2A16 16 0 013 5z"/></svg>
                                    {{ $settings['contact_phone'] }}
                                </a>
                            @endif
                            @if($contactWhatsapp)
                                <a href="{{ $contactWhatsapp }}" target="_blank" rel="noopener"
                                   class="inline-flex items-center gap-2 rounded-xl bg-brand-green px-4 py-2.5 text-sm font-semibold transition hover:brightness-110">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3.5A8.5 8.5 0 004.6 16.2L3.5 20.5l4.4-1.1A8.5 8.5 0 1012 3.5zm0 15.3a6.8 6.8 0 01-3.5-.95l-.25-.15-2.6.68.7-2.53-.16-.26A6.8 6.8 0 1112 18.8zm3.7-5.1c-.2-.1-1.2-.6-1.4-.65s-.32-.1-.46.1-.53.65-.64.78-.23.15-.43.05a5.6 5.6 0 01-1.64-1 6.2 6.2 0 01-1.14-1.42c-.12-.2 0-.32.09-.42s.2-.23.3-.35a1.4 1.4 0 00.2-.33.37.37 0 000-.35c0-.1-.46-1.1-.63-1.5s-.33-.34-.46-.34h-.4a.76.76 0 00-.55.26 2.3 2.3 0 00-.72 1.7 4 4 0 00.84 2.12 9.1 9.1 0 003.5 3.1c.49.2.87.33 1.17.43a2.8 2.8 0 001.3.08 2.1 2.1 0 001.4-1 1.7 1.7 0 00.12-1c-.05-.08-.18-.13-.38-.23z"/></svg>
                                    {{ __('messages.contact.whatsapp_label') }}
                                </a>
                            @endif
                        </div>
                    </div>
                @endif

                <div class="mt-8">
                    <p class="text-sm font-semibold text-brand-ink/70">{{ __('messages.contact.follow_us') }}</p>
                    <div class="mt-3">
                        @include('partials.social-icons', ['class' => 'bg-brand-gold-soft text-brand-maroon hover:bg-brand-maroon hover:text-white'])
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <div class="lg:col-span-6 lg:col-start-7">
                <div data-reveal class="rounded-3xl border border-brand-ink/8 bg-white p-8 shadow-soft">
                    <h2 class="font-display text-2xl text-brand-ink">{{ __('messages.contact.form_title') }}</h2>
                    <div class="mt-6">
                        <x-enquiry-form type="contact" :centers="$centers" :selected-center="request('centre')" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Map --}}
    @if($settings['map_embed'] ?? null)
        <section class="pb-20">
            <div class="container-x">
                <div class="overflow-hidden rounded-3xl shadow-soft ring-1 ring-black/5">
                    <iframe src="{{ $settings['map_embed'] }}" width="100%" height="420" style="border:0;"
                            allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            title="Map"></iframe>
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>
