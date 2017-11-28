<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginUserLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_user_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip_address');
            $table->string('time');
            
             //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('login_user_log');
    }
}
