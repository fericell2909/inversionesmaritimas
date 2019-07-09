<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTCotizaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
	        $table->engine = 'InnoDB';
        	$table->increments('id');
	        $table->string('codigogenerado', 10);
	        $table->bigInteger('order_code');
	        $table->unique('order_code');
	        $table->string('invoice_no', 20);
	
	        $table->unsignedInteger('estado_id')->default(1);
	        $table->foreign('estado_id')->references('id')->on('estados');
	
	        $table->unsignedInteger('cliente_id')->default(1);
	        $table->foreign('cliente_id')->references('id')->on('customers');
	
	        $table->string('cliente',300)->default('Cliente Defecto');
	        $table->string('cDnicRuc',50)->default('XXXXXXXXX');
	        $table->date('FechaDocumento',300)->default('2017-11-09 22:13:32');
	        $table->string('cNumeroDocumento',50)->default('B0001-XXXXXXX');
	
	
	        $table->unsignedInteger('user_id')->default(1);
	        $table->foreign('user_id')->references('id')->on('users');
	        
	        $table->double('SubTotal', 15, 8)->default(0);
	        $table->double('IGv', 15, 8)->default(0);
	        $table->double('Total', 15, 8)->default(0);
	        $table->string('email',100)->references('id')->on('users');
	        $table->Integer('nNumeroMedicamentos')->unsigned()->default(0);
	        $table->Integer('nConsultaMedica')->unsigned()->default(0);
	        $table->Integer('nCantidadItemDetalle')->unsigned()->default(0);
	        $table->timestamps();
        });
	
	
	    Schema::create('cotizaciones_detalle', function (Blueprint $table) {
		
		    $table->engine = 'InnoDB';
		    $table->increments('id');
		    $table->string('info', 150)->nullable();
		    $table->bigInteger('order_code');
		    $table->double('price',15,2)->default(0);
		    $table->tinyInteger('quantity');
		    $table->double('SubTotal', 15, 8)->default(0);
		    $table->integer('product_id')->unsigned();
		    $table->foreign('product_id')->references('p_id')->on('products');
		    $table->unsignedInteger('cotizacion_id')->default(1);
		    $table->foreign('cotizacion_id')->references('id')->on('cotizaciones');
		    
		    $table->timestamps();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotizaciones');
    }
}
