<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\Translatable\HasTranslations;

/**
 * A weekly art class venue. Every centre runs on one day of the week at a
 * fixed time, so the schedule is stored as a day key plus start/end times
 * and rendered through the translated day names in the lang message files.
 */
class TrainingCenter extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'slug',
        'venue',
        'address',
        'notes',
        'day',
        'start_time',
        'end_time',
        'map_url',
        'contact_name',
        'contact_phone',
        'icon',
        'image',
        'sort_order',
        'is_featured',
        'is_published',
    ];

    /** Columns stored as JSON with one value per locale. */
    public array $translatable = [
        'name',
        'venue',
        'address',
        'notes',
    ];

    /** Days of the week, in schedule order. */
    public const DAYS = [
        'monday' => 'Monday',
        'tuesday' => 'Tuesday',
        'wednesday' => 'Wednesday',
        'thursday' => 'Thursday',
        'friday' => 'Friday',
        'saturday' => 'Saturday',
        'sunday' => 'Sunday',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    /** Ordered by the manual sort order set in the admin panel. */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /** Ordered Monday → Sunday, then by start time. */
    public function scopeByWeekday(Builder $query): Builder
    {
        $days = array_keys(self::DAYS);

        return $query
            ->orderByRaw('CASE '.collect($days)
                ->map(fn ($day, $i) => "WHEN day = '{$day}' THEN {$i}")
                ->implode(' ').' ELSE 99 END')
            ->orderBy('start_time');
    }

    /** Translated weekday name, e.g. "Monday" / "ಸೋಮವಾರ". */
    public function getDayLabelAttribute(): ?string
    {
        if (! $this->day) {
            return null;
        }

        return __('messages.days.'.$this->day);
    }

    /** "Every Monday" in the active locale. */
    public function getScheduleLabelAttribute(): ?string
    {
        return $this->day_label
            ? __('messages.centers.every_day', ['day' => $this->day_label])
            : null;
    }

    /** "5:15 PM – 6:15 PM". */
    public function getTimeLabelAttribute(): ?string
    {
        if (! $this->start_time) {
            return null;
        }

        $start = $this->formatTime($this->start_time);
        $end = $this->end_time ? $this->formatTime($this->end_time) : null;

        return $end ? $start.' – '.$end : $start;
    }

    protected function formatTime(string $time): string
    {
        $carbon = Carbon::createFromFormat('H:i:s', strlen($time) === 5 ? $time.':00' : $time);

        // 12:00 PM reads better as "Noon" on the schedule cards.
        if ($carbon->format('H:i') === '12:00') {
            return __('messages.centers.noon');
        }

        return $carbon->format('g:i A');
    }
}
