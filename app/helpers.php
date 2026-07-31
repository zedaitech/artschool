<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (! function_exists('media_url')) {
    /**
     * Resolve an image reference to a usable URL. Seeded content uses absolute
     * URLs (Unsplash); admin-uploaded content stores a path on the public disk.
     * A single helper handles both so views stay clean.
     */
    function media_url(?string $path, ?string $fallback = null): ?string
    {
        if (blank($path)) {
            return $fallback;
        }

        if (Str::startsWith($path, ['http://', 'https://', '//', '/'])) {
            return $path;
        }

        return Storage::disk('public')->url($path);
    }
}

if (! function_exists('whatsapp_number')) {
    /**
     * The school's WhatsApp number in wa.me form: digits only, country code
     * included. Admins type it however they like (+91 94830 24279, spaces,
     * dashes); this normalises it and assumes India when no code is given.
     */
    function whatsapp_number(): ?string
    {
        $raw = Setting::map()['contact_whatsapp'] ?? null;

        if (blank($raw)) {
            return null;
        }

        $digits = preg_replace('/\D+/', '', $raw);

        if (blank($digits)) {
            return null;
        }

        // A bare 10-digit Indian mobile needs the 91 country code prefixed.
        return strlen($digits) === 10 ? '91'.$digits : $digits;
    }
}

if (! function_exists('whatsapp_url')) {
    /**
     * A click-to-chat link that opens WhatsApp with the message pre-filled,
     * so every enquiry lands in the school's WhatsApp inbox.
     */
    function whatsapp_url(?string $text = null): ?string
    {
        $number = whatsapp_number();

        if (! $number) {
            return null;
        }

        return 'https://wa.me/'.$number.($text ? '?text='.rawurlencode($text) : '');
    }
}
