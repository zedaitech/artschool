<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'author' => 'Meera Kamath',
                'photo' => null,
                'role' => ['en' => 'Alumna, Painting 2023', 'kn' => 'ಹಳೆಯ ವಿದ್ಯಾರ್ಥಿನಿ, ಚಿತ್ರಕಲೆ ೨೦೨೩'],
                'quote' => [
                    'en' => 'The school gave me not just technique, but a voice. I walked in unable to draw a straight line and left with my first solo exhibition.',
                    'kn' => 'ಶಾಲೆ ನನಗೆ ತಂತ್ರ ಮಾತ್ರವಲ್ಲ, ಒಂದು ಧ್ವನಿಯನ್ನೂ ನೀಡಿತು. ಒಂದು ನೇರ ಗೆರೆ ಎಳೆಯಲಾಗದೆ ಒಳಗೆ ಬಂದ ನಾನು ನನ್ನ ಮೊದಲ ಏಕವ್ಯಕ್ತಿ ಪ್ರದರ್ಶನದೊಂದಿಗೆ ಹೊರಟೆ.',
                ],
                'sort_order' => 1,
            ],
            [
                'author' => 'Arjun Rao',
                'photo' => null,
                'role' => ['en' => 'Parent', 'kn' => 'ಪೋಷಕ'],
                'quote' => [
                    'en' => 'My daughter looks forward to her Sunday art club all week. The teachers are patient, warm and genuinely inspiring.',
                    'kn' => 'ನನ್ನ ಮಗಳು ವಾರವಿಡೀ ತನ್ನ ಭಾನುವಾರದ ಕಲಾ ಕ್ಲಬ್‌ಗಾಗಿ ಕಾಯುತ್ತಾಳೆ. ಶಿಕ್ಷಕರು ತಾಳ್ಮೆ, ಪ್ರೀತಿ ಮತ್ತು ನಿಜವಾದ ಸ್ಫೂರ್ತಿದಾಯಕರು.',
                ],
                'sort_order' => 2,
            ],
            [
                'author' => 'Fatima Zohra',
                'photo' => null,
                'role' => ['en' => 'Student, Digital Art', 'kn' => 'ವಿದ್ಯಾರ್ಥಿನಿ, ಡಿಜಿಟಲ್ ಕಲೆ'],
                'quote' => [
                    'en' => 'The blend of traditional drawing and digital tools here is unique. It prepared me for a real career in illustration.',
                    'kn' => 'ಇಲ್ಲಿನ ಸಾಂಪ್ರದಾಯಿಕ ಚಿತ್ರಕಲೆ ಮತ್ತು ಡಿಜಿಟಲ್ ಸಾಧನಗಳ ಸಂಯೋಜನೆ ವಿಶಿಷ್ಟವಾಗಿದೆ. ಇದು ಚಿತ್ರಣದಲ್ಲಿ ನಿಜವಾದ ವೃತ್ತಿಗಾಗಿ ನನ್ನನ್ನು ಸಿದ್ಧಪಡಿಸಿತು.',
                ],
                'sort_order' => 3,
            ],
        ];

        foreach ($items as $item) {
            Testimonial::query()->create($item);
        }
    }
}
