<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use Illuminate\Database\Seeder;

class GalleryImageSeeder extends Seeder
{
    public function run(): void
    {
        // Real photographs of the school's classes, served from public/images.
        $images = [
            ['/images/hero/students-drawing-class.jpg', 'Drawing Class in Progress', 'ನಡೆಯುತ್ತಿರುವ ಚಿತ್ರಕಲಾ ತರಗತಿ'],
            ['/images/hero/students-drawing-lineup.jpg', 'Students at Work', 'ಕಲಿಕೆಯಲ್ಲಿ ತೊಡಗಿದ ವಿದ್ಯಾರ್ಥಿಗಳು'],
            ['/images/hero/students-artwork-hall.jpg', 'Student Artwork on Display', 'ಪ್ರದರ್ಶನದಲ್ಲಿ ವಿದ್ಯಾರ್ಥಿಗಳ ಕಲಾಕೃತಿಗಳು'],
        ];

        foreach ($images as $i => [$path, $en, $kn]) {
            GalleryImage::query()->create([
                'category' => 'student_work',
                'image' => $path,
                'title' => ['en' => $en, 'kn' => $kn],
                'sort_order' => $i + 1,
            ]);
        }
    }
}
