<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HeroSlide extends Model
{
    use HasTranslations;

    protected $fillable = [
        'eyebrow',
        'heading',
        'subheading',
        'cta_label',
        'cta_url',
        'image',
        'is_banner',
        'sort_order',
        'is_published',
    ];

    public array $translatable = [
        'eyebrow',
        'heading',
        'subheading',
        'cta_label',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'is_banner' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
