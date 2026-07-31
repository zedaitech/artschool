<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::query()->published()->orderByDesc('starts_at')->get();

        return view('pages.events', [
            'upcoming' => $events->filter->isOpen()->values(),
            'past' => $events->reject->isOpen()->values(),
        ]);
    }

    public function show(string $slug)
    {
        $event = Event::query()->published()->where('slug', $slug)->firstOrFail();

        return view('pages.event', [
            'event' => $event,
            'related' => Event::query()->published()
                ->whereKeyNot($event->getKey())
                ->orderByDesc('starts_at')
                ->take(3)
                ->get(),
        ]);
    }
}
