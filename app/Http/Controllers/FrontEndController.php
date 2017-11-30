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
use App\Setup\Backend\BackendRepository;
use App\Setup\FrontEnd\FrontEndRepository;

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

    public function updatestatus()
    {
        if (Auth::guard('User')->check()) {
            $inputAll = Input::all();
            $frontendId = $inputAll['frontend_id'];
            $status = $inputAll['status'];
            // dd($status);
            $backendId = $inputAll['backend_id'];

            if($status == 1){
                $status = 0;
            }
            else if($status == 0){
                $status = 1;
            }
            else{
                $status = 0;
            }

            $this->frontEndRepository->updateStatus($frontendId,$status);
            return redirect('/backend/edit/' . $backendId);
        }
        return redirect('/');
    }

    public function edit($id)
    {
        try {
            if (Auth::guard('User')->check()) {

                $frontend = FrontEnd::find($id);
                if(isset($frontend) && count($frontend)>0){

                    return view('frontend.frontend')
                        ->with('frontend', $frontend)
                        ->with('action', 'edit');
                }
                else{
                    return redirect('/errors/417');
                }


            }
            return redirect('/');
        }
        catch(Exception $e){
            return redirect('/errors/417');
        }
    }

    public function update(FrontendEditRequest $request)
    {
        $id                  = Input::get('id');
        $description         = Input::get('description');
        $status              = Input::get('status');

        $paramObj               = FrontEnd::find($id);
        $paramObj->description  = $description;
        $paramObj->status       = $status;
        // $backendRepository = new BackendRepository;
        $result = $this->frontEndRepository->update($paramObj);
        // echo "<pre>";print_r($result);exit();


        return redirect()->action('BackendController@index');
    }

    public function frontend_client(Request $request)
    {
        if (Auth::guard('User')->check()) {
            $frontendClients      = $this->frontEndRepository->getFrontEndClient();
            return view('frontendclient.index')->with('frontendClients', $frontendClients);
        }
        return redirect('/');
    }    
    
}
