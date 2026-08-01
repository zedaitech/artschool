<?php

namespace Database\Seeders;

use App\Models\TrainingCenter;
use Illuminate\Database\Seeder;

class TrainingCenterSeeder extends Seeder
{
    public function run(): void
    {
        $centers = [
            [
                'slug' => 'deralakatte',
                'name' => ['en' => 'Deralakatte', 'kn' => 'ದೇರಳಕಟ್ಟೆ'],
                'venue' => ['en' => 'Shree Ayyappa Swamy Temple', 'kn' => 'ಶ್ರೀ ಅಯ್ಯಪ್ಪ ಸ್ವಾಮಿ ದೇವಸ್ಥಾನ'],
                'day' => 'monday',
                'start_time' => '17:15',
                'end_time' => '18:15',
                'icon' => 'palette',
            ],
            [
                'slug' => 'kudroli',
                'name' => ['en' => 'Kudroli', 'kn' => 'ಕುದ್ರೋಳಿ'],
                'venue' => ['en' => 'Shree Bhagavathi Kshetra', 'kn' => 'ಶ್ರೀ ಭಗವತಿ ಕ್ಷೇತ್ರ'],
                'day' => 'tuesday',
                'start_time' => '17:15',
                'end_time' => '18:15',
                'icon' => 'brush',
            ],
            [
                'slug' => 'attavar',
                'name' => ['en' => 'Attavar', 'kn' => 'ಅತ್ತಾವರ'],
                'venue' => ['en' => 'Shree Umamaheshwara Temple', 'kn' => 'ಶ್ರೀ ಉಮಾಮಹೇಶ್ವರ ದೇವಸ್ಥಾನ'],
                'day' => 'wednesday',
                'start_time' => '17:15',
                'end_time' => '18:15',
                'icon' => 'pencil',
            ],
            [
                'slug' => 'kulai',
                'name' => ['en' => 'Kulai', 'kn' => 'ಕುಳಾಯಿ'],
                'venue' => ['en' => 'Shree Narayana Guru Samaja Seva Sangha (R.)', 'kn' => 'ಶ್ರೀ ನಾರಾಯಣ ಗುರು ಸಮಾಜ ಸೇವಾ ಸಂಘ (ರಿ.)'],
                'day' => 'thursday',
                'start_time' => '17:15',
                'end_time' => '18:15',
                'icon' => 'star',
            ],
            [
                'slug' => 'kankanady-mangaluru',
                'name' => ['en' => 'Kankanady, Mangaluru', 'kn' => 'ಕಂಕನಾಡಿ, ಮಂಗಳೂರು'],
                'venue' => ['en' => 'Shree Brahma Baidarkala Garadi Kshetra', 'kn' => 'ಶ್ರೀ ಬ್ರಹ್ಮ ಬೈದರ್ಕಳ ಗರಡಿ ಕ್ಷೇತ್ರ'],
                'day' => 'friday',
                'start_time' => '17:15',
                'end_time' => '18:15',
                'icon' => 'palette',
            ],
            [
                'slug' => 'beeri-kotekar',
                'name' => ['en' => 'Beeri, Kotekar', 'kn' => 'ಬೀರಿ, ಕೋಟೆಕಾರ್'],
                'venue' => ['en' => 'Shree Sarvajanika Shree Ganesha Seva Samithi (R.)', 'kn' => 'ಶ್ರೀ ಸಾರ್ವಜನಿಕ ಶ್ರೀ ಗಣೇಶ ಸೇವಾ ಸಮಿತಿ (ರಿ.)'],
                'notes' => ['en' => 'Siddhi Vinayaka Bhajana Mandira', 'kn' => 'ಸಿದ್ಧಿ ವಿನಾಯಕ ಭಜನಾ ಮಂದಿರ'],
                'day' => 'saturday',
                'start_time' => '15:30',
                'end_time' => '16:30',
                'icon' => 'cube',
            ],
            [
                'slug' => 'kolya-someshwara',
                'name' => ['en' => 'Kolya, Someshwara', 'kn' => 'ಕೊಳ್ಯ, ಸೋಮೇಶ್ವರ'],
                'venue' => ['en' => 'Brahma Shree Narayana Guru Dhyana Mandira', 'kn' => 'ಬ್ರಹ್ಮ ಶ್ರೀ ನಾರಾಯಣ ಗುರು ಧ್ಯಾನ ಮಂದಿರ'],
                'day' => 'saturday',
                'start_time' => '17:15',
                'end_time' => '18:15',
                'icon' => 'brush',
            ],
            [
                'slug' => 'kulashekara',
                'name' => ['en' => 'Kulashekara', 'kn' => 'ಕುಲಶೇಖರ'],
                'venue' => ['en' => 'Shree Veera Narayana Temple', 'kn' => 'ಶ್ರೀ ವೀರ ನಾರಾಯಣ ದೇವಸ್ಥಾನ'],
                'day' => 'sunday',
                'start_time' => '09:00',
                'end_time' => '10:00',
                'icon' => 'pencil',
            ],
            [
                'slug' => 'kottara-mangaluru',
                'name' => ['en' => 'Kottara, Mangaluru', 'kn' => 'ಕೊಟ್ಟಾರ, ಮಂಗಳೂರು'],
                'venue' => ['en' => 'Shree Krishna Jnanodaya Bhajana Mandira', 'kn' => 'ಶ್ರೀ ಕೃಷ್ಣ ಜ್ಞಾನೋದಯ ಭಜನಾ ಮಂದಿರ'],
                'day' => 'sunday',
                'start_time' => '11:00',
                'end_time' => '12:00',
                'icon' => 'star',
            ],
            [
                'slug' => 'thokkottu',
                'name' => ['en' => 'Thokkottu', 'kn' => 'ತೊಕ್ಕೊಟ್ಟು'],
                'venue' => ['en' => 'Shree Vitthoba Rukmayi Mandira', 'kn' => 'ಶ್ರೀ ವಿಠ್ಠೋಬ ರುಕ್ಮಾಯಿ ಮಂದಿರ'],
                'day' => 'sunday',
                'start_time' => '16:30',
                'end_time' => '17:30',
                'icon' => 'palette',
            ],
        ];

        foreach ($centers as $i => $center) {
            TrainingCenter::query()->updateOrCreate(
                ['slug' => $center['slug']],
                array_merge($center, [
                    'sort_order' => $i + 1,
                    'is_featured' => $i < 6,
                    'is_published' => true,
                ]),
            );
        }
    }
}
