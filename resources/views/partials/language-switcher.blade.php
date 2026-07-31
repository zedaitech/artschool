@php $locales = LaravelLocalization::getSupportedLocales(); @endphp
<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" @click.outside="open = false"
            class="flex items-center gap-1 rounded-full border border-white/30 bg-white/10 px-2.5 py-2 text-sm sm:gap-1.5 sm:px-3 font-semibold text-white backdrop-blur transition hover:border-white/60 group-[.is-scrolled]:border-brand-maroon/15 group-[.is-scrolled]:bg-white/60 group-[.is-scrolled]:text-brand-maroon group-[.is-scrolled]:hover:border-brand-maroon/40"
            aria-label="Change language">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 100-18 9 9 0 000 18zM3.6 9h16.8M3.6 15h16.8M12 3a15 15 0 010 18M12 3a15 15 0 000 18"/></svg>
        <span class="uppercase">{{ app()->getLocale() }}</span>
        <svg class="hidden h-3 w-3 opacity-60 sm:block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M6 9l6 6 6-6"/></svg>
    </button>
    <div x-show="open" x-cloak x-transition
         class="absolute {{ LaravelLocalization::getCurrentLocaleDirection() === 'rtl' ? 'left-0' : 'right-0' }} mt-2 w-44 overflow-hidden rounded-2xl border border-black/5 bg-white p-1.5 shadow-soft">
        @foreach($locales as $code => $props)
            <a href="{{ LaravelLocalization::getLocalizedURL($code, null, [], true) }}"
               hreflang="{{ $code }}"
               class="flex items-center justify-between rounded-xl px-3 py-2.5 text-sm font-medium transition {{ app()->getLocale() === $code ? 'bg-brand-gold-soft text-brand-maroon' : 'text-brand-ink/80 hover:bg-brand-cream' }}">
                <span>{{ $props['native'] }}</span>
                @if(app()->getLocale() === $code)
                    <svg class="h-4 w-4 text-brand-green" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                @endif
            </a>
        @endforeach
    </div>
</div>
