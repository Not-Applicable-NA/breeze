<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class SubjectController extends Controller
{
    // private $subject;

    // public function __construct() {
    //     $this->subject = new Subject();
    // }

    /**
     * 科目一覧を表示
     */    
    public function show(Request $request): View
    {
        // $subjects = $this->subject->getAllSubject();
        return view('subjects');
    }
}
