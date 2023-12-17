<?php

namespace App\Http\Controllers\subjects;

use App\Http\Controllers\Controller;
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
        $user = Auth::user();
        return view('subjects.taken', compact('user'));
    }

    public function add(Request $request)
    {
        return redirect()->route('subjects.taken');
    }
}
