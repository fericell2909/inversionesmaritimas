<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCamposOrders extends Migration
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
        $table->unsignedInteger('estado_id')->default(1);
        $table->foreign('estado_id')->references('id')->on('estados');
        
        $table->unsignedInteger('cliente_id')->default(1);
        $table->foreign('cliente_id')->references('id')->on('customers');
        
        $table->string('cliente',300)->default('Cliente Defecto');
        $table->string('cDnicRuc',50)->default('XXXXXXXXX');
        $table->date('FechaDocumento',300)->default('2017-11-09 22:13:32');
        $table->string('cNumeroDocumento',50)->default('B0001-XXXXXXX');

        $table->unsignedInteger('serie_id')->default(1);
        $table->foreign('serie_id')->references('id')->on('series');

        $table->unsignedInteger('tipo_documento_id')->default(1);
        $table->foreign('tipo_documento_id')->references('id')->on('tiposdocumentos');

        $table->unsignedInteger('tipo_pago_id')->default(1);
        $table->foreign('tipo_pago_id')->references('id')->on('tipospagos');

        $table->double('SubTotal', 15, 8)->default(0);
        $table->double('IGv', 15, 8)->default(0);
        $table->double('Total', 15, 8)->default(0);


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
