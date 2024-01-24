<?php

namespace App\Http\Controllers\subjects;

use App\Http\Controllers\Controller;
use App\Models\ClassList;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Google\Service\Calendar\EventReminder;
use Google\Service\Calendar\EventReminders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\GoogleCalendar\Event;

class TakenController extends Controller
{
    /**
     * 履修科目一覧を表示
     */    
    public function show(Request $request): View
    {
        $user = User::find(Auth::user()->id);
        $subjects = $user->subjects;
        $dayOfWeeks = ['日', '月', '火', '水', '木', '金', '土'];
        $classes = ClassList::where(
            'major_id', '=', $user->class->major->id
        )->get();
        return view('subjects.taken', compact('subjects', 'dayOfWeeks', 'classes'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'subject' => ['required'],
            'subject.*' => ['required', 'integer']
        ]);
        $user = User::find(Auth::user()->id);
        $user->subjects()->syncWithoutDetaching($request->subject);

        $this->addEventToGoogleCalendar($user->subjects);

        return redirect()->route('subjects.taken');
    }

    public function delete(Request $request)
    {
        $subject = Subject::find($request->subjectId);
        $semetserStartDt = $this->getSemetserStartDt($subject->semester);
        $semetserEndDt = $this->getSemetserEndDt($subject->semester);
        if (!$semetserStartDt || !$semetserEndDt) {
            abort(500);
        }
        foreach (Event::get(startDateTime: $semetserStartDt, endDateTime: $semetserEndDt->addDay()) as $event) {
            if ($event->name === $subject->name) {
                $event->delete();
            }
        }
        $user = User::find(Auth::user()->id);
        $user->subjects()->detach($request->subjectId);

        return back();
    }

    private function addEventToGoogleCalendar($subjects)
    {
        $reminder1 = new EventReminder();
        $reminder1->setMethod('email');
        $reminder1->setMinutes(60);
        $reminder2 = new EventReminder();
        $reminder2->setMethod('popup');
        $reminder2->setMinutes(10);
        $reminders = new EventReminders();
        $reminders->setOverrides([$reminder1, $reminder2]);
        $reminders->setUseDefault(false);
        foreach ($subjects as $subject) {
            $semetserStartDt = $this->getSemetserStartDt($subject->semester);
            $semetserEndDt = $this->getSemetserEndDt($subject->semester);
            if (!$semetserStartDt || !$semetserEndDt) {
                abort(500);
            }

            $dt = $semetserStartDt->copy();
            for ($i = 0; $i <= $semetserStartDt->diffInDays($semetserEndDt); $i++) {
                if ($dt->dayOfWeek === $subject->day_of_week_1) {
                    $event = new Event;
                    $event->name = $subject->name;
                    $event->reminders = $reminders;
                    $startDt = $this->getStartDateTime($dt, $subject->period_1);
                    $endDt = $this->getEndDateTime($startDt->copy(), $subject->is_in_a_row_1);
                    $event->startDateTime = $startDt;
                    $event->endDateTime = $endDt;
                    $event->save();
                } elseif ($dt->dayOfWeek === $subject->day_of_week_2) {
                    $event = new Event;
                    $event->name = $subject->name;
                    $event->reminders = $reminders;
                    $startDt = $this->getStartDateTime($dt, $subject->period_2);
                    $endDt = $this->getEndDateTime($startDt->copy(), $subject->is_in_a_row_2);
                    $event->startDateTime = $startDt;
                    $event->endDateTime = $endDt;
                    $event->save();
                }
                $dt->addDay();
            }
        }
    }

    private function getSemetserStartDt($semester): ?Carbon {
        if ($semester == '前期') {
            return new Carbon(Semester::first()->first_start);
        } elseif ($semester == '前期前半') {
            return new Carbon(Semester::first()->first_start);
        } elseif ($semester == '前期後半') {
            return new Carbon(Semester::first()->first_second_half_start);
        } elseif ($semester == '後期') {
            return new Carbon(Semester::first()->second_start);
        } elseif ($semester == '後期前半') {
            return new Carbon(Semester::first()->second_start);
        } elseif ($semester == '後期後半') {
            return new Carbon(Semester::first()->second_second_half_start);
        } else {
            return null;
        }
    }

    private function getSemetserEndDt($semester): ?Carbon {
        if ($semester == '前期') {
            return new Carbon(Semester::first()->first_end);
        } elseif ($semester == '前期前半') {
            return new Carbon(Semester::first()->first_first_half_end);
        } elseif ($semester == '前期後半') {
            return new Carbon(Semester::first()->first_end);
        } elseif ($semester == '後期') {
            return new Carbon(Semester::first()->second_end);
        } elseif ($semester == '後期前半') {
            return new Carbon(Semester::first()->second_first_half_end);
        } elseif ($semester == '後期後半') {
            return new Carbon(Semester::first()->second_end);
        } else {
            return null;
        }
    }

    private function getStartDateTime(Carbon $dt, int $period): Carbon
    {
        if ($period === 1) {
            return $dt->setTime(9, 0);
        } elseif ($period === 2) {
            return $dt->setTime(10, 40);
        } elseif ($period === 3) {
            return $dt->setTime(12, 55);
        } elseif ($period === 4) {
            return $dt->setTime(14, 35);
        } elseif ($period === 5) {
            return $dt->setTime(16, 15);
        } elseif ($period === 6) {
            return $dt->setTime(17, 55);
        } else {
            abort(500);
        }
    }

    private function getEndDateTime(Carbon $dt, bool $inARow): Carbon
    {
        if (!$inARow) {
            return $dt->addMinutes(90);
        } else {
            return $dt->addMinutes(100)->addMinutes(90);
        }
    }
}
