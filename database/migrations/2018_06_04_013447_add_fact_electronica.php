<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFactElectronica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('nFacturaElectronica')->nullable()->default(0);
            $table->String('cod_sunat',10)->nullable()->default('');
            $table->String('msj_sunat',500)->nullable()->default('');
            $table->String('hash_cdr',500)->nullable()->default('');

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
