<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/*
| The same leading-slash problem the event posters had, everywhere else that
| has an upload field. A stored "/images/…" reads as an absolute URL, so the
| admin's upload field could not resolve it against a disk: it showed an empty
| field and blanked the column on save. Relative paths let the field see the
| file that is already there. media_url() resolves either form, so nothing
| changes for visitors.
*/

return new class extends Migration
{
    private array $columns = [
        'gallery_images' => 'image',
        'hero_slides' => 'image',
        'faculties' => 'photo',
        'testimonials' => 'photo',
        'training_centers' => 'image',
    ];

    public function up(): void
    {
        // Done row by row rather than in SQL: string concatenation differs
        // between SQLite and MySQL, and these tables are small.
        $this->rewrite(fn (string $path) => ltrim($path, '/'));
    }

    public function down(): void
    {
        $this->rewrite(fn (string $path) => '/'.ltrim($path, '/'));
    }

    private function rewrite(callable $transform): void
    {
        foreach ($this->columns as $table => $column) {
            $rows = DB::table($table)
                ->select('id', $column)
                ->whereNotNull($column)
                ->get();

            foreach ($rows as $row) {
                $path = $row->{$column};

                // Absolute URLs are left exactly as they are.
                if (blank($path) || str_starts_with($path, 'http')) {
                    continue;
                }

                $updated = $transform($path);

                if ($updated !== $path) {
                    DB::table($table)->where('id', $row->id)->update([$column => $updated]);
                }
            }
        }
    }
};
