<?php

namespace App\Http\Controllers\subjects;

use App\Http\Controllers\Controller;
use App\Models\ClassList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TakenController extends Controller
{
    /**
     * 履修科目一覧を表示
     */    
    public function show(Request $request): View
    {
        $user = User::find(Auth::user()->id);
        $subjects = $user->subjects;
        $dayOfWeeks = ['日', '月', '火', '水', '木', '金', '土'];
        $classes = ClassList::where(
            'major_id', '=', $user->class->major->id
        )->get();
        return view('subjects.taken', compact('subjects', 'dayOfWeeks', 'classes'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'subject' => ['required'],
            'subject.*' => ['required', 'integer']
        ]);
        $user = User::find(Auth::user()->id);
        $user->subjects()->syncWithoutDetaching($request->subject);
        return redirect()->route('subjects.taken');
    }

    public function delete(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->subjects()->detach($request->subjectId);

        return back();
    }
}
