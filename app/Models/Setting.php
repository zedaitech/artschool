<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * Simple key/value store for global site settings (contact info, socials,
 * SEO defaults). Values are plain strings — narrative, translatable content
 * lives on the Page / TrainingCenter / Event models instead.
 */
class Setting extends Model
{
    protected $fillable = ['key', 'value', 'group'];

    public $timestamps = true;

    /**
     * Read a setting value with a sensible fallback. Results are cached for
     * the lifetime of the request set (forever) and flushed on save.
     */
    public static function get(string $key, ?string $default = null): ?string
    {
        return static::all()->firstWhere('key', $key)?->value ?? $default;
    }

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('settings.all'));
        static::deleted(fn () => Cache::forget('settings.all'));
    }

    /**
     * All settings as a flat key => value map (cached).
     *
     * @return array<string, string|null>
     */
    public static function map(): array
    {
        return Cache::rememberForever('settings.all', fn () => static::query()->pluck('value', 'key')->toArray());
    }
}
