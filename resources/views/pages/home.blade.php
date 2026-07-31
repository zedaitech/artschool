@php
    $schema = $featuredEvent ? [\App\Support\StructuredData::event($featuredEvent)] : [];
@endphp
<x-layouts.app :schema="$schema">
    {{-- ============ HERO SLIDER ============ --}}
    <section x-data="{
                active: 0,
                count: {{ $slides->count() ?: 1 }},
                timer: null,
                start() { this.timer = setInterval(() => this.next(), 6500); },
                next() { this.active = (this.active + 1) % this.count; },
                go(i) { this.active = i; clearInterval(this.timer); this.start(); }
            }"
             x-init="start()"
             class="relative h-[100svh] min-h-[620px] overflow-hidden bg-brand-maroon-dark">
        @forelse($slides as $i => $slide)
            <div x-show="active === {{ $i }}"
                 x-transition:enter="transition ease-out duration-[1200ms]"
                 x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 class="absolute inset-0">
                @if($slide->is_banner)
                    {{-- Ready-made banner: it carries its own artwork and typography,
                         so it is shown whole (letterboxed) instead of being cropped
                         and covered by the overlay copy. --}}
                    <img src="{{ media_url($slide->image) }}" alt="" aria-hidden="true"
                         class="h-full w-full scale-110 object-cover opacity-30 blur-2xl">
                    <div class="absolute inset-0 flex items-center justify-center px-4 pb-20 pt-28 sm:px-8 lg:pt-36">
                        <img src="{{ media_url($slide->image) }}" alt="{{ $slide->heading }}"
                             class="max-h-full w-auto max-w-6xl rounded-xl object-contain shadow-2xl ring-1 ring-brand-gold/30"
                             :class="active === {{ $i }} ? 'scale-105 transition-transform duration-[7000ms] ease-out' : ''">
                    </div>
                    {{-- Keeps the light-on-dark header legible above a bright banner. --}}
                    <div class="absolute inset-x-0 top-0 h-40 bg-gradient-to-b from-brand-maroon-dark/90 to-transparent"></div>
                    @if($slide->cta_url)
                        {{-- The whole banner is the link — it already says what it is. --}}
                        <a href="{{ url(app()->getLocale().'/'.ltrim($slide->cta_url, '/')) }}"
                           class="absolute inset-0 z-10" aria-label="{{ $slide->heading }}"></a>
                    @endif
                @else
                    <img src="{{ media_url($slide->image) }}" alt="{{ $slide->heading }}"
                         class="h-full w-full object-cover"
                         :class="active === {{ $i }} ? 'scale-105 transition-transform duration-[7000ms] ease-out' : ''">
                    <div class="absolute inset-0 bg-gradient-to-r from-brand-maroon-dark/90 via-brand-maroon-dark/60 to-transparent"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-brand-maroon-dark/80 to-transparent"></div>
                @endif
            </div>
        @empty
            <div class="absolute inset-0 bg-maroon-gradient"></div>
        @endforelse

        <div class="absolute inset-0 bg-grid opacity-[0.08]"></div>

        {{-- Slide content --}}
        <div class="container-x pointer-events-none relative flex h-full items-center">
            <div class="max-w-2xl pt-20">
                @foreach($slides as $i => $slide)
                    @continue($slide->is_banner)
                    <div x-show="active === {{ $i }}"
                         class="pointer-events-auto"
                         x-transition:enter="transition ease-out duration-700 delay-300"
                         x-transition:enter-start="opacity-0 translate-y-6" x-transition:enter-end="opacity-100 translate-y-0"
                         @if(!$loop->first) style="display:none" @endif>
                        @if($slide->eyebrow)
                            <span class="inline-flex items-center gap-2 rounded-full border border-brand-gold/40 bg-brand-gold/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.22em] text-brand-gold-light backdrop-blur">
                                {{ $slide->eyebrow }}
                            </span>
                        @endif
                        <h1 class="mt-6 font-display text-4xl leading-[1.05] text-white text-shadow-hero sm:text-6xl lg:text-7xl">{{ $slide->heading }}</h1>
                        @if($slide->subheading)
                            <p class="mt-6 max-w-xl text-lg leading-relaxed text-white/85">{{ $slide->subheading }}</p>
                        @endif
                        <div class="mt-9 flex flex-wrap items-center gap-4">
                            @if($slide->cta_label)
                                <a href="{{ url(app()->getLocale().'/'.ltrim($slide->cta_url ?? '', '/')) }}" class="btn-gold">
                                    {{ $slide->cta_label }}
                                    <svg class="h-4 w-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M5 12h14M13 6l6 6-6 6"/></svg>
                                </a>
                            @endif
                            <a href="{{ route('contact') }}" class="btn-ghost-light">{{ __('messages.enquire_now') }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Dots --}}
        @if($slides->count() > 1)
            <div class="absolute bottom-5 left-1/2 z-10 flex -translate-x-1/2 items-center gap-1">
                @foreach($slides as $i => $slide)
                    {{-- The dot stays 8px; the button around it is a 44px touch target. --}}
                    <button @click="go({{ $i }})" aria-label="Slide {{ $i + 1 }}"
                            class="grid h-11 w-8 place-items-center">
                        <span class="h-2 rounded-full transition-all duration-300"
                              :class="active === {{ $i }} ? 'w-8 bg-brand-gold' : 'w-2 bg-white/40 hover:bg-white/70'"></span>
                    </button>
                @endforeach
            </div>
        @endif

        {{-- Scroll cue --}}
        <div class="absolute bottom-8 {{ LaravelLocalization::getCurrentLocaleDirection() === 'rtl' ? 'left-8' : 'right-8' }} z-10 hidden items-center gap-2 text-xs uppercase tracking-widest text-white/50 lg:flex">
            <span class="h-10 w-px animate-pulse bg-white/40"></span>
        </div>
    </section>

    {{-- ============ STATS ============ --}}
    <section class="relative z-10 -mt-16">
        <div class="container-x">
            <div data-reveal class="grid grid-cols-2 gap-px overflow-hidden rounded-3xl bg-brand-gold/25 shadow-gold ring-1 ring-brand-gold/40 lg:grid-cols-4">
                @php
                    $stats = [
                        ['value' => $settings['stat_students'] ?? 1200, 'label' => __('messages.stats.students')],
                        ['value' => $settings['stat_years'] ?? 7, 'label' => __('messages.stats.years')],
                        ['value' => $settings['stat_centers'] ?? 10, 'label' => __('messages.stats.centers')],
                        ['value' => $settings['stat_awards'] ?? 45, 'label' => __('messages.stats.awards')],
                    ];
                @endphp
                @foreach($stats as $stat)
                    <div class="bg-gradient-to-b from-white to-brand-gold-pale/60 px-6 py-8 text-center">
                        <div class="font-display text-4xl text-brand-maroon lg:text-5xl">
                            <span data-count="{{ (int) $stat['value'] }}">0</span><span class="text-brand-gold-amber">+</span>
                        </div>
                        <p class="mt-2 text-sm font-medium text-brand-ink/60">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ FEATURED EVENT ============ --}}
    @if($featuredEvent)
        {{-- pt-28 clears the stats band, which is pulled up over the hero by -mt-16. --}}
        <section class="pt-28">
            <div class="container-x">
                {{-- A compact announcement banner: poster thumbnail, the headline and
                     the closing date on one row, ringed in gold so it reads as news. --}}
                <a href="{{ route('events.show', $featuredEvent->slug) }}"
                   data-reveal
                   class="group relative flex items-center gap-5 overflow-hidden rounded-3xl bg-maroon-gradient p-4 pe-6 text-white shadow-[0_18px_50px_-24px_rgba(122,26,42,0.75)] ring-2 ring-brand-gold/45 transition hover:ring-brand-gold/80 sm:gap-6 sm:p-5 sm:pe-8">
                    <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-brand-gold/15 blur-3xl"></div>

                    @if($featuredEvent->image)
                        <img src="{{ media_url($featuredEvent->image) }}" alt="{{ $featuredEvent->title }}"
                             loading="lazy"
                             class="relative h-24 w-20 shrink-0 rounded-2xl object-cover ring-1 ring-white/25 transition-transform duration-500 group-hover:scale-105 sm:h-28 sm:w-36">
                    @endif

                    <div class="relative min-w-0 flex-1">
                        <div class="flex flex-wrap items-center gap-2.5">
                            <span class="rounded-full bg-brand-gold px-3 py-1 text-xs font-semibold uppercase tracking-wide text-brand-maroon-dark shadow-sm">
                                {{ __('messages.events.entries_open') }}
                            </span>
                            <span class="eyebrow !text-brand-gold-light">{{ __('messages.events.eyebrow') }}</span>
                        </div>

                        <p class="mt-2 truncate font-display text-xl leading-snug sm:text-2xl lg:text-3xl">{{ $featuredEvent->title }}</p>

                        @if($featuredEvent->starts_at)
                            <p class="mt-1.5 flex items-center gap-2 text-sm text-white/70">
                                <svg class="h-4 w-4 shrink-0 text-brand-gold-light" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <rect x="3" y="5" width="18" height="16" rx="2"/><path stroke-linecap="round" d="M3 10h18M8 3v4M16 3v4"/>
                                </svg>
                                <span class="truncate">
                                    {{ __('messages.events.closing_date') }}:
                                    <span class="font-semibold text-white">{{ $featuredEvent->starts_at->translatedFormat('j F Y') }}</span>
                                </span>
                            </p>
                        @endif
                    </div>

                    <span class="relative hidden shrink-0 items-center gap-2 rounded-full bg-white/10 px-5 py-2.5 text-sm font-semibold text-brand-gold-light backdrop-blur transition group-hover:bg-white/20 sm:inline-flex">
                        {{ __('messages.events.view_details') }}
                        <svg class="h-4 w-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M5 12h14M13 6l6 6-6 6"/></svg>
                    </span>
                    <svg class="relative h-6 w-6 shrink-0 text-brand-gold-light sm:hidden rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M5 12h14M13 6l6 6-6 6"/></svg>
                </a>
            </div>
        </section>
    @endif

    {{-- ============ WELCOME ============ --}}
    <section class="py-24">
        <div class="container-x grid items-center gap-14 lg:grid-cols-2">
            <div data-reveal class="relative">
                <div class="relative overflow-hidden rounded-[2rem] shadow-soft">
                    {{-- The logo is square, so the frame is square too: it fills the
                         box edge to edge with no letterboxing above and below. --}}
                    <img src="{{ asset('images/logo.png') }}" alt="{{ __('messages.home.welcome_title') }}" class="aspect-square w-full bg-brand-cream object-cover">
                </div>
                <div class="absolute -bottom-6 {{ LaravelLocalization::getCurrentLocaleDirection() === 'rtl' ? '-left-6' : '-right-6' }} hidden w-48 rounded-2xl bg-brand-maroon p-5 text-white shadow-soft sm:block">
                    <img src="{{ asset('images/logo.png') }}" alt="" loading="lazy"
                         class="mx-auto h-16 w-16 rounded-full bg-white/95 object-contain p-0.5 ring-2 ring-white/80">
                    <p class="mt-3 text-center font-display text-sm leading-snug text-brand-gold-light">{{ __('messages.established') }}</p>
                </div>
                <div class="absolute -left-4 -top-4 -z-10 h-40 w-40 rounded-full bg-brand-gold/20 blur-2xl"></div>
            </div>

            <div>
                <x-section-heading
                    :eyebrow="__('messages.home.welcome_eyebrow')"
                    :title="__('messages.home.welcome_title')"
                    :text="__('messages.home.welcome_text')">
                    <p class="mt-4 leading-relaxed text-brand-ink/65">{{ __('messages.home.welcome_text_2') }}</p>
                    <p class="mt-4 leading-relaxed text-brand-ink/65">{{ __('messages.home.welcome_text_3') }}</p>
                </x-section-heading>

                <div class="mt-8 grid gap-5 sm:grid-cols-2">
                    @php
                        $pillars = [
                            ['icon' => 'palette', 'title' => __('messages.founder.eyebrow'), 'text' => __('messages.founder.page_subtitle')],
                            ['icon' => 'star', 'title' => __('messages.home.centers_eyebrow'), 'text' => __('messages.home.centers_text')],
                        ];
                    @endphp
                    @foreach($pillars as $p)
                        <div data-reveal class="rounded-2xl border border-brand-ink/8 bg-white p-5">
                            <div class="grid h-11 w-11 place-items-center rounded-xl bg-brand-gold-soft text-brand-maroon">
                                <x-art-icon :name="$p['icon']" />
                            </div>
                            <h4 class="mt-4 font-display text-lg text-brand-ink">{{ $p['title'] }}</h4>
                            <p class="mt-1.5 text-sm leading-relaxed text-brand-ink/60">{{ $p['text'] }}</p>
                        </div>
                    @endforeach
                </div>

                <a href="{{ route('centers.index') }}" class="btn-outline mt-9">{{ __('messages.explore_centers') }}</a>
            </div>
        </div>
    </section>

    {{-- ============ TRAINING CENTRES ============ --}}
    <section class="bg-white py-24">
        <div class="container-x">
            <div class="flex flex-col items-end justify-between gap-6 sm:flex-row">
                <x-section-heading
                    :eyebrow="__('messages.home.centers_eyebrow')"
                    :title="__('messages.home.centers_title')"
                    :text="__('messages.home.centers_text')" />
                <a href="{{ route('centers.index') }}" class="btn-outline shrink-0">{{ __('messages.view_all') }}</a>
            </div>

            <div class="mt-14 grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
                @foreach(($featuredCenters->count() ? $featuredCenters : $centers)->take(6) as $center)
                    <x-center-card :center="$center" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ WHAT WE OFFER ============ --}}
    <section class="section-tint py-24">
        <div class="container-x">
            <x-section-heading center
                :eyebrow="__('messages.offer.eyebrow')"
                :title="__('messages.offer.title')"
                :text="__('messages.offer.text')" />

            <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach(__('messages.offer.items') as $i => $item)
                    <div data-reveal data-reveal-delay="{{ ($i % 3) * 70 }}"
                         class="group rounded-2xl border border-brand-ink/8 bg-white p-7 transition hover:border-brand-gold/40 hover:shadow-soft">
                        <div class="grid h-12 w-12 place-items-center rounded-xl bg-brand-gold-soft text-brand-maroon transition group-hover:bg-brand-maroon group-hover:text-white">
                            <x-art-icon :name="$item['icon']" />
                        </div>
                        <h3 class="mt-5 font-display text-xl leading-tight text-brand-ink">{{ $item['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-brand-ink/60">{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ OUR BELIEF ============ --}}
    <section class="pb-24">
        <div class="container-x">
            <figure data-reveal class="relative overflow-hidden rounded-[2.5rem] bg-brand-ink px-8 py-14 text-center text-white sm:px-16">
                <div class="absolute inset-0 bg-grid opacity-10"></div>
                <div class="absolute -left-16 -top-16 h-56 w-56 rounded-full bg-brand-gold/10 blur-3xl"></div>
                <div class="relative mx-auto max-w-3xl">
                    <span class="eyebrow !text-brand-gold-light justify-center">{{ __('messages.belief.eyebrow') }}</span>
                    <blockquote class="mt-6 font-display text-2xl leading-snug text-white sm:text-4xl">
                        &ldquo;{{ __('messages.belief.quote') }}&rdquo;
                    </blockquote>
                    <figcaption class="mt-8 text-sm text-white/60">
                        <span class="block text-xs font-semibold uppercase tracking-[0.22em] text-brand-gold">{{ __('messages.belief.director_role') }}</span>
                        <span class="mt-2 block font-display text-lg text-white">{{ __('messages.belief.director_name') }}</span>
                        <span class="mt-1 block">{{ __('messages.school_name') }}, {{ __('messages.school_city') }}</span>
                    </figcaption>
                </div>
            </figure>
        </div>
    </section>

    {{-- ============ WHY CHOOSE US ============ --}}
    <section class="section-tint py-24">
        <div class="container-x">
            <x-section-heading center
                :eyebrow="__('messages.why.eyebrow')"
                :title="__('messages.why.title')"
                :text="__('messages.why.text')" />

            <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach(__('messages.why.items') as $i => $item)
                    <div data-reveal data-reveal-delay="{{ ($i % 4) * 70 }}"
                         class="group rounded-2xl border border-brand-ink/8 bg-white p-6 transition hover:border-brand-gold/40 hover:shadow-soft">
                        <div class="grid h-11 w-11 place-items-center rounded-xl bg-brand-gold-soft text-brand-maroon transition group-hover:bg-brand-maroon group-hover:text-white">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <h3 class="mt-4 font-display text-lg leading-tight text-brand-ink">{{ $item['title'] }}</h3>
                        <p class="mt-1.5 text-sm leading-relaxed text-brand-ink/60">{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ VISION & MISSION ============ --}}
    <section class="overflow-hidden bg-white py-24">
        <div class="container-x grid items-start gap-10 lg:grid-cols-2">
            <div data-reveal class="relative overflow-hidden rounded-[2rem] bg-maroon-gradient p-9 text-white">
                <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-brand-gold/15 blur-3xl"></div>
                <span class="eyebrow !text-brand-gold-light">{{ __('messages.vision.eyebrow') }}</span>
                <h3 class="mt-4 font-display text-3xl text-white">{{ __('messages.vision.title') }}</h3>
                <div class="relative mt-4 space-y-4 leading-relaxed text-white/80">
                    @foreach(__('messages.vision.paragraphs') as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </div>

                {{-- The motto closes the vision — it is the one line we want remembered. --}}
                <div class="relative mt-8 border-t border-white/15 pt-7">
                    <span class="text-xs font-semibold uppercase tracking-[0.22em] text-brand-gold-light">{{ __('messages.vision.motto_label') }}</span>
                    <p class="mt-3 font-display text-2xl leading-snug text-white">{{ __('messages.motto') }}</p>
                </div>
            </div>
            <div data-reveal class="rounded-[2rem] border border-brand-ink/8 bg-brand-cream p-9">
                <span class="eyebrow">{{ __('messages.mission.eyebrow') }}</span>
                <h3 class="mt-4 font-display text-3xl text-brand-ink">{{ __('messages.mission.title') }}</h3>
                <ul class="mt-5 space-y-3">
                    @foreach(__('messages.mission.items') as $item)
                        <li class="flex items-start gap-3 text-brand-ink/75">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-brand-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span>{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    {{-- ============ FOUNDER ============ --}}
    {{-- The founder profile lives here rather than on a page of its own, so the
         whole story sits on the home page in one scroll. --}}
    <section class="py-24">
        <div class="container-x">
            <x-section-heading center
                :eyebrow="__('messages.founder.eyebrow')"
                :title="__('messages.founder.page_title')"
                :text="__('messages.founder.page_subtitle')" />

            <div class="mt-14 grid items-start gap-12 lg:grid-cols-12">
                {{-- Portrait + personal details --}}
                <div data-reveal class="relative min-w-0 lg:col-span-5">
                    <div class="relative overflow-hidden rounded-[2rem] shadow-soft">
                        <img src="{{ asset_v('images/founder-portrait.jpg') }}"
                             alt="{{ __('messages.founder.name') }}" loading="lazy"
                             class="aspect-[4/5] w-full object-cover object-top">
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-brand-maroon-dark/90 to-transparent p-6 pt-16 text-white">
                            <h3 class="font-display text-2xl">{{ __('messages.founder.name') }}</h3>
                            <p class="mt-1 text-sm text-brand-gold-light">{{ __('messages.founder.role') }}</p>
                        </div>
                    </div>
                    <div class="absolute -left-4 -top-4 -z-10 h-40 w-40 rounded-full bg-brand-gold/20 blur-2xl"></div>

                    <div class="mt-8 rounded-2xl border border-brand-ink/8 bg-white p-6">
                        <h4 class="font-display text-lg text-brand-ink">{{ __('messages.founder.personal_title') }}</h4>
                        <dl class="mt-4 space-y-3 text-sm">
                            @foreach(__('messages.founder.personal') as $row)
                                <div class="flex flex-col gap-0.5 border-b border-brand-ink/5 pb-3 last:border-0 last:pb-0 sm:flex-row sm:gap-4">
                                    <dt class="w-36 shrink-0 font-semibold text-brand-ink/50">{{ $row['label'] }}</dt>
                                    <dd class="text-brand-ink/80">{{ $row['value'] }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>
                </div>

                {{-- Summary, education, experience, awards --}}
                <div class="min-w-0 lg:col-span-7">
                    <p class="text-lg leading-relaxed text-brand-ink/70">{{ __('messages.founder.summary') }}</p>

                    <div class="mt-9 grid gap-6 sm:grid-cols-2">
                        <div data-reveal class="rounded-2xl border border-brand-ink/8 bg-white p-6">
                            <div class="grid h-11 w-11 place-items-center rounded-xl bg-brand-gold-soft text-brand-maroon">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4L2 9l10 5 10-5-10-5z"/><path stroke-linecap="round" d="M6 11.5V16c0 1.1 2.7 2.5 6 2.5s6-1.4 6-2.5v-4.5"/></svg>
                            </div>
                            <h4 class="mt-4 font-display text-lg text-brand-ink">{{ __('messages.founder.education_title') }}</h4>
                            <ul class="mt-4 space-y-4">
                                @foreach(__('messages.founder.education') as $item)
                                    <li>
                                        <span class="text-xs font-semibold uppercase tracking-widest text-brand-gold">{{ $item['year'] }}</span>
                                        <p class="mt-0.5 text-sm leading-relaxed text-brand-ink/75">{{ $item['title'] }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div data-reveal class="rounded-2xl border border-brand-ink/8 bg-white p-6">
                            <div class="grid h-11 w-11 place-items-center rounded-xl bg-brand-gold-soft text-brand-maroon">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="7" width="18" height="13" rx="2"/><path stroke-linecap="round" d="M9 7V5a2 2 0 012-2h2a2 2 0 012 2v2"/></svg>
                            </div>
                            <h4 class="mt-4 font-display text-lg text-brand-ink">{{ __('messages.founder.experience_title') }}</h4>
                            <ul class="mt-4 space-y-4">
                                @foreach(__('messages.founder.experience') as $item)
                                    <li>
                                        <p class="font-semibold text-brand-ink">{{ $item['role'] }}</p>
                                        <p class="mt-0.5 text-sm leading-relaxed text-brand-ink/60">{{ $item['org'] }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="mt-6 grid gap-6 sm:grid-cols-2">
                        @foreach(__('messages.founder.awards') as $award)
                            <div data-reveal class="relative overflow-hidden rounded-2xl bg-maroon-gradient p-6 text-white">
                                <div class="absolute -right-8 -top-8 h-28 w-28 rounded-full bg-brand-gold/15 blur-2xl"></div>
                                <svg class="h-8 w-8 text-brand-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="9" r="5"/><path stroke-linecap="round" stroke-linejoin="round" d="M8.5 13.5L7 21l5-2.5L17 21l-1.5-7.5"/></svg>
                                <h4 class="mt-4 font-display text-xl text-brand-gold-light">{{ $award['title'] }}</h4>
                                <p class="mt-2 text-sm leading-relaxed text-white/80">{{ $award['text'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Exhibitions, participations and camps --}}
            @php
                $founderLists = [
                    ['title' => __('messages.founder.exhibitions_title'), 'items' => __('messages.founder.exhibitions')],
                    ['title' => __('messages.founder.participations_title'), 'items' => __('messages.founder.participations')],
                    ['title' => __('messages.founder.camps_title'), 'items' => __('messages.founder.camps')],
                ];
            @endphp
            <div class="mt-16 grid gap-7 lg:grid-cols-3">
                @foreach($founderLists as $i => $list)
                    <div data-reveal data-reveal-delay="{{ $i * 70 }}"
                         class="rounded-2xl border border-brand-ink/8 bg-brand-cream p-7">
                        <h4 class="font-display text-xl text-brand-maroon">{{ $list['title'] }}</h4>
                        <span class="mt-3 block h-0.5 w-12 rounded-full bg-gold-gradient"></span>
                        <ul class="mt-5 space-y-3.5">
                            @foreach($list['items'] as $item)
                                <li class="flex items-start gap-3 text-sm leading-relaxed text-brand-ink/75">
                                    <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-brand-gold"></span>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ GALLERY STRIP ============ --}}
    @if($gallery->count())
        <section class="overflow-hidden bg-brand-ink py-24 text-white">
            <div class="container-x">
                <x-section-heading light
                    :eyebrow="__('messages.home.gallery_eyebrow')"
                    :title="__('messages.home.gallery_title')"
                    :text="__('messages.home.gallery_text')" />
            </div>
            <div class="container-x mt-14 grid gap-4 sm:grid-cols-3">
                @foreach($gallery as $img)
                    <a href="{{ route('gallery') }}" data-reveal
                       class="group relative aspect-[4/3] overflow-hidden rounded-2xl">
                        <img src="{{ media_url($img->image) }}" alt="{{ $img->title }}" loading="lazy"
                             class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-brand-maroon-dark/0 transition group-hover:bg-brand-maroon-dark/40"></div>
                        <div class="absolute inset-0 flex items-end p-4 opacity-0 transition group-hover:opacity-100">
                            <span class="text-sm font-semibold">{{ $img->title }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="container-x mt-12 text-center">
                <a href="{{ route('gallery') }}" class="btn-gold">{{ __('messages.view_all') }}</a>
            </div>
        </section>
    @endif

    {{-- ============ CTA ============ --}}
    <section class="py-24">
        <div class="container-x">
            <div data-reveal class="relative overflow-hidden rounded-[2.5rem] bg-maroon-gradient px-8 py-16 text-center shadow-soft sm:px-16 sm:py-20">
                <div class="absolute inset-0 bg-grid opacity-10"></div>
                <div class="absolute -left-16 -top-16 h-56 w-56 rounded-full bg-brand-gold/15 blur-3xl"></div>
                <div class="absolute -bottom-16 -right-16 h-56 w-56 rounded-full bg-brand-gold/10 blur-3xl"></div>
                <div class="relative mx-auto max-w-2xl">
                    <span class="divider-dot mb-6">&#10022;</span>
                    <h2 class="font-display text-3xl text-white sm:text-5xl">{{ __('messages.home.cta_title') }}</h2>
                    <p class="mx-auto mt-5 max-w-xl text-lg text-white/80">{{ __('messages.home.cta_text') }}</p>
                    <div class="mt-9 flex flex-wrap justify-center gap-4">
                        <a href="{{ route('contact') }}" class="btn-gold">{{ __('messages.enquire_now') }}</a>
                        <a href="{{ route('centers.index') }}" class="btn-ghost-light">{{ __('messages.explore_centers') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
