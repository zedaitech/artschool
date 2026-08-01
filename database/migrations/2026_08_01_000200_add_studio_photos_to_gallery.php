<?php

use App\Models\GalleryImage;
use Illuminate\Database\Migrations\Migration;

/*
| Three new class photographs. Gallery items are database rows, so extending
| the seeder alone would never reach a database that has already been seeded —
| this adds them wherever the site is already running, and they stay editable
| in the admin afterwards.
*/

return new class extends Migration
{
    private array $images = [
        ['/images/gallery/students-artwork-group.jpg', 'Young Artists With Their Work', 'ತಮ್ಮ ಕೃತಿಗಳೊಂದಿಗೆ ಪುಟ್ಟ ಕಲಾವಿದರು'],
        ['/images/gallery/students-studio-lineup.jpg', 'A Studio Full of Colour', 'ಬಣ್ಣಗಳಿಂದ ತುಂಬಿದ ಸ್ಟುಡಿಯೋ'],
        ['/images/gallery/students-nature-studies.jpg', 'Nature Studies on Display', 'ಪ್ರದರ್ಶನದಲ್ಲಿ ನಿಸರ್ಗ ಚಿತ್ರಗಳು'],
    ];

    public function up(): void
    {
        // Append after whatever is already there, so an admin's own ordering
        // of the existing images is left alone.
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
