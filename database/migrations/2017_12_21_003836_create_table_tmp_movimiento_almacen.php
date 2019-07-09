<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTmpMovimientoAlmacen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('tmp_movimiento_almacen', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('anio', 4)->default('1900');
            $table->Integer('mes')->unsigned()->default(0);
            $table->Integer('product_id')->unsigned()->default(0);
            $table->string('TipoOperacion', 1)->default('I');
            $table->string('SubTipoOperacion', 50)->default('Ingreso');
            $table->date('FechaOperacion');
            $table->string('DescripcionOperacion', 300)->default('');
            $table->string('CorreoUSuarioOperacion', 50)->default('');
            $table->Integer('nIngreso')->unsigned()->default(0);
            $table->Integer('nSalida')->unsigned()->default(0);
            $table->Integer('nSaldo')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('tmp_movimiento_almacen');
    }
}
