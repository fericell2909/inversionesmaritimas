<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablaSeries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('series', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tipo_documento_id')->default(1);
            $table->foreign('tipo_documento_id')->references('id')->on('tiposdocumentos');
            $table->integer('nNumero');
            $table->string('cDenominacionSerie',4);
            $table->integer('nCorrelativo'); 
            $table->timestamps();
        });

        DB::table('series')->insert([
                                    ['tipo_documento_id'=>'1','nNumero'=>1,'cDenominacionSerie'=>'F001','nCorrelativo' => 0],
                                    ['tipo_documento_id'=>'2','nNumero'=>1,'cDenominacionSerie'=>'B001','nCorrelativo' => 0],
                                    ['tipo_documento_id'=>'3','nNumero'=>1,'cDenominacionSerie'=>'N001','nCorrelativo' => 0],
                                    ['tipo_documento_id'=>'4','nNumero'=>1,'cDenominacionSerie'=>'D001','nCorrelativo' => 0],
                                    ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('series');
    }
}
