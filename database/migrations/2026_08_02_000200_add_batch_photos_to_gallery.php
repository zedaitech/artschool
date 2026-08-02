<?php

use App\Models\GalleryImage;
use Illuminate\Database\Migrations\Migration;

/*
| Two more class photographs, from the August 2026 sessions. Same reasoning
| as the earlier gallery migration: the rows live in the database, so the
| seeder alone would never reach an already-seeded site.
*/

return new class extends Migration
{
    private array $images = [
        ['/images/gallery/junior-batch-artwork.jpg', 'Junior Batch With Their Paintings', 'ತಮ್ಮ ಚಿತ್ರಗಳೊಂದಿಗೆ ಕಿರಿಯ ತಂಡ'],
        ['/images/gallery/senior-batch-artwork.jpg', 'Senior Batch With Their Paintings', 'ತಮ್ಮ ಚಿತ್ರಗಳೊಂದಿಗೆ ಹಿರಿಯ ತಂಡ'],
    ];

    public function up(): void
    {
        $next = (int) GalleryImage::query()->max('sort_order');

        foreach ($this->images as $i => [$path, $en, $kn]) {
            GalleryImage::query()->updateOrCreate(
                ['image' => $path],
                [
                    'category' => 'student_work',
                    'title' => ['en' => $en, 'kn' => $kn],
                    'sort_order' => $next + $i + 1,
                    'is_published' => true,
                ],
            );
        }
    }

    public function down(): void
    {
        GalleryImage::query()->whereIn('image', array_column($this->images, 0))->delete();
    }
};
