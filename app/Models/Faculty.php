<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Faculty extends Model
{
    use HasTranslations;

    protected $table = 'faculties';

    protected $fillable = [
        'name',
        'designation',
        'bio',
        'specialities',
        'photo',
        'facebook',
        'instagram',
        'sort_order',
        'is_published',
    ];

    public array $translatable = [
        'designation',
        'bio',
        'specialities',
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
