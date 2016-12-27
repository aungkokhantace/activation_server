<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBackendServerLogTable extends Migration
{
    
    public function up()
    {
        Schema::create('backend_server_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('backend_id');
            $table->string('description');
               
            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();

           
        });
    }

    public function down()
    {
         Schema::drop('backend_server_log');
    }
}
