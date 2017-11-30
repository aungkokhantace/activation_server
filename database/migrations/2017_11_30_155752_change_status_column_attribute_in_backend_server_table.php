<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStatusColumnAttributeInBackendServerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::table('backend_server', function (Blueprint $table) {
            $table->integer('status')->default(1)->change();
        });

            Schema::table('front_end', function (Blueprint $table) {
            $table->integer('status')->default(1)->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('backend_server', function (Blueprint $table) {
           $table->string('status',45)->change();
        });

        Schema::table('front_end', function (Blueprint $table) {
            $table->string('status',45)->change();
        });

    }
}
