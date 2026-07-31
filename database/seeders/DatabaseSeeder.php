<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Default CMS administrator. Change the password after first login.
        User::query()->updateOrCreate(
            ['email' => 'admin@snsart.example'],
            [
                'name' => 'SNSA Administrator',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $this->call([
            SettingSeeder::class,
            HeroSlideSeeder::class,
            TrainingCenterSeeder::class,
            FacultySeeder::class,
            GalleryImageSeeder::class,
            TestimonialSeeder::class,
            EventSeeder::class,
        ]);
    }
}
