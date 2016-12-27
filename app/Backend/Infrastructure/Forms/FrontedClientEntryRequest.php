<?php
/**
 * Created by PhpStorm.
 * Author: Soe Thandar Aung
 * Date: 8/5/2016
 * Time: 10:58 AM
 */

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;

class FrontedClientEntryRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            "backend_server_id" =>"required",
            "tablet_id" =>"required",
           
        ];
    }
    public function messages(){
        return [
            "backend_server.required" => "Backend Server URL is required",
            "tablet_id.required" => "Tablet ID is required"
           
        ];
    }
}
