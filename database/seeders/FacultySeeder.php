<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    public function run(): void
    {
        $faculty = [
            [
                'name' => 'Suresh K. Pandavarakallu',
                'photo' => '/images/founder-portrait.jpg',
                'designation' => ['en' => 'Founder & Director', 'kn' => 'ಸಂಸ್ಥಾಪಕರು ಮತ್ತು ನಿರ್ದೇಶಕರು'],
                'specialities' => ['en' => 'Drawing & Painting · Landscape · Traditional Art', 'kn' => 'ಡ್ರಾಯಿಂಗ್ ಮತ್ತು ಪೇಂಟಿಂಗ್ · ಲ್ಯಾಂಡ್‌ಸ್ಕೇಪ್ · ಸಾಂಪ್ರದಾಯಿಕ ಕಲೆ'],
                'bio' => [
                    'en' => 'An Art Master Diploma holder with a Graduate Diploma in Drawing & Painting and over two decades in fine arts, Suresh founded the school to make quality art education accessible to every child.',
                    'kn' => 'ಆರ್ಟ್ ಮಾಸ್ಟರ್ ಡಿಪ್ಲೊಮಾ ಹಾಗೂ ಡ್ರಾಯಿಂಗ್ ಮತ್ತು ಪೇಂಟಿಂಗ್‌ನಲ್ಲಿ ಗ್ರಾಜುಯೇಟ್ ಡಿಪ್ಲೊಮಾ ಪಡೆದಿರುವ ಸುರೇಶ್ ಅವರು, ಎರಡು ದಶಕಗಳಿಗೂ ಹೆಚ್ಚಿನ ಅನುಭವದೊಂದಿಗೆ ಪ್ರತಿ ಮಗುವಿಗೂ ಗುಣಮಟ್ಟದ ಕಲಾ ಶಿಕ್ಷಣ ತಲುಪಿಸಲು ಈ ಶಾಲೆಯನ್ನು ಸ್ಥಾಪಿಸಿದರು.',
                ],
                'sort_order' => 1,
            ],
            [
                'name' => 'Anjali Nayak',
                'photo' => 'https://images.pexels.com/photos/29601846/pexels-photo-29601846.jpeg?auto=compress&cs=tinysrgb&w=800',
                'designation' => ['en' => 'Head of Painting', 'kn' => 'ಚಿತ್ರಕಲಾ ಮುಖ್ಯಸ್ಥೆ'],
                'specialities' => ['en' => 'Oil & Acrylic · Colour Theory', 'kn' => 'ತೈಲ ಮತ್ತು ಅಕ್ರಿಲಿಕ್ · ಬಣ್ಣ ಸಿದ್ಧಾಂತ'],
                'bio' => [
                    'en' => 'Anjali exhibits widely across India and mentors students toward a fearless, personal use of colour.',
                    'kn' => 'ಅಂಜಲಿ ಭಾರತದಾದ್ಯಂತ ವ್ಯಾಪಕವಾಗಿ ಪ್ರದರ್ಶಿಸುತ್ತಾರೆ ಮತ್ತು ವಿದ್ಯಾರ್ಥಿಗಳಿಗೆ ನಿರ್ಭೀತ, ವೈಯಕ್ತಿಕ ಬಣ್ಣ ಬಳಕೆಯತ್ತ ಮಾರ್ಗದರ್ಶನ ನೀಡುತ್ತಾರೆ.',
                ],
                'sort_order' => 2,
            ],
            [
                'name' => 'Suresh Pai',
                'photo' => 'https://images.pexels.com/photos/6595899/pexels-photo-6595899.jpeg?auto=compress&cs=tinysrgb&w=800',
                'designation' => ['en' => 'Sculptor in Residence', 'kn' => 'ನಿವಾಸಿ ಶಿಲ್ಪಿ'],
                'specialities' => ['en' => 'Clay · Bronze · Installation', 'kn' => 'ಜೇಡಿಮಣ್ಣು · ಕಂಚು · ಸ್ಥಾಪನೆ'],
                'bio' => [
                    'en' => 'Suresh brings a deep knowledge of Indian sculptural traditions and a contemporary eye to the studio.',
                    'kn' => 'ಸುರೇಶ್ ಭಾರತೀಯ ಶಿಲ್ಪ ಸಂಪ್ರದಾಯಗಳ ಆಳವಾದ ಜ್ಞಾನ ಮತ್ತು ಆಧುನಿಕ ದೃಷ್ಟಿಯನ್ನು ಸ್ಟುಡಿಯೊಗೆ ತರುತ್ತಾರೆ.',
                ],
                'sort_order' => 3,
            ],
            [
                'name' => 'Priya Shenoy',
                'photo' => 'https://images.pexels.com/photos/29125196/pexels-photo-29125196.jpeg?auto=compress&cs=tinysrgb&w=800',
                'designation' => ['en' => 'Digital Arts Faculty', 'kn' => 'ಡಿಜಿಟಲ್ ಕಲಾ ಅಧ್ಯಾಪಕಿ'],
                'specialities' => ['en' => 'Illustration · Concept Art', 'kn' => 'ಚಿತ್ರಣ · ಪರಿಕಲ್ಪನಾ ಕಲೆ'],
                'bio' => [
                    'en' => 'Priya bridges the traditional and the digital, helping students build careers in illustration and design.',
                    'kn' => 'ಪ್ರಿಯಾ ಸಾಂಪ್ರದಾಯಿಕ ಮತ್ತು ಡಿಜಿಟಲ್ ನಡುವೆ ಸೇತುವೆಯಾಗಿ, ವಿದ್ಯಾರ್ಥಿಗಳಿಗೆ ಚಿತ್ರಣ ಮತ್ತು ವಿನ್ಯಾಸದಲ್ಲಿ ವೃತ್ತಿ ನಿರ್ಮಿಸಲು ಸಹಾಯ ಮಾಡುತ್ತಾರೆ.',
                ],
                'sort_order' => 4,
            ],
        ];

        foreach ($faculty as $member) {
            Faculty::query()->create($member);
        }
    }
}
