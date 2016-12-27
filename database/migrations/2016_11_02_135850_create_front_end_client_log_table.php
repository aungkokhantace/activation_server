<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrontendClientLogTable extends Migration
{
   
    public function up()
    {
        Schema::create('front_end_client_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('backend_id');
            $table->integer('front_end_id');
            $table->string('tablet_id');
            $table->string('tablet_activation_key');
            $table->string('status',45);
            $table->string('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('created_by')->default(1);
            $table->integer('updated_by')->default(1);
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

           
        });
    }

    public function down()
    {
        Schema::drop('front_end_client_log');
    }
}
