<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;

/*
| The Facebook URL is a settings row, so correcting the seeder never
| reached the live database. This one-off data migration points it at the
| school's actual page; it can still be edited afterwards in the admin.
*/

return new class extends Migration
{
    public function up(): void
    {
        Setting::query()->updateOrCreate(
            ['key' => 'social_facebook'],
            ['value' => 'https://www.facebook.com/shreenarayanaguruschoolofart', 'group' => 'social'],
        );
    }

    public function down(): void
    {
        // Data fix — nothing meaningful to roll back to.
    }
};
