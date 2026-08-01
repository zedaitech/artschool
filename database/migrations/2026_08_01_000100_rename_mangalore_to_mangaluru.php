<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/*
| The seeders already say "Mangaluru", but the content they seeded lives in
| the database and was edited afterwards, so the old spelling survived in
| training centre names, the event address and the SEO description. This
| sweeps every free-text content column so admin-entered copy is covered too.
*/

return new class extends Migration
{
    /**
     * Free-text columns that can carry the city name. Translatable fields are
     * JSON blobs, but the English spelling is the same string either way, and
     * the Kannada spelling (ಮಂಗಳೂರು) is already correct.
     */
    private array $columns = [
        'training_centers' => ['name', 'slug', 'venue', 'address', 'notes'],
        'events' => ['title', 'excerpt', 'body', 'location'],
        'settings' => ['value'],
        'pages' => ['title', 'subtitle', 'body', 'meta_title', 'meta_description', 'sections'],
        'faculties' => ['name', 'designation', 'bio', 'specialities'],
        'hero_slides' => ['eyebrow', 'heading', 'subheading', 'cta_label'],
        'testimonials' => ['author', 'role', 'quote'],
        'gallery_images' => ['title', 'caption'],
    ];

    public function up(): void
    {
        // REPLACE() is case-sensitive on both MySQL and SQLite, so the
        // lower-cased form used in slugs needs its own pass.
        $this->replace('Mangalore', 'Mangaluru');
        $this->replace('mangalore', 'mangaluru');
    }

    public function down(): void
    {
        // Data fix — nothing meaningful to roll back to.
    }

    private function replace(string $from, string $to): void
    {
        $grammar = DB::connection()->getQueryGrammar();

        foreach ($this->columns as $table => $columns) {
            foreach ($columns as $column) {
                $wrapped = $grammar->wrap($column);

                DB::table($table)
                    ->where($column, 'like', "%{$from}%")
                    ->update([$column => DB::raw("REPLACE({$wrapped}, '{$from}', '{$to}')")]);
            }
        }
    }
};
