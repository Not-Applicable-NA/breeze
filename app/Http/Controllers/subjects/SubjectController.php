<?php

namespace App\Http\Controllers\subjects;

use App\Http\Controllers\Controller;
use App\Models\ClassList;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SubjectController extends Controller
{
    private $subject;

    public function __construct() {
        $this->subject = new Subject();
    }

    /**
     * 科目一覧を表示
     */    
    public function show(): View
    {
        $user = Auth::user();
        $subjects = $this->subject->getAllSubjects();
        $credits = [0, 1, 2, 4];
        $grades = [1, 2, 3, 4];
        $semesters = ['前期', '前期前半', '前期後半', '後期', '後期前半', '後期後半'];
        $teachers = Teacher::all();
        $classes = ClassList::where(
            'major_id', '=', $user->class->major->id
        )->get();
        $dayOfWeeks = ['月', '火', '水', '木', '金', '土', '日'];
        $periods = [1, 2, 3, 4, 5, 6];
        
        return view('subjects.subjects', compact(
            'subjects',
            'user',
            'credits',
            'grades',
            'semesters',
            'teachers',
            'classes',
            'dayOfWeeks',
            'periods'
        ));
    }

    /**
     * 科目を追加
     */
    public function add(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'credits' => ['required', Rule::in([0, 1, 2, 4])],
            'grade' => ['required', Rule::in([1, 2, 3, 4])],
            'obligatory' => ['boolean'],
            'semester' => ['required', Rule::in(['前期', '前期前半', '前期後半', '後期', '後期前半', '後期後半'])],
            'dayofweek' => ['required', Rule::in(['月', '火', '水', '木', '金', '土', '日'])],
            'period' => ['required', Rule::in([1, 2, 3, 4, 5, 6])],
            'inarow' => ['boolean'],
            'dayofweek2' => ['nullable', Rule::in(['月', '火', '水', '木', '金', '土', '日'])],
            'period2' => ['nullable', Rule::in([1, 2, 3, 4, 5, 6])],
            'inarow2' => ['nullable', 'boolean'],
            'room' => ['required', 'string', 'max:255' ],
            'syllabus' => ['required', 'string', 'max:255' ],
            'teacher' => ['required'],
            'teacher.*' => ['required', 'integer'],
            'class' => ['nullable'],
            'class.*' => ['required', 'integer']
        ]);

        $subject = Subject::create([
            'name' => $request->name,
            'credits' => $request->credits,
            'dividend_grade' => $request->grade,
            'is_obligatory' => $request->obligatory ? true : false,
            'semester' => $request->semester,
            'day_of_week_1' => $request->dayofweek,
            'period_1' => $request->period,
            'is_in_a_row_1' => $request->inarow ? true : false,
            'day_of_week_2' => $request->dayofweek2,
            'period_2' => isset($request->dayofweek2) ? $request->period2 : null,
            'is_in_a_row_2' => isset($request->dayofweek2) ? ($request->inarow2 ? true : false) : null,
            'main_lecture_room' => $request->room,
            'syllabus' => $request->syllabus
        ]);
        $subject->teachers()->syncWithoutDetaching($request->teacher);
        $subject->classes()->syncWithoutDetaching($request->class);

        return back();
    }

    // public function redirect()
    // {
    //     $major = Auth::user()->class->major->name;
    //     dd($major);
    //     if ($major === '先端経営学科') {
    //         dd(1);
    //         return redirect()->route('business');
    //     } elseif ($major === 'システム情報学科') {

    //     } elseif ($major === '医療情報学科') {
            
    //     } elseif ($major === '情報メディア学科') {
            
    //     } else {
    //         abort(500);
    //     }
    // }
}
