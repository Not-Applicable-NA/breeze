<?php

namespace App\Http\Controllers;

use App\Models\Subject;
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
        return view('subjects', compact('subjects', 'user'));
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
