<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablaTiposDocumentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiposdocumentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion_tipo_documento',50);
            $table->timestamps();
        });

        DB::table('tiposdocumentos')->insert([
                                             ['descripcion_tipo_documento' => 'Factura'],
                                             ['descripcion_tipo_documento' => 'Boleta'],
                                             ['descripcion_tipo_documento' => 'Nota de Credito'],
                                             ['descripcion_tipo_documento' => 'Nota de Debito'],
                                             ]);
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
