@php
    $schema = [
        \App\Support\StructuredData::centerList($centers),
        \App\Support\StructuredData::breadcrumbs([
            __('messages.nav.home') => route('home'),
            __('messages.nav.centers') => route('centers.index'),
        ]),
    ];
@endphp
<x-layouts.app :title="__('messages.nav.centers')" :description="__('messages.centers.text')" :schema="$schema">
    <x-page-hero
        :title="__('messages.centers.title')"
        :subtitle="__('messages.centers.text')"
        :eyebrow="__('messages.centers.eyebrow')"
        :image="asset('images/hero/students-drawing-lineup.jpg')" />

    <section class="py-20">
        <div class="container-x">
            @if($centers->count())
                <p class="mb-10 text-center text-sm font-semibold uppercase tracking-[0.18em] text-brand-ink/50">
                    {{ __('messages.centers.count', ['count' => $centers->count()]) }}
                </p>

                <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($centers as $center)
                        <x-center-card :center="$center" />
                    @endforeach
                </div>
            @else
                <p class="py-20 text-center text-brand-ink/50">{{ __('messages.centers.none') }}</p>
            @endif
        </div>
    </section>

    {{-- Weekly timetable --}}
    @if($centers->count())
        <section class="bg-white py-20">
            <div class="container-x">
                <x-section-heading center
                    :eyebrow="__('messages.centers.eyebrow')"
                    :title="__('messages.centers.timetable')" />

                <div class="mt-12 overflow-hidden rounded-3xl border border-brand-ink/10 shadow-soft">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[640px] text-left text-sm">
                            <thead class="bg-brand-maroon text-white">
                                <tr>
                                    <th class="px-6 py-4 font-semibold">{{ __('messages.centers.day') }}</th>
                                    <th class="px-6 py-4 font-semibold">{{ __('messages.nav.centers') }}</th>
                                    <th class="px-6 py-4 font-semibold">{{ __('messages.centers.venue') }}</th>
                                    <th class="px-6 py-4 font-semibold">{{ __('messages.centers.timing') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-brand-ink/8">
                                @foreach($byDay as $day => $group)
                                    @foreach($group as $i => $center)
                                        <tr class="bg-white transition hover:bg-brand-cream/60">
                                            @if($i === 0)
                                                <td rowspan="{{ $group->count() }}" class="border-e border-brand-ink/8 bg-brand-cream/40 px-6 py-4 align-top font-display text-base text-brand-maroon">
                                                    {{ __('messages.days.'.$day) }}
                                                </td>
                                            @endif
                                            <td class="px-6 py-4 font-semibold text-brand-ink">{{ $center->name }}</td>
                                            <td class="px-6 py-4 text-brand-ink/70">
                                                {{ $center->venue }}
                                                @if($center->notes)
                                                    <span class="block text-brand-ink/50">{{ $center->notes }}</span>
                                                @endif
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 font-medium text-brand-maroon">{{ $center->time_label }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <x-cta-band />
</x-layouts.app>
