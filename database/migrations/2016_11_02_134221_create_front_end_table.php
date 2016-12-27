<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrontEndTable extends Migration
{
   
    public function up()
    {
       Schema::create('front_end', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('backend_id');
            $table->string('activation_key');
            $table->string('description');
            $table->string('status',45);
            $table->integer('created_by')->default(1);
            $table->integer('updated_by')->default(1);
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            
        });    
    }

   
    public function down()
    {
        Schema::drop('front_end');
    }
}
