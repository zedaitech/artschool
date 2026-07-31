<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            [
                // Competition banner — links through to the full event page.
                'heading' => ['en' => 'Shree Guru Varna Vaibhava – 2026', 'kn' => 'ಶ್ರೀ ಗುರು ವರ್ಣ ವೈಭವ – ೨೦೨೬'],
                'eyebrow' => [],
                'subheading' => [],
                'cta_label' => [],
                'cta_url' => '/events/shree-guru-varna-vaibhava-2026',
                'image' => '/images/hero/banner-varna-vaibhava-2026.jpg',
                'is_banner' => true,
                // Retired from the carousel: the photo slides carry the hero.
                'is_published' => false,
                'sort_order' => 1,
            ],
            [
                'eyebrow' => ['en' => 'Established 2018', 'kn' => 'ಸ್ಥಾಪನೆ ೨೦೧೮'],
                'heading' => ['en' => 'Inspiring Creativity Through Art', 'kn' => 'ಕಲೆಯ ಮೂಲಕ ಸೃಜನಶೀಲತೆಗೆ ಸ್ಫೂರ್ತಿ'],
                'subheading' => [
                    'en' => 'A premier institution nurturing creativity, artistic excellence and moral values — inspired by the teachings of Bhagavan Shree Narayana Guru.',
                    'kn' => 'ಭಗವಾನ್ ಶ್ರೀ ನಾರಾಯಣ ಗುರುಗಳ ಬೋಧನೆಗಳಿಂದ ಪ್ರೇರಿತವಾಗಿ ಸೃಜನಶೀಲತೆ, ಕಲಾತ್ಮಕ ಶ್ರೇಷ್ಠತೆ ಮತ್ತು ನೈತಿಕ ಮೌಲ್ಯಗಳನ್ನು ಪೋಷಿಸುವ ಪ್ರಮುಖ ಸಂಸ್ಥೆ.',
                ],
                'cta_label' => ['en' => 'Find a Centre', 'kn' => 'ಕೇಂದ್ರವನ್ನು ಹುಡುಕಿ'],
                'cta_url' => '/training-centres',
                'image' => '/images/hero/students-drawing-class.jpg',
                'is_banner' => false,
                'sort_order' => 2,
            ],
            [
                // Ready-made school banner — shown whole, without an overlay.
                'heading' => ['en' => 'Where Creativity Blossoms, Values Grow', 'kn' => 'ಸೃಜನಶೀಲತೆ ಅರಳುವಲ್ಲಿ, ಮೌಲ್ಯಗಳು ಬೆಳೆಯುತ್ತವೆ'],
                'eyebrow' => [],
                'subheading' => [],
                'cta_label' => [],
                'cta_url' => null,
                'image' => '/images/hero/banner-creativity-blossoms.jpg',
                'is_banner' => true,
                // Retired from the carousel: the photo slides carry the hero.
                'is_published' => false,
                'sort_order' => 3,
            ],
            [
                'eyebrow' => ['en' => 'Admissions Open', 'kn' => 'ಪ್ರವೇಶ ಆರಂಭ'],
                'heading' => ['en' => 'Every Child Is an Artist', 'kn' => 'ಪ್ರತಿಯೊಬ್ಬ ಮಗುವೂ ಒಬ್ಬ ಕಲಾವಿದ'],
                'subheading' => [
                    'en' => 'With the right guidance, every talent can become a masterpiece. Classes for children, youth and adults — from LKG to advanced learners.',
                    'kn' => 'ಸರಿಯಾದ ಮಾರ್ಗದರ್ಶನದಿಂದ ಪ್ರತಿ ಪ್ರತಿಭೆಯೂ ಒಂದು ಮೇರುಕೃತಿಯಾಗಬಹುದು. LKG ಯಿಂದ ಮುಂದುವರಿದವರವರೆಗೆ — ಮಕ್ಕಳು, ಯುವಜನ ಮತ್ತು ವಯಸ್ಕರಿಗೆ ತರಗತಿಗಳು.',
                ],
                'cta_label' => ['en' => 'Enquire Now', 'kn' => 'ಈಗ ವಿಚಾರಿಸಿ'],
                'cta_url' => '/contact',
                'image' => '/images/hero/students-artwork-hall.jpg',
                'is_banner' => false,
                'sort_order' => 4,
            ],
            [
                // MSME (Udyam) registration banner — shown whole, without an overlay.
                'heading' => ['en' => 'A Government of India MSME Registered Art Education Institution', 'kn' => 'ಭಾರತ ಸರ್ಕಾರದ MSME ನೋಂದಾಯಿತ ಕಲಾ ಶಿಕ್ಷಣ ಸಂಸ್ಥೆ'],
                'eyebrow' => [],
                'subheading' => [],
                'cta_label' => [],
                'cta_url' => null,
                'image' => '/images/hero/banner-registered-institution.jpg',
                'is_banner' => true,
                // Retired from the carousel: the photo slides carry the hero.
                'is_published' => false,
                'sort_order' => 5,
            ],
            [
                'eyebrow' => ['en' => 'Our Motto', 'kn' => 'ನಮ್ಮ ಧ್ಯೇಯವಾಕ್ಯ'],
                'heading' => ['en' => 'Let’s Nurture Creativity… Let Talent Blossom!', 'kn' => 'ಸೃಜನಶೀಲತೆಯನ್ನು ಪೋಷಿಸೋಣ… ಪ್ರತಿಭೆ ಅರಳಲಿ!'],
                'subheading' => [
                    'en' => 'We identify, nurture and enhance every student’s talent through systematic training, personal guidance and practical learning.',
                    'kn' => 'ವ್ಯವಸ್ಥಿತ ತರಬೇತಿ, ವೈಯಕ್ತಿಕ ಮಾರ್ಗದರ್ಶನ ಮತ್ತು ಪ್ರಾಯೋಗಿಕ ಕಲಿಕೆಯ ಮೂಲಕ ಪ್ರತಿ ವಿದ್ಯಾರ್ಥಿಯ ಪ್ರತಿಭೆಯನ್ನು ನಾವು ಗುರುತಿಸಿ ಬೆಳೆಸುತ್ತೇವೆ.',
                ],
                'cta_label' => ['en' => 'View Gallery', 'kn' => 'ಗ್ಯಾಲರಿ ನೋಡಿ'],
                'cta_url' => '/gallery',
                'image' => '/images/hero/students-drawing-lineup.jpg',
                'is_banner' => false,
                'sort_order' => 6,
            ],
        ];

        foreach ($slides as $slide) {
            HeroSlide::query()->updateOrCreate(
                ['sort_order' => $slide['sort_order']],
                $slide
            );
        }

        // Drop any slides left over from an earlier, larger set.
        HeroSlide::query()->where('sort_order', '>', count($slides))->delete();
    }
}
