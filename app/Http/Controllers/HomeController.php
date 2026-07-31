<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\GalleryImage;
use App\Models\HeroSlide;
use App\Models\TrainingCenter;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('pages.home', [
            'slides' => HeroSlide::published()->ordered()->get(),
            'featuredCenters' => TrainingCenter::published()->where('is_featured', true)->byWeekday()->get(),
            'centers' => TrainingCenter::published()->byWeekday()->take(6)->get(),
            'gallery' => GalleryImage::published()->ordered()->get(),
            // The one event highlighted on the homepage: a featured event that is
            // still open, falling back to the next one on the calendar.
            'featuredEvent' => Event::query()->published()
                ->orderByDesc('is_featured')
                ->orderBy('starts_at')
                ->get()
                ->first(fn (Event $event) => $event->isOpen()),
        ]);
    }
}
