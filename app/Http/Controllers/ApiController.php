<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Core\Check;
use App\Core\ReturnMessage;
use Illuminate\Support\Facades\Input;
use App\Api\ApiRepository;

class ApiController extends Controller
{
	public function __construct()
    {
        //
    }

    public function index()
    {
        $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
        $returnedObj['aceplusStatusMessage']    = "Invalid Request !";
        return \Response::json($returnedObj);
    }
    
    public function Activate(){
       
        $temp                   = Input::All();
        $inputAll               = json_decode($temp['param_data']);

        $apiRepo   = new ApiRepository();
        $result    = $apiRepo->create($inputAll);

            if($result['aceplusStatusCode'] == ReturnMessage::OK){

                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                // $returnedObj['tabletId']                = $result['tablet_id'];
                $returnedObj['backend_activation_key']  = $result['backend_activation_key'];
                $returnedObj['backend_url']             = $result['backend_url'];
                
                return \Response::json($returnedObj);
             }    
            else{
                $returnedObj['aceplusStatusCode']       = ReturnMessage::INTERNAL_SERVER_ERROR;
                $returnedObj['aceplusStatusMessage']    = $result['aceplusStatusMessage'];
                // $returnedObj['tabletId']                = $result['tablet_id'];
                $returnedObj['backend_url']             = $result['backend_url'];

                return \Response::json($returnedObj);
            }



    }

    public function check(){

        $temp                   = Input::All();
        $inputAll               = json_decode($temp['param_data']);

        $apiRepo   = new ApiRepository();
        $result    = $apiRepo->check($inputAll);

        if($result['aceplusStatusCode'] == ReturnMessage::OK){

            $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
            $returnedObj['aceplusStatusMessage']    = "Request success !";
            // $returnedObj['tabletId']                = $result['tablet_id'];
            $returnedObj['backend_activation_key']  = $result['backend_activation_key'];
            $returnedObj['backend_url']             = $result['backend_url'];

            return \Response::json($returnedObj);
        }
        else{
            $returnedObj['aceplusStatusCode']       = ReturnMessage::INTERNAL_SERVER_ERROR;
            $returnedObj['aceplusStatusMessage']    = $result['aceplusStatusMessage'];
            // $returnedObj['tabletId']                = $result['tablet_id'];
            $returnedObj['backend_url']             = $result['backend_url'];

            return \Response::json($returnedObj);
        }



    }
}
