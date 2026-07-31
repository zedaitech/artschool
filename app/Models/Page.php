<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * Free-form CMS pages (About, Admissions, Privacy…). The frontend renders the
 * `body` HTML inside a styled prose container, and `sections` holds optional
 * structured blocks (stats, highlights) used by richer templates.
 */
class Page extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'body',
        'hero_image',
        'meta_title',
        'meta_description',
        'sections',
        'is_published',
    ];

    public array $translatable = [
        'title',
        'subtitle',
        'body',
        'meta_title',
        'meta_description',
    ];

    protected function casts(): array
    {
        return [
            'sections' => 'array',
            'is_published' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
