@props(['center'])

<article data-reveal class="card group flex flex-col">
    @if($center->image)
        <div class="relative block aspect-[4/3] overflow-hidden">
            <img src="{{ media_url($center->image) }}" alt="{{ $center->name }}"
                 loading="lazy"
                 class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-brand-maroon-dark/70 via-transparent to-transparent"></div>
            <div class="absolute left-4 top-4 grid h-11 w-11 place-items-center rounded-2xl bg-white/95 text-brand-maroon shadow-lg">
                <x-art-icon :name="$center->icon ?? 'palette'" />
            </div>
            @if($center->day_label)
                <span class="absolute bottom-4 left-4 chip !bg-white/95">{{ $center->schedule_label }}</span>
            @endif
        </div>
    @endif

    <div class="flex flex-1 flex-col p-6">
        @unless($center->image)
            <div class="mb-4 flex items-center justify-between">
                <div class="grid h-11 w-11 place-items-center rounded-2xl bg-brand-gold-soft text-brand-maroon">
                    <x-art-icon :name="$center->icon ?? 'palette'" />
                </div>
                @if($center->day_label)
                    <span class="chip">{{ $center->schedule_label }}</span>
                @endif
            </div>
        @endunless

        {{-- Location --}}
        <h3 class="flex items-start gap-2 font-display text-xl text-brand-ink">
            <svg class="mt-1 h-5 w-5 shrink-0 text-brand-maroon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s7-5.5 7-11a7 7 0 10-14 0c0 5.5 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/>
            </svg>
            <span>{{ $center->name }}</span>
        </h3>

        {{-- Venue --}}
        @if($center->venue)
            <p class="mt-2 text-sm leading-relaxed text-brand-ink/65">{{ $center->venue }}</p>
        @endif
        @if($center->notes)
            <p class="text-sm leading-relaxed text-brand-ink/55">{{ $center->notes }}</p>
        @endif

        {{-- Schedule --}}
        {{-- The day already appears on the chip above, so only the time repeats here. --}}
        <dl class="mt-5 flex-1 space-y-2 text-sm">
            @if($center->time_label)
                <div class="flex items-center gap-2 font-semibold text-brand-maroon">
                    <svg class="h-4 w-4 shrink-0 text-brand-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <circle cx="12" cy="12" r="9"/><path stroke-linecap="round" d="M12 7v5l3 2"/>
                    </svg>
                    <dd>{{ $center->time_label }}</dd>
                </div>
            @endif
        </dl>

        <div class="mt-5 flex items-center justify-between border-t border-brand-ink/10 pt-4 text-xs text-brand-ink/60">
            @if($center->map_url)
                <a href="{{ $center->map_url }}" target="_blank" rel="noopener"
                   class="inline-flex items-center gap-1.5 font-semibold text-brand-ink/70 transition hover:text-brand-maroon">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-6 2V6l6-2m0 16l6 2m-6-2V4m6 18l6-2V4l-6 2m0 14V6"/></svg>
                    {{ __('messages.centers.directions') }}
                </a>
            @else
                <span></span>
            @endif

            <a href="{{ route('contact') }}?centre={{ urlencode($center->name) }}"
               class="inline-flex items-center gap-1 font-semibold text-brand-maroon transition group-hover:gap-2">
                {{ __('messages.enquire_now') }}
                <svg class="h-4 w-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
        </div>
    </div>
</article>
