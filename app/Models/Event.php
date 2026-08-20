<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Event extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'slug',
        'kind',
        'excerpt',
        'body',
        'location',
        'starts_at',
        'ends_at',
        'image',
        'video',
        'youtube_url',
        'is_featured',
        'is_published',
    ];

    /** Competitions take entries; announcements simply happened. */
    public const KINDS = [
        'competition' => 'Competition',
        'announcement' => 'Announcement',
    ];

    public array $translatable = [
        'title',
        'excerpt',
        'body',
        'location',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /** An announcement reports something that happened; it takes no entries. */
    public function isAnnouncement(): bool
    {
        return $this->kind === 'announcement';
    }

    /**
     * An event stays open until the end of its closing date, so a competition
     * closing today is still shown as accepting entries.
     */
    public function isOpen(): bool
    {
        $closes = $this->ends_at ?? $this->starts_at;

        return $closes === null || $closes->endOfDay()->isFuture();
    }

    /**
     * The embeddable video id from whatever YouTube link the admin pasted:
     * watch?v=, youtu.be/, shorts/, embed/ and live/ forms are all accepted.
     */
    public function youtubeId(): ?string
    {
        if (blank($this->youtube_url)) {
            return null;
        }

        if (preg_match('~(?:youtu\.be/|youtube(?:-nocookie)?\.com/(?:watch\?(?:.*&)?v=|(?:embed|shorts|live|v)/))([A-Za-z0-9_-]{11})~', $this->youtube_url, $m)) {
            return $m[1];
        }

        return null;
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->whereDate('starts_at', '>=', now()->toDateString());
    }
}
