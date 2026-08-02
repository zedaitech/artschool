<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
| Events were built for competitions — every label talks about entries and
| submission dates. Announcements (a website launch, an inauguration) belong
| on the same page but must not claim "Entries Open", so `kind` lets the two
| share the listing while wording themselves honestly. `video` is optional
| footage of the occasion, played on the event page.
*/

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Everything that exists today is a competition.
            $table->string('kind')->default('competition')->after('slug');
            $table->string('video')->nullable()->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['kind', 'video']);
        });
    }
};
