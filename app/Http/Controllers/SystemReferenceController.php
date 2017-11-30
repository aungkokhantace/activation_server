<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class SystemReferenceController extends Controller
{
    public function index()
    {
        if (Auth::guard('User')->check()) {
            return view('systemreference.index');
        }
        return redirect('/');   
    }
}
