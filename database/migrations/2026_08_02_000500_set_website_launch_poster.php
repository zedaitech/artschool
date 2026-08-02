<?php

use App\Models\Event;
use Illuminate\Database\Migrations\Migration;

/*
| The launch announcement went up with footage but no still, so its card in
| the listing fell back to a blank gradient and the hero to flat maroon.
| This is a frame lifted from the video itself, which also becomes the
| player's poster and the page's share image.
*/

return new class extends Migration
{
    public function up(): void
    {
        Event::query()
            ->where('slug', 'official-website-launch')
            ->update(['image' => '/images/events/website-launch-poster.jpg']);
    }

    public function down(): void
    {
        Event::query()
            ->where('slug', 'official-website-launch')
            ->update(['image' => null]);
    }
};
