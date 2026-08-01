<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;

/*
| The blog is a settings row so the school can move or retire it without a
| deploy, which means correcting the seeder never reaches the live database.
| This one-off data migration points it at the school's Blogger site; it can
| still be edited afterwards under Site Settings.
*/

return new class extends Migration
{
    public function up(): void
    {
        Setting::query()->updateOrCreate(
            ['key' => 'blog_url'],
            ['value' => 'https://sngsoam.blogspot.com/', 'group' => 'social'],
        );
    }

    public function down(): void
    {
        // Data fix — nothing meaningful to roll back to.
    }
};
