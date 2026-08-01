@php
    $franchise = config('franchise');

    // The rule lists quote the commercial terms, so the numbers are injected
    // from config rather than repeated in every translation.
    $ruleReplacements = [
        'fee' => $franchise['fee'],
        'years' => $franchise['term_years'],
        'area' => $franchise['classroom_area'],
    ];

    $schema = [\App\Support\StructuredData::breadcrumbs([
        __('messages.nav.home') => route('home'),
        __('messages.nav.franchise') => route('franchise'),
    ])];
@endphp
<x-layouts.app :title="__('messages.nav.franchise')" :description="__('messages.franchise.text')"
               :image="asset('images/franchise-poster.jpg')" :schema="$schema">

    <x-page-hero
        :title="__('messages.franchise.title')"
        :subtitle="__('messages.franchise.hero_subtitle')"
        :eyebrow="__('messages.franchise.eyebrow')"
        :image="asset('images/hero/students-drawing-class.jpg')" />

    {{-- The offer, up front: the fee is the first thing anyone wants to know. --}}
    <section class="py-20">
        <div class="container-x grid items-start gap-12 lg:grid-cols-12">
            <div class="min-w-0 lg:col-span-7">
                <x-section-heading
                    :eyebrow="__('messages.franchise.offer_eyebrow')"
                    :title="__('messages.franchise.offer_title')"
                    :text="__('messages.franchise.text')" />

                <div data-reveal class="mt-10 rounded-3xl bg-maroon-gradient p-8 text-white shadow-soft">
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-brand-gold-light">
                        {{ __('messages.franchise.fee_label') }}
                    </p>
                    <p class="mt-2 font-display text-5xl leading-none text-white sm:text-6xl">{{ $franchise['fee'] }}</p>
                    <p class="mt-3 text-sm text-white/70">{{ __('messages.franchise.fee_note') }}</p>

                    <ul class="mt-7 space-y-3 border-t border-white/15 pt-6">
                        @foreach(__('messages.franchise.assurances') as $assurance)
                            <li class="flex items-start gap-3 text-sm font-medium">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-brand-gold-light" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                {{ $assurance }}
                            </li>
                        @endforeach
                    </ul>

                    <div class="mt-7 flex flex-wrap items-center gap-4 border-t border-white/15 pt-6">
                        <img src="{{ asset_v('images/msme-registered.jpg') }}" alt="{{ __('messages.msme.label') }}" loading="lazy"
                             class="h-12 w-auto shrink-0 rounded-lg bg-white p-1">
                        <div class="min-w-0">
                            <p class="text-xs font-semibold uppercase tracking-wide text-white/45">{{ __('messages.franchise.udyam_label') }}</p>
                            <p class="mt-0.5 break-all text-sm font-semibold">{{ $franchise['udyam'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="#franchise-enquiry" class="btn-primary">{{ __('messages.franchise.form_submit') }}</a>
                    @if($settings['contact_phone'] ?? null)
                        <a href="tel:{{ preg_replace('/\s+/', '', $settings['contact_phone']) }}" class="btn-outline">
                            {{ __('messages.franchise.cta_call') }} · {{ $settings['contact_phone'] }}
                        </a>
                    @endif
                </div>
            </div>

            {{-- The poster is a tall, text-dense artwork, so it is shown whole
                 rather than cropped into a banner. --}}
            <figure data-reveal class="min-w-0 lg:col-span-5">
                <a href="{{ asset_v($franchise['poster']) }}" target="_blank" rel="noopener"
                   class="block overflow-hidden rounded-3xl border border-brand-ink/10 shadow-soft transition hover:shadow-lg">
                    <img src="{{ asset_v($franchise['poster']) }}" alt="{{ __('messages.franchise.poster_alt') }}" loading="lazy"
                         class="w-full">
                </a>
                <figcaption class="mt-3 text-center text-xs font-semibold uppercase tracking-wide text-brand-ink/45">
                    {{ __('messages.franchise.poster_view') }}
                </figcaption>
            </figure>
        </div>
    </section>

    {{-- Why choose us --}}
    <section class="bg-white py-20">
        <div class="container-x">
            <x-section-heading center
                :eyebrow="__('messages.franchise.why_eyebrow')"
                :title="__('messages.franchise.why_title')" />

            <div class="mt-12 grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
                @foreach(__('messages.franchise.why') as $i => $item)
                    <div data-reveal class="rounded-3xl border border-brand-ink/8 bg-brand-cream/50 p-7 transition hover:border-brand-gold/40 hover:shadow-soft">
                        <div class="grid h-12 w-12 place-items-center rounded-2xl bg-brand-gold-soft text-brand-maroon">
                            <x-art-icon :name="['star', 'palette', 'brush', 'cube', 'pencil', 'device'][$i % 6]" class="h-6 w-6" />
                        </div>
                        <h3 class="mt-5 font-display text-xl text-brand-ink">{{ $item['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-brand-ink/65">{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Support + materials --}}
    <section class="py-20">
        <div class="container-x">
            <x-section-heading center
                :eyebrow="__('messages.franchise.support_eyebrow')"
                :title="__('messages.franchise.support_title')"
                :text="__('messages.franchise.support_text')" />

            <div class="mt-12 grid gap-8 lg:grid-cols-12">
                <div data-reveal class="min-w-0 rounded-3xl border border-brand-ink/8 bg-white p-8 shadow-soft lg:col-span-7">
                    <ul class="grid gap-4 sm:grid-cols-2">
                        @foreach(__('messages.franchise.support') as $item)
                            <li class="flex items-start gap-3">
                                <span class="mt-0.5 grid h-6 w-6 shrink-0 place-items-center rounded-full bg-brand-green/10 text-brand-green">
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                </span>
                                <span class="text-sm font-medium leading-relaxed text-brand-ink/80">{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div data-reveal class="min-w-0 rounded-3xl bg-brand-cream p-8 ring-1 ring-brand-gold/25 lg:col-span-5">
                    <h3 class="font-display text-xl text-brand-ink">{{ __('messages.franchise.materials_title') }}</h3>
                    <ul class="mt-5 space-y-3">
                        @foreach(__('messages.franchise.materials') as $item)
                            <li class="flex items-start gap-3 text-sm text-brand-ink/75">
                                <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-brand-gold"></span>
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Ideal for --}}
    <section class="bg-white py-20">
        <div class="container-x">
            <x-section-heading center
                :eyebrow="__('messages.franchise.ideal_eyebrow')"
                :title="__('messages.franchise.ideal_title')" />

            <div class="mt-12 flex flex-wrap justify-center gap-4">
                @foreach(__('messages.franchise.ideal') as $item)
                    <span data-reveal class="inline-flex items-center gap-2 rounded-full border border-brand-gold/35 bg-brand-gold-soft/50 px-5 py-3 text-sm font-semibold text-brand-ink/80">
                        <svg class="h-4 w-4 shrink-0 text-brand-maroon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        {{ $item }}
                    </span>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Rules & guidelines --}}
    <section class="py-20">
        <div class="container-x">
            <x-section-heading center
                :eyebrow="__('messages.franchise.rules_eyebrow')"
                :title="__('messages.franchise.rules_title')"
                :text="__('messages.franchise.rules_text')" />

            <div class="mt-12 grid gap-6 md:grid-cols-2">
                @foreach(__('messages.franchise.rules') as $i => $rule)
                    <div data-reveal class="rounded-3xl border border-brand-ink/8 bg-white p-7 shadow-soft">
                        <div class="flex items-baseline gap-3">
                            <span class="font-display text-2xl text-brand-gold">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <h3 class="font-display text-xl text-brand-ink">{{ $rule['title'] }}</h3>
                        </div>

                        @if($rule['note'] ?? null)
                            <p class="mt-3 text-sm text-brand-ink/60">{{ $rule['note'] }}</p>
                        @endif

                        <ul class="mt-4 space-y-2.5">
                            @foreach($rule['items'] as $item)
                                <li class="flex items-start gap-3 text-sm leading-relaxed text-brand-ink/75">
                                    <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-brand-maroon/40"></span>
                                    {{ __($item, $ruleReplacements) }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Closing pitch + enquiry form --}}
    <section id="franchise-enquiry" class="scroll-mt-28 bg-brand-cream py-20">
        <div class="container-x grid items-start gap-12 lg:grid-cols-12">
            <div class="min-w-0 lg:col-span-5">
                <x-section-heading
                    :eyebrow="__('messages.franchise.join_eyebrow')"
                    :title="__('messages.franchise.join_title')"
                    :text="__('messages.franchise.join_text')" />

                <figure data-reveal class="mt-8 rounded-3xl border-s-4 border-brand-gold bg-white p-6 shadow-soft">
                    <blockquote class="font-display text-xl leading-relaxed text-brand-maroon">
                        “{{ __('messages.franchise.quote') }}”
                    </blockquote>
                    <figcaption class="mt-4 text-sm text-brand-ink/60">
                        <span class="font-semibold text-brand-ink/80">{{ __('messages.founder.name') }}</span>
                        <span class="block">{{ __('messages.founder.eyebrow') }}</span>
                    </figcaption>
                </figure>
            </div>

            <div data-reveal class="min-w-0 rounded-3xl border border-brand-ink/8 bg-white p-8 shadow-soft lg:col-span-7">
                <h2 class="font-display text-2xl text-brand-ink">{{ __('messages.franchise.form_title') }}</h2>
                <p class="mt-2 text-sm leading-relaxed text-brand-ink/60">{{ __('messages.franchise.form_subtitle') }}</p>

                <div class="mt-8">
                    <x-enquiry-form
                        type="franchise"
                        :place-label="__('messages.franchise.form_place')"
                        :submit-label="__('messages.franchise.form_submit')" />
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
