<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBackendServerTable extends Migration
{
   
    public function up()
    {
         Schema::create('backend_server', function (Blueprint $table) {
            $table->increments('id');
            $table->string('website_url');
            $table->integer('client_count')->nullable();
            $table->string('description');
            $table->string('backend_activationkey');
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
       Schema::drop('backend_server');
    }
}
