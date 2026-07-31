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
        'excerpt',
        'body',
        'location',
        'starts_at',
        'ends_at',
        'image',
        'is_featured',
        'is_published',
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

    /**
     * An event stays open until the end of its closing date, so a competition
     * closing today is still shown as accepting entries.
     */
    public function isOpen(): bool
    {
        $closes = $this->ends_at ?? $this->starts_at;

        return $closes === null || $closes->endOfDay()->isFuture();
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
