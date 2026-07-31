<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class GalleryImage extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'caption',
        'category',
        'image',
        'sort_order',
        'is_published',
    ];

    public array $translatable = [
        'title',
        'caption',
    ];

    /** Fixed, filterable galleries. Extend freely. */
    public const CATEGORIES = [
        'student_work' => 'Student Work',
        'campus' => 'Campus & Studios',
        'events' => 'Events & Exhibitions',
        'workshops' => 'Workshops',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
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
