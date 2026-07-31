<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Contact
            ['general', 'site_tagline', 'Let’s Nurture Creativity... Let Talent Blossom!'],
            ['contact', 'contact_email', 'pandavarakallu@gmail.com'],
            ['contact', 'contact_phone', '+91 94830 24279'],
            ['contact', 'contact_whatsapp', '+91 94830 24279'],
            ['contact', 'contact_address', 'Shree Narayana Guru School of Art, Temple Road, Mangaluru, Karnataka 575001'],
            ['contact', 'contact_hours', 'Classes run every day of the week — see the centre timings'],
            ['contact', 'contact_person_name', 'Mr. Suresh K. Pandavarakallu'],
            ['contact', 'contact_person_role', 'Founder & Director'],
            ['contact', 'map_embed', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.0!2d74.856!3d12.914!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTLCsDU0JzUwLjQiTiA3NMKwNTEnMjEuNiJF!5e0!3m2!1sen!2sin!4v1600000000000'],

            // Social
            ['social', 'social_facebook', 'https://www.facebook.com/shreenarayanaguruschoolofart'],
            ['social', 'social_instagram', 'https://instagram.com/'],
            ['social', 'social_youtube', 'https://youtube.com/'],
            ['social', 'social_whatsapp', 'https://wa.me/919483024279'],

            // SEO defaults
            ['seo', 'meta_title', 'Shree Narayana Guru School of Art'],
            ['seo', 'meta_description', 'A hobby art training institution in Mangaluru, open to children, youth and adults regardless of caste, religion, creed, language, gender or social background. Drawing and painting classes, creative skill development, competitions and exhibitions — enquire on WhatsApp.'],

            ['seo', 'og_image', null],

            // Stats (shown on the homepage counters)
            ['stats', 'stat_students', '1200'],
            ['stats', 'stat_years', '7'],
            ['stats', 'stat_centers', '10'],
            ['stats', 'stat_awards', '45'],
        ];

        foreach ($settings as [$group, $key, $value]) {
            Setting::query()->updateOrCreate(['key' => $key], ['value' => $value, 'group' => $group]);
        }
    }
}
