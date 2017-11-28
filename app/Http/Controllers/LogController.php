<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 12/28/2016
 * Time: 11:25 AM
 */


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
use App\Log\LogRepository;

class LogController extends Controller
{
    public function __construct()
    {
    }

    public function backend()
    {
        if (Auth::guard('User')->check()) {
            $logRepo = new LogRepository();
            $backends      = $logRepo->getBackend();

            if(isset($backends) && count($backends)>0){

                foreach($backends as $index => $backend ) {

                    $backendId = $backend->id;
                    $frontendActiveCount = $logRepo->getFrontendActiveCountByServer($backendId);
                    $frontendInActiveCount = $logRepo->getFrontendInActiveCountByServer($backendId);

                    $backends[$index]->client_active_count = $frontendActiveCount;
                    $backends[$index]->client_inactive_count = $frontendInActiveCount;
                }
            }

            return view('log.backend')->with('backends', $backends);
        }
        return redirect('/');
    }

    public function frontend()
    {
        if (Auth::guard('User')->check()) {
            $logRepo = new LogRepository();
            $backends      = $logRepo->getBackendByIndex();
            $frontends      = $logRepo->getFrontend();

            if(isset($backends) && count($backends)>0){

                foreach($frontends as $index => $frontend ) {

                    $backendId = $frontend->backend_id;
                    $frontendId = $frontend->id;
                    $frontends[$index]->website_url  = $backends[$backendId]->website_url;

                    $accessCount = $logRepo->getFrontendAccessCount($frontendId);
                    $frontends[$index]->access_total_count = $accessCount;
                }
            }

            return view('log.frontend')->with('frontends', $frontends);
        }
        return redirect('/');
    }

    public function activation()
    {
        if (Auth::guard('User')->check()) {
            $logRepo = new LogRepository();
            $backends       = $logRepo->getBackendByIndex();
            $frontends      = $logRepo->getFrontendByIndex();
            $frontendLogs   = $logRepo->getFrontendLog();

            if(isset($backends) && count($backends)>0){

                foreach($frontendLogs as $index => $frontendLog ) {
                    $backendId = $frontendLog->backend_id;
                    $frontendId = $frontendLog->front_end_id;

                    if($backendId != 0){
                        $frontendLogs[$index]->website_url  = $backends[$backendId]->website_url;
                    }
                    else{
                        $frontendLogs[$index]->website_url  = "";
                    }

                    if($frontendId != 0) {
                        $frontendLogs[$index]->activation_key = $frontends[$frontendId]->activation_key;
                    }
                    else{
                        $frontendLogs[$index]->activation_key = "";
                    }
                }
            }

            return view('log.activation')->with('frontendLogs', $frontendLogs);
        }
        return redirect('/');
    }

    public function loginuserlog(){
        if (Auth::guard('User')->check()) {
            $logRepo = new LogRepository();
            $loginuserlogs      = $logRepo->getloginuserlog();

            return view('log.loginuserlog')->with('loginuserlogs', $loginuserlogs);
        }
        return redirect('/');
    }

}
