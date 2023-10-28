<?php

namespace App\Http\Controllers;

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
}
