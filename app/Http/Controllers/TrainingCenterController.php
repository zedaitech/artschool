<?php

namespace App\Http\Controllers;

use App\Models\TrainingCenter;

class TrainingCenterController extends Controller
{
    public function index()
    {
        // Weekday order drives both the cards and the timetable, so the page
        // reads the way the schedule actually runs — Monday through Sunday.
        $centers = TrainingCenter::published()->byWeekday()->get();

        return view('pages.centers.index', [
            'centers' => $centers,
            'byDay' => $centers->groupBy('day'),
        ]);
    }
}
