<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Google_Client;
use Google\Service\Calendar;

class ClassCalendarIsExisted
{
    /**
     * 授業カレンダーが存在するか確認する
     */
    public function handle(Request $request, Closure $next): Response
    {
        $service = $this->getService();
        $calendarList = $service->calendarList->listCalendarList();
        if (!$calendarList->getItems()) {
            // 存在しない場合作成する
            $calendar = new Calendar\Calendar();
            $calendar->setSummary('Classes');
            $calendar->setTimeZone(date_default_timezone_get());
            $createdCalendar = $service->calendars->insert($calendar);

            // shomcdremi.s@gmail.comと共有し、権限を与える
            $rule = new Calendar\AclRule();
            $scope = new Calendar\AclRuleScope();
            $scope->setType('user');
            $scope->setValue('shomcdremi.s@gmail.com');
            $rule->setScope($scope);
            $rule->setRole('owner');
            $service->acl->insert($createdCalendar->getId(), $rule);
        }
        return $next($request);
    }

    private function getService(): Calendar
    {
        $client = new Google_Client();
        $client->setApplicationName('Google Calendar API Test');
        $client->setScopes(Calendar::CALENDAR);
        $client->setAuthConfig(storage_path('app/json/macro-mender-353308-5fd545f73498.json'));

        return new Calendar($client);
    }
}
