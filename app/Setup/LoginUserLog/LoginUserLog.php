<?php
/**
 * Created by PhpStorm.
 * Author: Soe Thandar Aung
 * Date: 11/2/2016
 * Time: 5:12 PM
 */

namespace App\Setup\LoginUserLog;

use Illuminate\Database\Eloquent\Model;

class LoginUserLog extends Model
{
    protected $table = 'login_user_log';

    protected $fillable = [
        'ip_address','time',
        'created_by','updated_by','deleted_by','created_at','updated_at','deleted_at'
    ];

    
}
