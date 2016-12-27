<?php
/**
 * Created by PhpStorm.
 * Author: Soe Thandar Aung
 * Date: 10/21/2016
 * Time: 11:42 AM
 */

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;

class BackendEditRequest extends Request
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
            "description" => "required",
            "status" =>"required"
        ];
    }
    public function messages(){
        return [
            "website_url.required" => "Site URL is required",
            "client_count.required" => "Max Count is required",
            "description.required" => "Description is required",
            "status.required" => "Status is required"
        ];
    }
}
