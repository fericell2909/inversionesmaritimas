<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposPagos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipospagos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_tipo_pago',50);
            $table->timestamps();
        });

        DB::table('tipospagos')->insert([
                                            ['nombre_tipo_pago' => 'Efectivo'],
                                            ['nombre_tipo_pago' => 'Tarjeta'],]);
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipospagos');
    }
}
