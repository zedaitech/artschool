<?php

namespace App\Support;

use App\Models\Event;
use App\Models\Setting;
use App\Models\TrainingCenter;
use Illuminate\Support\Collection;

/**
 * Builds the JSON-LD graphs the site publishes. Everything is derived from the
 * same admin-managed content the pages render, so the markup can never drift
 * from what a visitor actually sees.
 */
class StructuredData
{
    /** Weekday keys mapped to the schema.org DayOfWeek URLs. */
    protected const DAYS = [
        'monday' => 'https://schema.org/Monday',
        'tuesday' => 'https://schema.org/Tuesday',
        'wednesday' => 'https://schema.org/Wednesday',
        'thursday' => 'https://schema.org/Thursday',
        'friday' => 'https://schema.org/Friday',
        'saturday' => 'https://schema.org/Saturday',
        'sunday' => 'https://schema.org/Sunday',
    ];

    /**
     * The school itself. Referenced by @id from every other node so search
     * engines treat the pages as one organisation rather than many.
     */
    public static function school(): array
    {
        $settings = Setting::map();

        $node = array_filter([
            '@type' => 'EducationalOrganization',
            '@id' => url('/').'#organization',
            'name' => __('messages.school_name'),
            'alternateName' => __('messages.school_short'),
            'description' => $settings['meta_description'] ?? __('messages.footer.about'),
            'url' => url('/'),
            'logo' => asset('images/logo.png'),
            'image' => asset('images/logo.png'),
            'email' => $settings['contact_email'] ?? null,
            'telephone' => $settings['contact_phone'] ?? null,
            'foundingDate' => '2018',
            'slogan' => $settings['site_tagline'] ?? __('messages.tagline'),
        ]);

        if ($address = $settings['contact_address'] ?? null) {
            $node['address'] = [
                '@type' => 'PostalAddress',
                'streetAddress' => trim(preg_replace('/\s+/', ' ', $address)),
                'addressLocality' => 'Mangaluru',
                'addressRegion' => 'Karnataka',
                'addressCountry' => 'IN',
            ];
        }

        if ($socials = self::socialProfiles($settings)) {
            $node['sameAs'] = $socials;
        }

        if ($name = $settings['contact_person_name'] ?? null) {
            $node['founder'] = array_filter([
                '@type' => 'Person',
                'name' => $name,
                'jobTitle' => $settings['contact_person_role'] ?? null,
            ]);
        }

        // Each training centre is somewhere you can actually attend a class.
        $centers = TrainingCenter::query()->published()->byWeekday()->get();

        if ($centers->isNotEmpty()) {
            $node['location'] = $centers->map(fn (TrainingCenter $c) => self::center($c))->all();
        }

        return $node;
    }

    /** One weekly class venue, with its opening hours. */
    public static function center(TrainingCenter $center): array
    {
        $node = array_filter([
            '@type' => 'Place',
            'name' => trim($center->venue.' — '.$center->name, ' —'),
            'address' => array_filter([
                '@type' => 'PostalAddress',
                'streetAddress' => $center->address ? trim(preg_replace('/\s+/', ' ', $center->address)) : $center->venue,
                'addressLocality' => $center->name,
                'addressRegion' => 'Karnataka',
                'addressCountry' => 'IN',
            ]),
            'hasMap' => $center->map_url,
        ]);

        if ($center->day && $center->start_time && isset(self::DAYS[$center->day])) {
            $node['openingHoursSpecification'] = [array_filter([
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => self::DAYS[$center->day],
                'opens' => substr((string) $center->start_time, 0, 5),
                'closes' => $center->end_time ? substr((string) $center->end_time, 0, 5) : null,
            ])];
        }

        return $node;
    }

    /** The training-centres page as a list, so the venues can surface directly. */
    public static function centerList(Collection $centers): array
    {
        return [
            '@type' => 'ItemList',
            'name' => __('messages.centers.title'),
            'numberOfItems' => $centers->count(),
            'itemListElement' => $centers->values()->map(fn (TrainingCenter $c, int $i) => [
                '@type' => 'ListItem',
                'position' => $i + 1,
                'item' => self::center($c),
            ])->all(),
        ];
    }

    /** A competition, exhibition or workshop. */
    public static function event(Event $event): array
    {
        $settings = Setting::map();

        return array_filter([
            '@type' => 'Event',
            'name' => $event->title,
            'description' => $event->excerpt,
            'url' => route('events.show', $event->slug),
            'image' => $event->image ? url(media_url($event->image)) : null,
            'startDate' => $event->starts_at?->toDateString(),
            'endDate' => $event->ends_at?->toDateString() ?? $event->starts_at?->toDateString(),
            'eventStatus' => 'https://schema.org/EventScheduled',
            'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
            'organizer' => ['@id' => url('/').'#organization'],
            'location' => $event->location ? [
                '@type' => 'Place',
                'name' => __('messages.school_name'),
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => trim(preg_replace('/\s+/', ' ', $event->location)),
                    'addressCountry' => 'IN',
                ],
            ] : ['@id' => url('/').'#organization'],
            // Entry is free — worth stating, it is a selling point in results.
            'offers' => [
                '@type' => 'Offer',
                'price' => '0',
                'priceCurrency' => 'INR',
                'availability' => $event->isOpen()
                    ? 'https://schema.org/InStock'
                    : 'https://schema.org/SoldOut',
                'url' => route('events.show', $event->slug),
                'validThrough' => $event->starts_at?->toDateString(),
            ],
            'isAccessibleForFree' => true,
            'inLanguage' => app()->getLocale(),
            'telephone' => $settings['contact_phone'] ?? null,
        ]);
    }

    /**
     * Breadcrumbs matching the trail the page-hero renders.
     *
     * @param  array<string, string>  $trail  label => url
     */
    public static function breadcrumbs(array $trail): array
    {
        $position = 0;

        return [
            '@type' => 'BreadcrumbList',
            'itemListElement' => collect($trail)->map(fn (string $url, string $label) => [
                '@type' => 'ListItem',
                'position' => ++$position,
                'name' => $label,
                'item' => $url,
            ])->values()->all(),
        ];
    }

    /** Social profile URLs, in the order they appear in Site Settings. */
    protected static function socialProfiles(array $settings): array
    {
        return collect(['social_facebook', 'social_instagram', 'social_youtube'])
            ->map(fn (string $key) => $settings[$key] ?? null)
            ->filter()
            ->reject(fn (string $url) => in_array(rtrim($url, '/'), [
                'https://facebook.com', 'https://instagram.com', 'https://youtube.com',
            ], true))
            ->values()
            ->all();
    }
}
