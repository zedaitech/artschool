<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\TrainingCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('pages.contact', [
            'centers' => TrainingCenter::published()->byWeekday()->get(),
        ]);
    }

    /**
     * Handles both the general contact form and the admissions enquiry form.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => ['nullable', 'in:contact,admission'],
            'name' => ['required', 'string', 'max:120'],
            'email' => ['nullable', 'email', 'max:160'],
            'phone' => ['required', 'string', 'max:40'],
            'training_center' => ['nullable', 'string', 'max:160'],
            'message' => ['nullable', 'string', 'max:3000'],
            // Honeypot: bots fill this hidden field, humans never see it.
            'website' => ['nullable', 'size:0'],
        ]);

        $enquiry = Enquiry::create([
            'type' => $data['type'] ?? 'contact',
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'],
            'training_center' => $data['training_center'] ?? null,
            'message' => $data['message'] ?? null,
        ]);

        $this->notifyAdmin($enquiry);

        // Every enquiry is also handed to WhatsApp: the visitor is sent on to a
        // chat with the message already written, so it reaches the school even
        // if e-mail is not configured.
        return back()
            ->with('enquiry_sent', true)
            ->with('whatsapp_url', whatsapp_url($this->whatsappMessage($enquiry)));
    }

    /**
     * The enquiry rendered as the WhatsApp message the visitor will send.
     */
    protected function whatsappMessage(Enquiry $enquiry): string
    {
        $lines = [
            $enquiry->type === 'admission'
                ? __('messages.whatsapp.admission_intro')
                : __('messages.whatsapp.enquiry_intro'),
            '',
            __('messages.contact.name').': '.$enquiry->name,
            __('messages.contact.phone').': '.$enquiry->phone,
        ];

        if ($enquiry->email) {
            $lines[] = __('messages.contact.email').': '.$enquiry->email;
        }

        if ($enquiry->training_center) {
            $lines[] = __('messages.contact.center').': '.$enquiry->training_center;
        }

        if ($enquiry->message) {
            $lines[] = '';
            $lines[] = __('messages.contact.message').': '.$enquiry->message;
        }

        return implode("\n", $lines);
    }

    protected function notifyAdmin(Enquiry $enquiry): void
    {
        $to = config('mail.enquiry_notify') ?: env('ENQUIRY_NOTIFY_EMAIL');

        if (! $to) {
            return;
        }

        try {
            Mail::raw(
                "New {$enquiry->type} enquiry\n\n".
                "Name: {$enquiry->name}\n".
                "Phone: {$enquiry->phone}\n".
                "Email: {$enquiry->email}\n".
                "Training centre: {$enquiry->training_center}\n\n".
                "Message:\n{$enquiry->message}",
                fn ($message) => $message->to($to)->subject('New enquiry — '.$enquiry->name),
            );
        } catch (\Throwable $e) {
            // Never let a mail failure break the visitor's submission.
            Log::warning('Enquiry notification failed: '.$e->getMessage());
        }
    }
}
