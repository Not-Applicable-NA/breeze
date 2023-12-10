<?php

namespace App\Http\Controllers;

use App\Models\ClassList;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function show(Request $request): View
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
        
        return view('subjects', compact(
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
        dd($request);
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Teacher::class],
        //     'labno' => ['required', 'string']
        // ]);

        // Teacher::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'laboratory_no' => $request->labno,
        // ]);

        // return redirect()->route('teachers');
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
