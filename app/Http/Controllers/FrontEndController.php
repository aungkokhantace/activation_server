<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\FrontEndEditRequest;
use App\Setup\FrontEnd\FrontEndRepositoryInterface;
use App\Setup\FrontEnd\FrontEnd;
use Auth;
use App\Setup\Backend\Backend;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

class FrontEndController extends Controller
{
    private $FrontEndRepository;

    public function __construct(FrontEndRepositoryInterface $frontEndRepository)
    {
        $this->frontEndRepository = $frontEndRepository;
    }

    public function index(Request $request)
    {
        if (Auth::guard('User')->check()) {
            $frontends      = $this->frontEndRepository->getFrontEnd();
            return view('frontend.index')->with('frontends', $frontends);
        }
        return redirect('/');
    }
    
}
