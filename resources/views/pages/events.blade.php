<x-layouts.app :title="__('messages.nav.events')">
    <x-page-hero
        :title="__('messages.events.title')"
        :subtitle="__('messages.events.subtitle')"
        :eyebrow="__('messages.events.eyebrow')"
        image="/images/hero/banner-varna-vaibhava-2026.jpg" />

    <section class="py-20">
        <div class="container-x">
            @if($upcoming->isEmpty() && $past->isEmpty())
                <p class="text-center text-lg text-brand-ink/65">{{ __('messages.events.no_upcoming') }}</p>
            @endif

            @if($upcoming->isNotEmpty())
                <x-section-heading
                    :eyebrow="__('messages.events.upcoming')"
                    :title="__('messages.events.title')" />

                <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($upcoming as $event)
                        @include('partials.event-card', ['event' => $event])
                    @endforeach
                </div>
            @endif

            @if($past->isNotEmpty())
                <div class="{{ $upcoming->isNotEmpty() ? 'mt-24' : '' }}">
                    <x-section-heading :title="__('messages.events.past')" />

                    <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($past as $event)
                            @include('partials.event-card', ['event' => $event])
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    <x-cta-band />
</x-layouts.app>
