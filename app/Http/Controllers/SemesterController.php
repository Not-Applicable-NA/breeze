<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SemesterController extends Controller
{
    private $semester;

    public function __construct() {
        $this->semester = new Semester();
    }

    /**
     * 学期情報を表示
     */    
    public function show(Request $request): View
    {
        $semester = $this->semester->getSemester();
        return view('semester', compact('semester'));
    }

    /**
     * 編集内容を保存
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_start' => ['required', 'date'],
            'first_first_half_end' => ['required', 'date'],
            'first_second_half_start' => ['required', 'date'],
            'first_end' => ['required', 'date'],
            'second_start' => ['required', 'date'],
            'second_first_half_end' => ['required', 'date'],
            'second_second_half_start' => ['required', 'date'],
            'second_end' => ['required', 'date']
        ]);

        $semester = Semester::first();

        $semester->update([
            'first_start' => $request->first_start,
            'first_first_half_end' => $request->first_first_half_end,
            'first_second_half_start' => $request->first_second_half_start,
            'first_end' => $request->first_end,
            'second_start' => $request->second_start,
            'second_first_half_end' => $request->second_first_half_end,
            'second_second_half_start' => $request->second_second_half_start,
            'second_end' => $request->second_end
        ]);

        return back();
    }
}
