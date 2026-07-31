<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Response;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/**
 * An XML sitemap covering every public URL in every locale, with the
 * hreflang alternates search engines need to pair the translations up.
 *
 * URLs are composed from the locale prefix plus the translated segment in
 * lang/{locale}/routes.php — the same pieces routes/web.php uses. route()
 * cannot help here: this route lives outside the localized group, so the
 * group prefix is empty while it runs and every URL would come out unprefixed.
 */
class SitemapController extends Controller
{
    /** Translation key for the URL segment => [changefreq, priority]. */
    protected const PAGES = [
        null => ['weekly', '1.0'],              // the locale root, e.g. /en
        'routes.centers' => ['weekly', '0.9'],
        'routes.events' => ['weekly', '0.8'],
        'routes.gallery' => ['monthly', '0.7'],
        'routes.contact' => ['monthly', '0.7'],
    ];

    public function __invoke(): Response
    {
        $locales = array_keys(LaravelLocalization::getSupportedLocales());
        $urls = [];

        foreach (self::PAGES as $key => [$changefreq, $priority]) {
            $urls[] = [
                'alternates' => $this->alternates($locales, fn (string $l) => $this->url($l, $key ? trans($key, [], $l) : null)),
                'changefreq' => $changefreq,
                'priority' => $priority,
                'lastmod' => null,
            ];
        }

        foreach (Event::query()->published()->orderByDesc('starts_at')->get() as $event) {
            $urls[] = [
                'alternates' => $this->alternates(
                    $locales,
                    fn (string $l) => $this->url($l, trans('routes.events', [], $l).'/'.$event->slug),
                ),
                'changefreq' => 'weekly',
                // An open competition is the page most worth crawling often.
                'priority' => $event->isOpen() ? '0.9' : '0.5',
                'lastmod' => $event->updated_at?->toAtomString(),
            ];
        }

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    protected function url(string $locale, ?string $segment): string
    {
        return url($locale.($segment ? '/'.$segment : ''));
    }

    /** @return array<string, string> locale => URL */
    protected function alternates(array $locales, callable $builder): array
    {
        $out = [];

        foreach ($locales as $locale) {
            $out[$locale] = $builder($locale);
        }

        return $out;
    }
}
