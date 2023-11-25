<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeacherController extends Controller
{
    // private $subject;

    // public function __construct() {
    //     $this->subject = new Subject();
    // }

    /**
     * 教員一覧を表示
     */    
    public function show(Request $request): View
    {
        // $subjects = $this->subject->getAllSubject();
        return view('teachers');
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

        return redirect()->route('teachers');
    }
}
