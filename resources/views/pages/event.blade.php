@php
    $schema = [
        \App\Support\StructuredData::event($event),
        \App\Support\StructuredData::breadcrumbs([
            __('messages.nav.home') => route('home'),
            __('messages.nav.events') => route('events.index'),
            $event->title => route('events.show', $event->slug),
        ]),
    ];
@endphp
<x-layouts.app :title="$event->title" :description="$event->excerpt" :image="$event->image" og-type="article" :schema="$schema">
    <x-page-hero
        :title="$event->title"
        :subtitle="$event->excerpt"
        :eyebrow="__('messages.events.eyebrow')"
        :image="$event->image" />

    <section class="py-20">
        <div class="container-x grid gap-12 lg:grid-cols-12">
            {{-- Details --}}
            <div class="lg:col-span-7">
                <x-section-heading :title="__('messages.events.details')" />

                @if($event->body)
                    <div class="prose-heritage mt-8">{!! $event->body !!}</div>
                @endif

                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="{{ route('contact') }}" class="btn-gold">{{ __('messages.enquire_now') }}</a>
                    <a href="{{ route('events.index') }}" class="btn-outline">
                        {{ __('messages.back_to', ['page' => __('messages.nav.events')]) }}
                    </a>
                </div>
            </div>

            {{-- Poster + key facts --}}
            <aside class="lg:col-span-5">
                @if($event->image)
                    <figure x-data="{ zoom: false }">
                        <img src="{{ media_url($event->image) }}" alt="{{ $event->title }}"
                             @click="zoom = true"
                             class="w-full cursor-zoom-in rounded-2xl shadow-soft ring-1 ring-black/5">
                        <figcaption class="mt-3 text-center text-xs uppercase tracking-[0.18em] text-brand-ink/45">
                            {{ __('messages.events.poster') }}
                        </figcaption>

                        <div x-show="zoom" x-cloak x-transition @click="zoom = false" @keydown.escape.window="zoom = false"
                             class="fixed inset-0 z-[60] flex items-center justify-center bg-brand-ink/90 p-6 backdrop-blur">
                            <img src="{{ media_url($event->image) }}" alt="" class="max-h-[88vh] max-w-full rounded-2xl shadow-2xl">
                        </div>
                    </figure>
                @endif

                <dl class="mt-8 space-y-5 rounded-2xl bg-brand-gold-soft p-7 ring-1 ring-brand-gold/20">
                    @if($event->starts_at)
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-[0.18em] text-brand-maroon">{{ __('messages.events.closing_date') }}</dt>
                            <dd class="mt-1 font-display text-2xl text-brand-ink">{{ $event->starts_at->translatedFormat('j F Y') }}</dd>
                        </div>
                    @endif

                    @if($event->location)
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-[0.18em] text-brand-maroon">{{ __('messages.events.send_to') }}</dt>
                            <dd class="mt-1 whitespace-pre-line text-sm leading-relaxed text-brand-ink/75">{{ $event->location }}</dd>
                        </div>
                    @endif

                    @if($settings['contact_phone'] ?? null)
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-[0.18em] text-brand-maroon">{{ __('messages.events.call_us') }}</dt>
                            <dd class="mt-1 text-sm text-brand-ink/75">
                                <a href="tel:{{ preg_replace('/\s+/', '', $settings['contact_phone']) }}" class="font-semibold text-brand-maroon hover:underline">
                                    {{ $settings['contact_phone'] }}
                                </a>
                            </dd>
                        </div>
                    @endif
                </dl>
            </aside>
        </div>
    </section>

    @if($related->isNotEmpty())
        <section class="pb-20">
            <div class="container-x">
                <x-section-heading :title="__('messages.events.related')" />
                <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($related as $item)
                        @include('partials.event-card', ['event' => $item])
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>
