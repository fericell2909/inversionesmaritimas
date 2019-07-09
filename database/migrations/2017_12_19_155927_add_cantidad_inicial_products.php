<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCantidadInicialProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('products', function (Blueprint $table) {
            $table->Integer('p_cantidad_inicial')->unsigned()->default(0);
        });
    }

    public function down()
    {
        Schema::table('products', function ($table) {
           $table->dropColumn('p_cantidad_inicial');
        });
    }
}
