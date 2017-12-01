<?php
/**
 * Created by PhpStorm.
 * Author: Soe Thandar Aung
 * Date: 10/21/2016
 * Time: 5:45 PM
 */

namespace App\Api;

use App\Setup\FrontEnd\FrontEnd;
use App\Setup\FrontendClient\FrontendClient;
use App\Setup\FrontendClientLog\FrontendClientLog;
use App\Setup\Backend\Backend;
use App\Core\ReturnMessage;
use App\Core\Utility;
use Illuminate\Support\Facades\DB;


class ApiRepository implements ApiRepositoryInterface
{
   

    public function create($inputAll)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
     
        try {

            $tablet_id              = $inputAll->tablet_id;
            $tablet_activation_key  = $inputAll->tablet_activation_key;
            $frontEnd         = FrontEnd::where('activation_key','=',$tablet_activation_key)->first();

            // Server not found exception case
            if($frontEnd == null || count($frontEnd) == 0){
                $paramObj = new FrontendClientLog();
                $paramObj->tablet_id = $tablet_id;
                $paramObj->tablet_activation_key = $tablet_activation_key;
                $paramObj->description = "Invalid activation key !";
                $paramObj->status = "fail";

                $temp = Utility::addCreatedBy($paramObj);
                $temp->save();

                $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                $returnedObj['aceplusStatusMessage'] = "Invalid activation key !";
                $returnedObj['backend_activation_key']  = $tablet_activation_key;
                $returnedObj['backend_url'] = "";
                return $returnedObj;
            }

            else
            {
                
                //Backend server is inactive
                if($frontEnd->backend->status == 0){
                    $paramObj = new FrontendClientLog();
                    $paramObj->tablet_id = $tablet_id;
                    $paramObj->tablet_activation_key = $tablet_activation_key;
                    $paramObj->description = "Backend server is inactive !!!";
                    $paramObj->status = "fail";

                    $temp = Utility::addCreatedBy($paramObj);
                    $temp->save();

                    $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                    $returnedObj['aceplusStatusMessage'] = "Backend server is inactive !!!";
                    $returnedObj['backend_activation_key']  = $tablet_activation_key;
                    $returnedObj['backend_url'] = "";
                    return $returnedObj;
                }else{
                    // Frontend Client status is "inactive"
                if($frontEnd->status == 0){

                    $paramObj = new FrontendClientLog();
                    $paramObj->tablet_id = $tablet_id;
                    $paramObj->tablet_activation_key = $tablet_activation_key;
                    $paramObj->description = "Frontend client status is inactive !!!";
                    $paramObj->status = "fail";

                    $temp = Utility::addCreatedBy($paramObj);
                    $temp->save();

                    $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                    $returnedObj['aceplusStatusMessage'] = "Your requested frontend client status is inactive !!!";
                    $returnedObj['backend_activation_key']  = $tablet_activation_key;
                    $returnedObj['backend_url'] = "";
                    return $returnedObj;

                    }
                }

                DB::beginTransaction();
                $frontend_id                = $frontEnd->id;
                $backend_id                 = $frontEnd->backend_id;
                $backend_ActivationKey      = Backend::find($backend_id);

                $existingFrontendClient          = FrontendClient::where('front_end_id','=',$frontend_id)->where('backend_id','=',$backend_id)->first();

                if(isset($existingFrontendClient)){

                    // $tempObj                = Utility::addUpdatedBy($existingFrontendClient);
                    // $tempObj->tablet_id     = $tablet_id;
                    // $tempObj->save();

                    if($existingFrontendClient->tablet_id == $tablet_id && $existingFrontendClient->tablet_activation_key == $tablet_activation_key){
                        $paramObj = new FrontendClientLog();
                        $paramObj->front_end_id = $existingFrontendClient->id;
                        $paramObj->backend_id = $backend_id;
                        $paramObj->description = "activated !!!!!";
                        $paramObj->tablet_id = $tablet_id;
                        $paramObj->tablet_activation_key = $tablet_activation_key;
                        $paramObj->status = "pass";

                        $temp = Utility::addCreatedBy($paramObj);
                        $temp->save();

                        DB::commit();
                        $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                        $returnedObj['aceplusStatusMessage'] = "Activated Successfully !!!";
                        $returnedObj['backend_activation_key']  = $backend_ActivationKey->backend_activationkey;;
                        $returnedObj['backend_url'] = "$backend_ActivationKey->website_url;";
                        return $returnedObj;
                    }else{
                        $paramObj = new FrontendClientLog();
                        $paramObj->description = "Key is already used";
                        $paramObj->front_end_id = $existingFrontendClient->id;
                        $paramObj->backend_id = $backend_id;
                        $paramObj->tablet_id = $tablet_id;
                        $paramObj->tablet_activation_key = $tablet_activation_key;
                        $paramObj->status = "fail";

                        $temp = Utility::addCreatedBy($paramObj);
                        $temp->save();

                        DB::commit();
                        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                        $returnedObj['aceplusStatusMessage'] = "Your requested frontend client key is already used !!!";
                        $returnedObj['backend_activation_key']  = $backend_ActivationKey->backend_activationkey;;
                        $returnedObj['backend_url'] = "$backend_ActivationKey->website_url;";
                        return $returnedObj;  
                    }

                    

                }
                else {

                    $param = new FrontendClient();
                    $param->backend_id = $backend_id;
                    $param->front_end_id = $frontend_id;
                    $param->tablet_id = $tablet_id;
                    $param->tablet_activation_key = $tablet_activation_key;
                    $param->description = 'Tablet Activation Created';
                    $param->start_date = date('Y-m-d H:m:i');

                    $tempObj = Utility::addCreatedBy($param);
                    $tempObj->save();

                    $paramObj = new FrontendClientLog();
                    $paramObj->front_end_id = $param->id;
                    $paramObj->backend_id = $backend_id;
                    $paramObj->description = "Activated !!!!!";
                    $paramObj->tablet_id = $tablet_id;
                    $paramObj->tablet_activation_key = $tablet_activation_key;
                    $paramObj->status = "pass";

                    $temp = Utility::addCreatedBy($paramObj);
                    $temp->save();
                }

                DB::commit();
                $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                // $returnedObj['tablet_id']               =  $tablet_id;
                $returnedObj['backend_activation_key'] = $backend_ActivationKey->backend_activationkey;
                $returnedObj['backend_url'] = $backend_ActivationKey->website_url;
                return $returnedObj;

            }
        }
        catch(\Exception $e){
            DB::rollBack();
            $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            $returnedObj['backend_activation_key']  = "";
            $returnedObj['backend_url'] = "";
            return $returnedObj;
        }
    }

    public function check($inputAll)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try {

            $tablet_id              = $inputAll->tablet_id;
            $tablet_activation_key  = $inputAll->tablet_activation_key;
            $frontEnd         = FrontEnd::where('activation_key','=',$tablet_activation_key)->first();

            // Server not found exception case
            if($frontEnd == null || count($frontEnd) == 0){
                $paramObj = new FrontendClientLog();
                $paramObj->tablet_id = $tablet_id;
                $paramObj->tablet_activation_key = $tablet_activation_key;
                $paramObj->description = "Invalid activation key !";
                $paramObj->status = "fail";

                $temp = Utility::addCreatedBy($paramObj);
                $temp->save();

                $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                $returnedObj['aceplusStatusMessage'] = "Invalid activation key !";
                $returnedObj['backend_activation_key']  = $tablet_activation_key;
                $returnedObj['backend_url'] = "";
                return $returnedObj;
            }

            else
            {
                //Backend server is inactive
                if($frontEnd->backend->status == 0){
                    $paramObj = new FrontendClientLog();
                    $paramObj->tablet_id = $tablet_id;
                    $paramObj->tablet_activation_key = $tablet_activation_key;
                    $paramObj->description = "Backend server is inactive !!!";
                    $paramObj->status = "fail";

                    $temp = Utility::addCreatedBy($paramObj);
                    $temp->save();

                    $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                    $returnedObj['aceplusStatusMessage'] = "Backend server is inactive !!!";
                    $returnedObj['backend_activation_key']  = $tablet_activation_key;
                    $returnedObj['backend_url'] = "";
                    return $returnedObj;
                }else{
                    // Frontend Client status is "inactive"
                if($frontEnd->status == 0){

                    $paramObj = new FrontendClientLog();
                    $paramObj->tablet_id = $tablet_id;
                    $paramObj->tablet_activation_key = $tablet_activation_key;
                    $paramObj->description = "Frontend client status is inactive !!!";
                    $paramObj->status = "fail";

                    $temp = Utility::addCreatedBy($paramObj);
                    $temp->save();

                    $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                    $returnedObj['aceplusStatusMessage'] = "Your requested frontend client status is inactive !!!";
                    $returnedObj['backend_activation_key']  = $tablet_activation_key;
                    $returnedObj['backend_url'] = "";
                    return $returnedObj;

                    }
                }

                DB::beginTransaction();
                $frontend_id                = $frontEnd->id;
                $backend_id                 = $frontEnd->backend_id;
                $backend_ActivationKey      = Backend::find($backend_id);

                $existingFrontendClient          = FrontendClient::where('front_end_id','=',$frontend_id)->where('backend_id','=',$backend_id)->where('tablet_id','=',$tablet_id)->first();

                if(isset($existingFrontendClient)){
                    // $paramObj = new FrontendClientLog();
                    // $paramObj->tablet_id = $tablet_id;
                    // $paramObj->tablet_activation_key = $tablet_activation_key;
                    // $paramObj->description = "checking frontend activation key - pass";
                    // $paramObj->status = "pass";

                    // $temp = Utility::addCreatedBy($paramObj);
                    // $temp->save();

                    // $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                    // $returnedObj['aceplusStatusMessage'] = "Your requested frontend client is ACTIVE.";
                    // $returnedObj['backend_activation_key']  = $tablet_activation_key;
                    // $returnedObj['backend_url'] = "";
                    // return $returnedObj;

                    $paramObj = new FrontendClientLog();
                    $paramObj->description = "Key is already used";
                    // $paramObj->front_end_id = $existingFrontendClient->id;
                    // $paramObj->backend_id = $backend_id;
                    $paramObj->tablet_id = $tablet_id;
                    $paramObj->tablet_activation_key = $tablet_activation_key;
                    $paramObj->status = "fail";

                    $temp = Utility::addCreatedBy($paramObj);
                    $temp->save();
                    
                    $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                    $returnedObj['aceplusStatusMessage'] = "Your requested frontend client key is already used !!!";
                    $returnedObj['backend_activation_key']  = $backend_ActivationKey->backend_activationkey;;
                    $returnedObj['backend_url'] = "$backend_ActivationKey->website_url;";
                    return $returnedObj;

                }
                else {

                    $paramObj = new FrontendClientLog();
                    $paramObj->tablet_id = $tablet_id;
                    $paramObj->tablet_activation_key = $tablet_activation_key;
                    $paramObj->description = "checking frontend activation key - fail";
                    $paramObj->status = "fail";

                    $temp = Utility::addCreatedBy($paramObj);
                    $temp->save();

                    $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                    $returnedObj['aceplusStatusMessage'] = "Your requested frontend client is INACTIVE !!!";
                    $returnedObj['backend_activation_key']  = $tablet_activation_key;
                    $returnedObj['backend_url'] = "";
                    return $returnedObj;
                }

            }
        }
        catch(\Exception $e){
            DB::rollBack();
            $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            $returnedObj['backend_activation_key']  = "";
            $returnedObj['backend_url'] = "";
            return $returnedObj;
        }
    }

    
}