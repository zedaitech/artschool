<x-layouts.app :title="__('messages.nav.gallery')">
    <x-page-hero
        :title="__('messages.home.gallery_title')"
        :subtitle="__('messages.home.gallery_text')"
        :eyebrow="__('messages.home.gallery_eyebrow')"
        :image="asset('images/hero/students-artwork-hall.jpg')" />

    <section x-data="{ filter: 'all', lightbox: null }" class="py-20">
        <div class="container-x">
            {{-- Filters — hidden unless more than one category is in use --}}
            @if(count($categories))
                <div class="flex flex-wrap items-center justify-center gap-2.5">
                    <button @click="filter = 'all'"
                            :class="filter === 'all' ? 'bg-brand-maroon text-white' : 'bg-white text-brand-ink/70 hover:bg-brand-gold-soft'"
                            class="rounded-full px-5 py-2.5 text-sm font-semibold shadow-sm ring-1 ring-black/5 transition">
                        {{ __('messages.gallery.all') }}
                    </button>
                    @foreach($categories as $key => $label)
                        <button @click="filter = '{{ $key }}'"
                                :class="filter === '{{ $key }}' ? 'bg-brand-maroon text-white' : 'bg-white text-brand-ink/70 hover:bg-brand-gold-soft'"
                                class="rounded-full px-5 py-2.5 text-sm font-semibold shadow-sm ring-1 ring-black/5 transition">
                            {{ $label }}
                        </button>
                    @endforeach
                </div>
            @endif

            {{-- Masonry grid --}}
            <div class="columns-1 gap-4 sm:columns-2 lg:columns-3 [&>*]:mb-4 {{ count($categories) ? 'mt-12' : '' }}">
                @foreach($images as $img)
                    <figure x-show="filter === 'all' || filter === '{{ $img->category }}'"
                            x-transition
                            @click="lightbox = '{{ media_url($img->image) }}'"
                            class="group relative block cursor-zoom-in break-inside-avoid overflow-hidden rounded-2xl shadow-sm ring-1 ring-black/5">
                        <img src="{{ media_url($img->image) }}" alt="{{ $img->title }}" loading="lazy"
                             class="w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <figcaption class="absolute inset-0 flex items-end bg-gradient-to-t from-brand-maroon-dark/80 to-transparent p-4 opacity-0 transition group-hover:opacity-100">
                            <span class="text-sm font-semibold text-white">{{ $img->title }}</span>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        </div>

        {{-- Lightbox --}}
        <div x-show="lightbox" x-cloak x-transition @click="lightbox = null" @keydown.escape.window="lightbox = null"
             class="fixed inset-0 z-[60] flex items-center justify-center bg-brand-ink/90 p-6 backdrop-blur">
            <img :src="lightbox" alt="" class="max-h-[88vh] max-w-full rounded-2xl shadow-2xl">
            <button @click="lightbox = null" class="absolute right-6 top-6 grid h-11 w-11 place-items-center rounded-full bg-white/10 text-white hover:bg-white/20" aria-label="Close">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M6 6l12 12M18 6L6 18"/></svg>
            </button>
        </div>
    </section>
</x-layouts.app>
