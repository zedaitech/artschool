@if(session('enquiry_sent'))
    @php $whatsapp = session('whatsapp_url'); @endphp

    {{--
        The enquiry is saved, and then handed to WhatsApp. The chat opens
        automatically in a new tab; browsers that block that still get the
        button, so the message always has a way through.
    --}}
    <div x-data="{ show: true }" x-show="show"
         @if(! $whatsapp) x-init="setTimeout(() => show = false, 6000)" @endif
         class="fixed inset-x-0 top-24 z-50 mx-auto w-full max-w-md px-4">
        <div class="rounded-2xl border border-brand-green/20 bg-white p-4 shadow-soft">
            <div class="flex items-start gap-3">
                <div class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-brand-green/10 text-brand-green">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                </div>
                <p class="pt-1 text-sm font-medium text-brand-ink/80">{{ __('messages.contact.success') }}</p>
                <button @click="show = false" class="ml-auto text-brand-ink/40 hover:text-brand-ink">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M6 6l12 12M18 6L6 18"/></svg>
                </button>
            </div>

            @if($whatsapp)
                <p class="mt-3 text-sm leading-relaxed text-brand-ink/60">{{ __('messages.contact.whatsapp_handoff') }}</p>
                <a href="{{ $whatsapp }}" target="_blank" rel="noopener"
                   x-init="window.open($el.href, '_blank')"
                   class="mt-3 flex w-full items-center justify-center gap-2 rounded-xl bg-brand-green px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:brightness-110">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3.5A8.5 8.5 0 004.6 16.2L3.5 20.5l4.4-1.1A8.5 8.5 0 1012 3.5zm0 15.3a6.8 6.8 0 01-3.5-.95l-.25-.15-2.6.68.7-2.53-.16-.26A6.8 6.8 0 1112 18.8zm3.7-5.1c-.2-.1-1.2-.6-1.4-.65s-.32-.1-.46.1-.53.65-.64.78-.23.15-.43.05a5.6 5.6 0 01-1.64-1 6.2 6.2 0 01-1.14-1.42c-.12-.2 0-.32.09-.42s.2-.23.3-.35a1.4 1.4 0 00.2-.33.37.37 0 000-.35c0-.1-.46-1.1-.63-1.5s-.33-.34-.46-.34h-.4a.76.76 0 00-.55.26 2.3 2.3 0 00-.72 1.7 4 4 0 00.84 2.12 9.1 9.1 0 003.5 3.1c.49.2.87.33 1.17.43a2.8 2.8 0 001.3.08 2.1 2.1 0 001.4-1 1.7 1.7 0 00.12-1c-.05-.08-.18-.13-.38-.23z"/></svg>
                    {{ __('messages.contact.continue_whatsapp') }}
                </a>
            @endif
        </div>
    </div>
@endif
