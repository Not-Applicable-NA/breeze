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
    private $credits = [1, 2, 4];
    private $grades = [1, 2, 3, 4];
    private $semesters = ['前期', '前期前半', '前期後半', '後期', '後期前半', '後期後半'];
    private $dayOfWeeks = ['月', '火', '水', '木', '金', '土', '日'];
    private $periods = [1, 2, 3, 4, 5, 6];

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
        $credits = $this->credits;
        $grades = $this->grades;
        $semesters = $this->semesters;
        $teachers = Teacher::all();
        $classes = ClassList::where(
            'major_id', '=', $user->class->major->id
        )->get();
        $dayOfWeeks = $this->dayOfWeeks;
        $periods = $this->periods;
        
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
    
    /**
     * 科目編集画面を表示
     */    
    public function edit($subjectId): View
    {
        $user = Auth::user();
        $subject = $this->subject->getSubject($subjectId);
        if (!$subject) {
            abort(500);
        }
        $credits = $this->credits;
        $grades = $this->grades;
        $semesters = $this->semesters;
        $teachers = Teacher::all();
        $classes = ClassList::where(
            'major_id', '=', $user->class->major->id
        )->get();
        $dayOfWeeks = $this->dayOfWeeks;
        $periods = $this->periods;
        
        return view('subjects.edit', compact(
            'subject',
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
     * 科目の編集内容を保存
     */
    public function store(Request $request)
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

        $subject = Subject::find($request->subjectId);

        $subject->update([
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
        $subject->teachers()->sync($request->teacher);
        $subject->classes()->sync($request->class);

        return redirect()->route('subjects');
    }

    /**
     * 削除確認画面を表示
     */    
    public function deleteConfirm($subjectId): View
    {
        $user = Auth::user();
        $subject = $this->subject->getSubject($subjectId);
        if (!$subject) {
            abort(500);
        }
        return view('subjects.delete', compact(
            'subject',
            'user'
        ));
    }

    /**
     * 科目を削除
     */
    public function delete(Request $request)
    {
        $subject = Subject::find($request->subjectId);
        $subject->delete();

        return redirect()->route('subjects');
    }
}
