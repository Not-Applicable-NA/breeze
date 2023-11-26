<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    /**
     * 所属学科に応じてルート分岐
     */    
    public function redirect()
    {
        $major = Auth::user()->class->major->name;
        if ($major === '先端経営学科') {
            return redirect()->route('business');
        } elseif ($major === 'システム情報学科') {

        } elseif ($major === '医療情報学科') {
            
        } elseif ($major === '情報メディア学科') {
            
        } else {
            abort(500);
        }
    }
}
