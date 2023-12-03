<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TakenSubjectController extends Controller
{
    private $takenSubject;

    public function __construct() {
        $this->takenSubject = new Subject();
    }

    /**
     * 履修科目一覧を表示
     */    
    public function show(Request $request): View
    {
        $user = Auth::user();
        $takenSubjects = $this->takenSubject->getAllSubjects();
        return view('taken-subjects', compact('takenSubjects', 'user'));
    }
}
