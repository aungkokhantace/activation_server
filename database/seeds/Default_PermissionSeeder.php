<?php
/**
 * Created by PhpStorm.
 * Author: Soe Thandar Aung
 * Date: 11/2/2016
 * Time: 2:18 PM
 */
use Illuminate\Database\Seeder;
class Default_PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('core_permissions')->delete();

        $permissions = array(

            // Roles
            ['id'=>1,'module'=>'Role','name'=>'Listing','description'=>'Role Listing','url'=>'role'],
            ['id'=>2,'module'=>'Role','name'=>'New','description'=>'Role New','url'=>'role/create'],
            ['id'=>3,'module'=>'Role','name'=>'Store','description'=>'Role Store','url'=>'role/store'],
            ['id'=>4,'module'=>'Role','name'=>'Edit','description'=>'Role Edit','url'=>'role/edit'],
            ['id'=>5,'module'=>'Role','name'=>'Update','description'=>'Role Update','url'=>'role/update'],
            ['id'=>6,'module'=>'Role','name'=>'Destroy','description'=>'Role Destroy','url'=>'role/destroy'],
            ['id'=>7,'module'=>'Role','name'=>'Permission View','description'=>'Role Permission View','url'=>'rolePermission'],
            ['id'=>8,'module'=>'Role','name'=>'Permission Assign','description'=>'Role Permission Assign','url'=>'rolePermissionAssign'],

            // Users
            ['id'=>9,'module'=>'User','name'=>'Listing','description'=>'User Listing','url'=>'user'],
            ['id'=>10,'module'=>'User','name'=>'New','description'=>'User New','url'=>'user/create'],
            ['id'=>11,'module'=>'User','name'=>'Store','description'=>'User Store','url'=>'user/store'],
            ['id'=>12,'module'=>'User','name'=>'Edit','description'=>'User Edit','url'=>'user/edit'],
            ['id'=>13,'module'=>'User','name'=>'Update','description'=>'User Update','url'=>'user/update'],
            ['id'=>14,'module'=>'User','name'=>'Destroy','description'=>'User Destroy','url'=>'user/destroy'],
            ['id'=>15,'module'=>'User','name'=>'Auth','description'=>'Getting Auth User','url'=>'userAuth'],
            ['id'=>16,'module'=>'User','name'=>'Profile','description'=>'User Profile','url'=>'user/profile'],

            // Permissions
            ['id'=>17,'module'=>'Permission','name'=>'Listing','description'=>'Permission Listing','url'=>'permission'],
            ['id'=>18,'module'=>'Permission','name'=>'New','description'=>'Permission New','url'=>'permission/create'],
            ['id'=>19,'module'=>'Permission','name'=>'Store','description'=>'Permission Store','url'=>'permission/store'],
            ['id'=>20,'module'=>'Permission','name'=>'Edit','description'=>'Permission Edit','url'=>'permission/edit'],
            ['id'=>21,'module'=>'Permission','name'=>'Update','description'=>'Permission Update','url'=>'permission/update'],
            ['id'=>22,'module'=>'Permission','name'=>'Destroy','description'=>'Permission Destroy','url'=>'permission/destroy'],

            // Configs
            ['id'=>23,'module'=>'Config','name'=>'View','description'=>'Editing','url'=>'config'],

            // Customer
            ['id'=>24,'module'=>'Customer','name'=>'Listing','description'=>'Customer Listing','url'=>'customer'],
            ['id'=>25,'module'=>'Customer','name'=>'New','description'=>'Customer New','url'=>'customer/create'],
            ['id'=>26,'module'=>'Customer','name'=>'Store','description'=>'Customer Store','url'=>'customer/store'],
            ['id'=>27,'module'=>'Customer','name'=>'Edit','description'=>'Customer Edit','url'=>'customer/edit'],
            ['id'=>28,'module'=>'Customer','name'=>'Update','description'=>'Customer Update','url'=>'customer/update'],
            ['id'=>29,'module'=>'Customer','name'=>'Destroy','description'=>'Customer Destroy','url'=>'customer/destroy'],

            ['id'=>30,'module'=>'Backend','name'=>'Listing','description'=>'Backend Listing','url'=>'backend'],
            ['id'=>31,'module'=>'Backend','name'=>'New','description'=>'Backend New','url'=>'backend/create'],
            ['id'=>32,'module'=>'Backend','name'=>'Store','description'=>'Backend Store','url'=>'backend/store'],
            ['id'=>33,'module'=>'Backend','name'=>'Edit','description'=>'Backend Edit','url'=>'backend/edit'],
            ['id'=>34,'module'=>'Backend','name'=>'Update','description'=>'Backend Update','url'=>'backend/update'],
            ['id'=>35,'module'=>'Backend','name'=>'Detail','description'=>'Backend Detail','url'=>'backend/detail'],
            ['id'=>36,'module'=>'Backend','name'=>'Detail Update','description'=>'Backend Update','url'=>'backend/detail/update'],
            ['id'=>37,'module'=>'Frontend','name'=>'Listing','description'=>'Listing','url'=>'frontend'],
            ['id'=>38,'module'=>'Frontend','name'=>'Log','description'=>'Backend','url'=>'log/backend'],
            ['id'=>39,'module'=>'Frontend','name'=>'Log','description'=>'Frontend','url'=>'log/frontend'],
            ['id'=>40,'module'=>'Frontend','name'=>'Log','description'=>'Activation','url'=>'log/activation'],
            ['id'=>41,'module'=>'Frontend','name'=>'Update Status','description'=>'Update Status','url'=>'frontend/updatestatus'],
            ['id'=>42,'module'=>'Frontend','name'=>'Update','description'=>'Update Frontend','url'=>'frontend/update'],
            ['id'=>43,'module'=>'Frontend','name'=>'Edit','description'=>'Edit Frontend','url'=>'frontend/edit'],

        );

        DB::table('core_permissions')->insert($permissions);
    }
}