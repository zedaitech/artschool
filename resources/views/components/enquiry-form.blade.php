{{-- `placeLabel` swaps the centre dropdown for a free-text box: a franchise
     enquirer is naming a town we do not teach in yet, not picking an existing
     centre. Both write to the same `training_center` field. --}}
@props(['type' => 'contact', 'centers' => null, 'selectedCenter' => null, 'submitLabel' => null, 'placeLabel' => null])

@php
    $waIntros = [
        'admission' => 'messages.whatsapp.admission_intro',
        'franchise' => 'messages.whatsapp.franchise_intro',
    ];

    // Labels are baked in here so the WhatsApp message the visitor sends is
    // written in the language they are browsing the site in.
    $waLabels = [
        'intro' => __($waIntros[$type] ?? 'messages.whatsapp.enquiry_intro'),
        'name' => __('messages.contact.name'),
        'phone' => __('messages.contact.phone'),
        'email' => __('messages.contact.email'),
        'center' => $placeLabel ?? __('messages.contact.center'),
        'message' => __('messages.contact.message'),
    ];
@endphp

<form action="{{ route('contact.store') }}" method="POST" class="space-y-5"
      x-data="{
          labels: @js($waLabels),
          number: @js(whatsapp_number()),
          openWhatsApp() {
              const get = (n) => (this.$el.querySelector(`[name='${n}']`)?.value || '').trim();
              const lines = [this.labels.intro, ''];
              const add = (label, value) => { if (value) lines.push(`${label}: ${value}`); };
              add(this.labels.name, get('name'));
              add(this.labels.phone, get('phone'));
              add(this.labels.email, get('email'));
              add(this.labels.center, get('training_center'));
              const msg = get('message');
              if (msg) { lines.push('', `${this.labels.message}: ${msg}`); }
              window.open(`https://wa.me/${this.number}?text=${encodeURIComponent(lines.join('\n'))}`, '_blank');
          },
      }">
    @csrf
    <input type="hidden" name="type" value="{{ $type }}">
    {{-- Honeypot --}}
    <input type="text" name="website" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true">

    <div class="grid gap-5 sm:grid-cols-2">
        <div>
            <label for="ef-name" class="mb-1.5 block text-sm font-semibold text-brand-ink/80">{{ __('messages.contact.name') }} <span class="text-brand-maroon">*</span></label>
            <input id="ef-name" name="name" type="text" required value="{{ old('name') }}"
                   class="w-full rounded-xl border-brand-ink/15 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-brand-maroon focus:ring-brand-maroon/30">
            @error('name')<p class="mt-1 text-xs text-brand-maroon">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="ef-phone" class="mb-1.5 block text-sm font-semibold text-brand-ink/80">{{ __('messages.contact.phone') }} <span class="text-brand-maroon">*</span></label>
            <input id="ef-phone" name="phone" type="tel" required value="{{ old('phone') }}"
                   class="w-full rounded-xl border-brand-ink/15 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-brand-maroon focus:ring-brand-maroon/30">
            @error('phone')<p class="mt-1 text-xs text-brand-maroon">{{ $message }}</p>@enderror
        </div>
    </div>

    <div>
        <label for="ef-email" class="mb-1.5 block text-sm font-semibold text-brand-ink/80">{{ __('messages.contact.email') }}</label>
        <input id="ef-email" name="email" type="email" value="{{ old('email') }}"
               class="w-full rounded-xl border-brand-ink/15 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-brand-maroon focus:ring-brand-maroon/30">
        @error('email')<p class="mt-1 text-xs text-brand-maroon">{{ $message }}</p>@enderror
    </div>

    @if($placeLabel)
        <div>
            <label for="ef-place" class="mb-1.5 block text-sm font-semibold text-brand-ink/80">{{ $placeLabel }}</label>
            <input id="ef-place" name="training_center" type="text" value="{{ old('training_center') }}"
                   class="w-full rounded-xl border-brand-ink/15 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-brand-maroon focus:ring-brand-maroon/30">
            @error('training_center')<p class="mt-1 text-xs text-brand-maroon">{{ $message }}</p>@enderror
        </div>
    @elseif($centers && $centers->count())
        <div>
            <label for="ef-center" class="mb-1.5 block text-sm font-semibold text-brand-ink/80">{{ __('messages.contact.center') }}</label>
            <select id="ef-center" name="training_center"
                    class="w-full rounded-xl border-brand-ink/15 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-brand-maroon focus:ring-brand-maroon/30">
                <option value="">{{ __('messages.contact.select_center') }}</option>
                @foreach($centers as $c)
                    <option value="{{ $c->name }}" @selected(old('training_center', $selectedCenter) === $c->name)>{{ $c->name }}@if($c->day_label) &mdash; {{ $c->schedule_label }}@endif</option>
                @endforeach
            </select>
        </div>
    @endif

    <div>
        <label for="ef-message" class="mb-1.5 block text-sm font-semibold text-brand-ink/80">{{ __('messages.contact.message') }}</label>
        <textarea id="ef-message" name="message" rows="4"
                  class="w-full rounded-xl border-brand-ink/15 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-brand-maroon focus:ring-brand-maroon/30">{{ old('message') }}</textarea>
    </div>

    <button type="submit" class="btn-primary w-full">
        {{ $submitLabel ?? __('messages.contact.send') }}
        <svg class="h-4 w-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M5 12h14M13 6l6 6-6 6"/></svg>
    </button>

    @if(whatsapp_number())
        {{-- Straight to WhatsApp, for visitors who would rather chat than fill in a form. --}}
        <button type="button" @click="openWhatsApp()"
                class="flex w-full items-center justify-center gap-2 rounded-xl bg-brand-green px-5 py-3.5 text-sm font-semibold text-white shadow-sm transition hover:brightness-110">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3.5A8.5 8.5 0 004.6 16.2L3.5 20.5l4.4-1.1A8.5 8.5 0 1012 3.5zm0 15.3a6.8 6.8 0 01-3.5-.95l-.25-.15-2.6.68.7-2.53-.16-.26A6.8 6.8 0 1112 18.8zm3.7-5.1c-.2-.1-1.2-.6-1.4-.65s-.32-.1-.46.1-.53.65-.64.78-.23.15-.43.05a5.6 5.6 0 01-1.64-1 6.2 6.2 0 01-1.14-1.42c-.12-.2 0-.32.09-.42s.2-.23.3-.35a1.4 1.4 0 00.2-.33.37.37 0 000-.35c0-.1-.46-1.1-.63-1.5s-.33-.34-.46-.34h-.4a.76.76 0 00-.55.26 2.3 2.3 0 00-.72 1.7 4 4 0 00.84 2.12 9.1 9.1 0 003.5 3.1c.49.2.87.33 1.17.43a2.8 2.8 0 001.3.08 2.1 2.1 0 001.4-1 1.7 1.7 0 00.12-1c-.05-.08-.18-.13-.38-.23z"/></svg>
            {{ __('messages.contact.send_whatsapp') }}
        </button>
        <p class="text-center text-xs text-brand-ink/50">{{ __('messages.contact.whatsapp_note') }}</p>
    @endif
</form>
