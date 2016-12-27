<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\BackendEntryRequest;
use App\Backend\Infrastructure\Forms\BackendEditRequest;
use App\Setup\Backend\BackendRepositoryInterface;
use App\Setup\Backend\Backend;
use App\Setup\FrontEnd\FrontEnd;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Setup\Backend\BackendRepository;

class BackendController extends Controller
{
     private $BackendRepository;

    public function __construct(BackendRepositoryInterface $backendRepository)
    {
        $this->backendRepository = $backendRepository;
    }

    public function index(Request $request)
    {
        if (Auth::guard('User')->check()) {
            $backends      = $this->backendRepository->getbackend();
            return view('backend.index')->with('backends', $backends);
        }
        return redirect('/');
    }

    public function create()
    {
    	if (Auth::guard('User')->check()) {
            return view('backend.backend');
        }
        return redirect('/');
    }
   
    public function store(BackendEntryRequest $request)
    {
        $request->validate();
       
        $site_url               			= Input::get('website_url');
        $client_count                       = Input::get('client_count');
        $url 								= substr($site_url,4,-4);
        $generateActivationKey              = uniqid();
        $activation_key	                    = md5($generateActivationKey);

        $description                        = Input::get('description');
        $status                             = Input::get('status');
        $paramObj               			= new Backend();
        $paramObj->website_url     			= $site_url;
        $paramObj->client_count             = $client_count;
        $paramObj->description              = $description;
        $paramObj->backend_activationkey 	= $activation_key;
        $paramObj->status           		= $status;
        $this->backendRepository->create($paramObj);

        return redirect()->action('BackendController@index');
    }

    public function detail($id){
        if(Auth::guard('User')->check()){
            $backend = Backend::find($id);
            return view('backend.detail')->with('backend',$backend);
        }
        return redirect('/');
    }

    public function edit($id)
    {
         if (Auth::guard('User')->check()) {
            $backend = Backend::find($id);
            return view('backend.backend')->with('backend', $backend);
        }
        return redirect('/');
    }

    public function update(BackendEditRequest $request)
    {
        $id                  = Input::get('id');
        $site_url            = Input::get('website_url');
        $client_count        = Input::get('client_count');
        $description         = Input::get('description');
        $status              = Input::get('status');
        $loginID             = session('user');

        $paramObj            = Backend::find($id);
        $paramObj->website_url  = $site_url;
        $paramObj->client_count = $client_count;
        $paramObj->description  = $description;
        $paramObj->status    = $status;
        $paramObj->updated_by= $loginID['id'];

       $this->backendRepository->update($paramObj);

        return redirect()->action('BackendController@index');
    }

    public function detailUpdate()
    {
        $id           = Input::get('id');
        $new_client   = Input::get('new_client');

        $paramObj                       = Backend::find($id);
        $count                          = $paramObj->client_count;
        $total                          = $count + $new_client;
        $paramObj->client_count         = $total;

        $BackendRepo = new BackendRepository();
        $returnObj = $BackendRepo->detailUpdate($paramObj, $new_client);

        return redirect()->action('BackendController@index');
    }


}
