<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Captures both general contact messages and admissions enquiries submitted
 * from the public site. `type` distinguishes them; `training_center` is optional.
 */
class Enquiry extends Model
{
    protected $fillable = [
        'type',
        'name',
        'email',
        'phone',
        'training_center',
        'message',
        'is_read',
    ];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }

    public const TYPES = [
        'contact' => 'Contact message',
        'admission' => 'Admission enquiry',
    ];
}
