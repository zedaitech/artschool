<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
| Most event footage already lives on YouTube, and a 50 MB upload cap rules
| out anything longer than a few minutes. `youtube_url` lets the admin paste
| a watch/share link instead; the event page embeds the player.
*/

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('youtube_url')->nullable()->after('video');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('youtube_url');
        });
    }
};
