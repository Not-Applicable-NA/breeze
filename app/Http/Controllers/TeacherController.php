<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeacherController extends Controller
{
    private $teacher;

    public function __construct() {
        $this->teacher = new Teacher();
    }

    /**
     * 教員一覧を表示
     */    
    public function show(Request $request): View
    {
        $teachers = $this->teacher->getAllTeachers();
        return view('teachers.teachers', compact('teachers'));
    }

    /**
     * 教員を追加
     */
    public function add(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Teacher::class],
            'labno' => ['required', 'string']
        ]);

        Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            'laboratory_no' => $request->labno,
        ]);

        return back();
    }
    
    /**
     * 編集画面を表示
     */    
    public function edit($teacherId): View
    {
        $teacher = $this->teacher->getTeacher($teacherId);
        if (!$teacher) {
            abort(500);
        }
        
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * 編集内容を保存
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Teacher::class],
            'labno' => ['required', 'string']
        ]);

        $teacher = Teacher::find($request->teacherId);

        $teacher->update([
            'name' => $request->name,
            'email' => $request->email,
            'laboratory_no' => $request->labno,
        ]);

        return redirect()->route('teachers');
    }

    /**
     * 削除確認画面を表示
     */    
    public function delete($subjectId): View
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
    public function deleteConfirm(Request $request)
    {
        $subject = Subject::find($request->subjectId);
        $subject->delete();

        return redirect()->route('subjects');
    }
}
