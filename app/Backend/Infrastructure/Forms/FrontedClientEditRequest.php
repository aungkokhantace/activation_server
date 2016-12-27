<?php
/**
 * Created by PhpStorm.
 * Author: Soe Thandar Aung
 * Date: 8/5/2016
 * Time: 11:11 AM
 */

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;

class FrontedClientEditRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            "backend_server_id" =>"required",
            "tablet_id" =>"required"
        ];
    }
    public function messages(){
        return [
            "backend_server_id.required"=>"Backend Server Name is required",
            "tablet_id.required" => "Tablet ID is required"
            
        ];
    }
}
