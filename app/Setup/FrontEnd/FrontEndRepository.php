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
use App\Core\Utility;

class FrontEndRepository implements FrontEndRepositoryInterface
{
    public function getFrontEnd()
    {
        $frontends = FrontEnd::all();

        return $frontends;
    }

}