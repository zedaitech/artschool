@php
    $donation = config('donation');

    // Bank rows: label + value, plus whether the value is worth a copy button
    // (long strings people retype by hand — account number, IFSC, UPI ID).
    $bankRows = [
        ['label' => __('messages.donate.account_name'), 'value' => $donation['account_name'], 'copy' => false],
        ['label' => __('messages.donate.account_number'), 'value' => $donation['account_number'], 'copy' => true],
        ['label' => __('messages.donate.account_type'), 'value' => $donation['account_type'], 'copy' => false],
        ['label' => __('messages.donate.bank'), 'value' => $donation['bank'], 'copy' => false],
        ['label' => __('messages.donate.branch'), 'value' => $donation['branch'], 'copy' => false],
        ['label' => __('messages.donate.ifsc'), 'value' => $donation['ifsc'], 'copy' => true],
    ];
@endphp

<section id="donate" class="scroll-mt-28 bg-brand-cream py-20">
    <div class="container-x">
        <x-section-heading
            :eyebrow="__('messages.donate.eyebrow')"
            :title="__('messages.donate.title')"
            :text="__('messages.donate.text')" center />

        <div x-data="{ copied: null, copy(text, key) { navigator.clipboard.writeText(text).then(() => { this.copied = key; setTimeout(() => this.copied = null, 2000) }) } }"
             class="mt-12 grid gap-8 lg:grid-cols-12">

            {{-- Bank details --}}
            <div data-reveal class="min-w-0 rounded-3xl border border-brand-ink/8 bg-white p-8 shadow-soft lg:col-span-7">
                <div class="flex items-center gap-3">
                    <div class="grid h-11 w-11 shrink-0 place-items-center rounded-xl bg-brand-gold-soft text-brand-maroon">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M4 10h16M5 10l7-5 7 5M6 10v7m4-7v7m4-7v7m4-7v7M4 20h16"/></svg>
                    </div>
                    <h3 class="font-display text-2xl text-brand-ink">{{ __('messages.donate.bank_title') }}</h3>
                </div>

                <dl class="mt-6 divide-y divide-brand-ink/8">
                    @foreach($bankRows as $i => $row)
                        <div class="flex flex-wrap items-center justify-between gap-x-6 gap-y-1 py-3.5">
                            <dt class="text-xs font-semibold uppercase tracking-wide text-brand-ink/50">{{ $row['label'] }}</dt>
                            <dd class="flex min-w-0 items-center gap-2 text-sm font-semibold text-brand-ink/85 sm:text-base">
                                <span class="break-all">{{ $row['value'] }}</span>
                                @if($row['copy'])
                                    <button type="button" @click="copy('{{ $row['value'] }}', {{ $i }})"
                                            class="grid h-8 w-8 shrink-0 place-items-center rounded-lg bg-brand-gold-soft text-brand-maroon transition hover:bg-brand-maroon hover:text-white"
                                            :aria-label="copied === {{ $i }} ? '{{ __('messages.donate.copied') }}' : '{{ __('messages.donate.copy') }}'">
                                        <svg x-show="copied !== {{ $i }}" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="9" y="9" width="11" height="11" rx="2"/><path d="M5 15V6a2 2 0 012-2h8"/></svg>
                                        <svg x-show="copied === {{ $i }}" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </button>
                                @endif
                            </dd>
                        </div>
                    @endforeach
                </dl>

                <p data-reveal class="mt-6 rounded-2xl bg-brand-gold-soft/60 p-4 text-sm leading-relaxed text-brand-ink/75">
                    {{ __('messages.donate.thanks') }}
                </p>

                {{-- Registration mark — reassurance for anyone about to transfer money. --}}
                <div class="mt-6 flex items-center gap-3 border-t border-brand-ink/8 pt-5">
                    <img src="{{ asset_v('images/msme-registered.jpg') }}" alt="{{ __('messages.msme.label') }}" loading="lazy"
                         class="h-12 w-auto shrink-0">
                    <p class="text-xs font-medium leading-relaxed text-brand-ink/55">{{ __('messages.msme.label') }}</p>
                </div>
            </div>

            {{-- UPI --}}
            <div data-reveal class="min-w-0 rounded-3xl bg-maroon-gradient p-8 text-white shadow-soft lg:col-span-5">
                <h3 class="font-display text-2xl">{{ __('messages.donate.upi_title') }}</h3>
                <p class="mt-2 text-sm leading-relaxed text-white/70">{{ __('messages.donate.upi_note') }}</p>

                <img src="{{ asset_v($donation['qr']) }}" alt="{{ __('messages.donate.qr_alt') }}" loading="lazy"
                     class="mx-auto mt-6 w-full max-w-[280px] rounded-2xl bg-white/95 p-2 shadow-lg">

                <div class="mt-6 rounded-2xl bg-white/10 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-brand-gold-light">{{ __('messages.donate.upi_id') }}</p>
                    <div class="mt-1.5 flex items-center justify-between gap-3">
                        <span class="break-all font-semibold">{{ $donation['upi_id'] }}</span>
                        <button type="button" @click="copy('{{ $donation['upi_id'] }}', 'upi')"
                                class="inline-flex min-h-[36px] shrink-0 items-center gap-1.5 rounded-lg bg-white/15 px-3 text-xs font-semibold transition hover:bg-white/25">
                            <svg x-show="copied !== 'upi'" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="9" y="9" width="11" height="11" rx="2"/><path d="M5 15V6a2 2 0 012-2h8"/></svg>
                            <svg x-show="copied === 'upi'" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span x-text="copied === 'upi' ? '{{ __('messages.donate.copied') }}' : '{{ __('messages.donate.copy') }}'"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
