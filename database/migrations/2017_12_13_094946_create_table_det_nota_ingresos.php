<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetNotaIngresos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_notaingresos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->unsignedInteger('cab_nota_ingreso_id')->default(1);
            $table->foreign('cab_nota_ingreso_id')->references('id')->on('cab_notaingresos');

            $table->string('info', 150)->nullable();

            $table->unsignedInteger('product_id')->default(1);
            $table->foreign('product_id')->references('p_id')->on('products');

            $table->string('product_gname', 50)->nullable();
            $table->string('product_bname', 50)->nullable();
            $table->tinyInteger('cantidad');
            $table->double('precio_unitario_compra',15,8);
            $table->double('SubTotal', 15, 8)->default(0);         
            
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
        //
    }
}
