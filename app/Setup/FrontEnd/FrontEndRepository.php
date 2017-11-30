<?php
/**
 * Created by PhpStorm.
 * Author: Soe Thandar Aung
 * Date: 8/5/2016
 * Time: 2:20 PM
 */

namespace App\Setup\FrontEnd;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Setup\FrontEnd\FrontEnd;
use App\Setup\FrontEndLog\FrontEndLog;
use App\Setup\FrontendClient\FrontendClient;
use App\Core\Utility;
use App\Core\ReturnMessage;

class FrontEndRepository implements FrontEndRepositoryInterface
{
    public function getFrontEnd()
    {
        $frontends = FrontEnd::all();

        return $frontends;
    }

    public function getFrontEndClient()
    {
        $frontendCleints = FrontendClient::whereNull('deleted_at')->get();

        return $frontendCleints;
    }

    public function getFrontEndByBackendId($backendId)
    {
        $frontends = DB::select("SELECT * FROM front_end WHERE backend_id = $backendId");
        $returnArr = array();
        if(isset($frontends) && count($frontends)>0){
            foreach($frontends as $frontend){
                $returnArr[$frontend->id] = $frontend;
            }
        }

        return $returnArr;
    }

    public function updateStatus($frontId,$status)
    {
        $frontend = FrontEnd::find($frontId);
        if(isset($frontend) && count($frontend)>0){
            $frontend->status = $status;
            $frontend->save();

            //Save Front End Server Log
                $id = $frontend->id;
                $fronted_log = new FrontEndLog();
                $fronted_log->front_end_id = $id;
                $fronted_log->description = "Status change !!!";

                $log = Utility::addCreatedBy($fronted_log);
                $log->save();
        }
    }

    public function update($paramObj)
    {

        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try {

            $tempObj = Utility::addUpdatedBy($paramObj);
            $tempObj->save();

            //Save Front End Server Log
                $id = $paramObj->id;
                $fronted_log = new FrontEndLog();
                $fronted_log->front_end_id = $id;
                $fronted_log->description = "updated";

                $log = Utility::addCreatedBy($fronted_log);
                $log->save();

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(Exception $e){

            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

}