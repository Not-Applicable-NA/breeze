<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use App\Models\BusinessSubject;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessSubjectController extends Controller
{
    private $businessSubject;

    public function __construct() {
        $this->businessSubject = new BusinessSubject();
    }

    /**
     * 科目一覧を表示
     */    
    public function show(): View
    {
        $user = Auth::user();
        $subjects = $this->businessSubject->getAllSubjects();
        return view('subjects', compact('user', 'subjects'));
    }
}