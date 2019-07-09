<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserOrdersAdd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('orders', function(Blueprint $table)
    {
        $table->unsignedInteger('user_id')->default(1);
        $table->foreign('user_id')->references('id')->on('users');
        $table->string('email',100)->references('id')->on('users');



    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
