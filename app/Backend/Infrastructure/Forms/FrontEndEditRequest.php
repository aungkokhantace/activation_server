<?php
/**
 * Created by PhpStorm.
 * Author: Soe Thandar Aung
 * Date: 8/5/2016
 * Time: 11:11 AM
 */

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;

class FrontEndEditRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [

            "status" =>"required"
        ];
    }
    public function messages(){
        return [
            "status.required"=>"Status is required"
          
        ];
    }
}
