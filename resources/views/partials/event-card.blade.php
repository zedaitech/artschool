{{-- Expects: $event --}}
@php $open = $event->isOpen(); @endphp
<article data-reveal class="card group flex flex-col overflow-hidden">
    <a href="{{ route('events.show', $event->slug) }}" class="block overflow-hidden">
        @if($event->image)
            <img src="{{ media_url($event->image) }}" alt="{{ $event->title }}" loading="lazy"
                 class="aspect-[4/3] w-full object-cover transition-transform duration-700 group-hover:scale-105">
        @else
            <div class="aspect-[4/3] w-full bg-maroon-gradient"></div>
        @endif
    </a>

    <div class="flex flex-1 flex-col p-6">
        <span class="inline-flex w-fit items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em]
                     {{ $open ? 'bg-brand-gold/15 text-brand-maroon' : 'bg-brand-ink/5 text-brand-ink/50' }}">
            {{ $open ? __('messages.events.entries_open') : __('messages.events.entries_closed') }}
        </span>

        <h3 class="mt-4 font-display text-2xl leading-tight text-brand-ink">
            <a href="{{ route('events.show', $event->slug) }}" class="transition hover:text-brand-maroon">{{ $event->title }}</a>
        </h3>

        @if($event->excerpt)
            <p class="mt-3 text-sm leading-relaxed text-brand-ink/65">{{ $event->excerpt }}</p>
        @endif

        @if($event->starts_at)
            <p class="mt-4 flex items-center gap-2 text-sm font-semibold text-brand-maroon">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 3v4M16 3v4M4 9h16M5 5h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"/></svg>
                {{ __('messages.events.closing_date') }}: {{ $event->starts_at->translatedFormat('j F Y') }}
            </p>
        @endif

        <a href="{{ route('events.show', $event->slug) }}"
           class="mt-6 inline-flex min-h-[28px] items-center gap-2 self-start text-sm font-semibold text-brand-maroon transition hover:gap-3">
            {{ __('messages.events.view_details') }}
            <svg class="h-4 w-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
    </div>
</article>
