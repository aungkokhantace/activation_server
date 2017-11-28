<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 7/4/2016
 * Time: 3:03 PM
 */

use Illuminate\Database\Seeder;
class Default_UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    DB::table('core_users')->delete();

    $roles = array(
        ['id'=>1, 'user_name'=>'administrator_aceplus', 'password' =>'$2y$10$Iyt699ZKCHYEwL3LGgoH/etE20Nl6g975dMKkHOy72oRjgBAKhGyy', 'email' =>'waiyanaung1@aceplussolutions.com','role_id' =>'9999','staff_id'=>'0001','address'=>'Building 5, Room 10, MICT Park, Hlaing Township, Yangon, Myanmar','description'=>'This is super admin first login role'],
        ['id'=>2, 'user_name'=>'admin_aceplus', 'password' =>'$2y$10$wbHOhVmP001yRaS2sZhXJOsoO0aItWjB9rZ6zrGEIRGbfUjkiNSDK', 'email' =>'waiyanaung@aceplussolutions.com','role_id' =>'1','staff_id'=>'0002','address'=>'Building 5, Room 10, MICT Park, Hlaing Township, Yangon, Myanmar','description'=>'This is Super Admin role'],

    );

    DB::table('core_users')->insert($roles);
}
}