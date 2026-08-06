<?php

use App\Models\Event;
use Illuminate\Database\Migrations\Migration;

/*
| Event posters and video were stored with a leading slash ("/images/…"),
| which reads as an absolute URL. The admin's upload field resolves paths
| against a disk, so it could not find them, showed an empty field, and
| blanked the column on save. Storing them relative to public/ lets the
| field see the existing file — media_url() resolves either form.
*/

return new class extends Migration
{
    /** Posters that shipped with the site, in case a row was already blanked. */
    private array $known = [
        'shree-guru-varna-vaibhava-2026' => ['images/events/varna-vaibhava-2026-poster.jpg', null],
        'official-website-launch' => ['images/events/website-launch-poster.jpg', 'videos/website-launch-sigandur.mp4'],
        'coordinators-wanted-karnataka' => ['images/events/coordinators-wanted-karnataka.jpg', null],
    ];

    public function up(): void
    {
        foreach (Event::query()->get() as $event) {
            $event->forceFill([
                'image' => $this->normalise($event->image),
                'video' => $this->normalise($event->video),
            ])->saveQuietly();
        }

        foreach ($this->known as $slug => [$image, $video]) {
            $event = Event::query()->where('slug', $slug)->first();

            if (! $event) {
                continue;
            }

            $event->forceFill(array_filter([
                'image' => $event->image ?: $image,
                'video' => $event->video ?: $video,
            ]))->saveQuietly();
        }
    }

    public function down(): void
    {
        foreach (Event::query()->get() as $event) {
            $event->forceFill([
                'image' => $event->image ? '/'.ltrim($event->image, '/') : null,
                'video' => $event->video ? '/'.ltrim($event->video, '/') : null,
            ])->saveQuietly();
        }
    }

    private function normalise(?string $path): ?string
    {
        // Leave absolute URLs and storage-disk paths alone; only the site's own
        // artwork under public/ needs the leading slash removed.
        if (blank($path) || str_starts_with($path, 'http')) {
            return $path;
        }

        return ltrim($path, '/');
    }
};
