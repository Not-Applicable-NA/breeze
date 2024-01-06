<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\GoogleCalendar\Event;

class DashboardController extends Controller
{
    public function show(): View
    {
        $events = Event::get();
        foreach ($events as $event) {
            dump($event);
        }
        dd();
        return view('dashboard');
    }
}
