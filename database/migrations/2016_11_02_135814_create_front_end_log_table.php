<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrontEndLogTable extends Migration
{
    
    public function up()
    {
         Schema::create('front_end_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('front_end_id');
            $table->string('tablet_id')->nullable();
            $table->string('status')->nullable();
            $table->string('description')->nullable();
               
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
        Schema::drop('front_end_log');
    }
}
