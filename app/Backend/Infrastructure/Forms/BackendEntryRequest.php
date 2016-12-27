<?php
/**
 * Created by PhpStorm.
 * Author: Soe Thandar Aung
 * Date: 10/21/2016
 * Time: 10:58 AM
 */

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;

class BackendEntryRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            "website_url" =>"required",
            "client_count" =>"required|integer",
            "description"=>"required",
            "status" => "required"
        ];
    }
    public function messages(){
        return [
            "website_url.required" => "Site URL is required",
            "client_count.required" => "Max Count is required and should be number only",
            "description.required" => "Description is required",
            "status.required" =>"Status is required"
        ];
    }
}
