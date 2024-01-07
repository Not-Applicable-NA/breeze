<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Google_Client;
use Google\Service\Calendar;

class DashboardController extends Controller
{
    public function show(): View
    {
        $calendarId = $this->getCalendarId();
        return view('dashboard', compact('calendarId'));
    }

    /**
     * 授業カレンダーのカレンダーIDを取得
     */
    private function getCalendarId()
    {
        $client = new Google_Client();
        $client->setApplicationName('Google Calendar API Test');
        $client->setScopes(Calendar::CALENDAR);
        $client->setAuthConfig(storage_path('app/json/macro-mender-353308-5fd545f73498.json'));

        $service = new Calendar($client);
        $calendar = $service->calendarList->listCalendarList()->getItems()[0];

        return $calendar->getId();
    }
}
