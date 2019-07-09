<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNotaIngresos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cab_notaingresos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->unsignedInteger('estado_id')->default(1);
            $table->foreign('estado_id')->references('id')->on('estados');

            $table->unsignedInteger('proveedor_id')->default(1);
            $table->foreign('proveedor_id')->references('id')->on('suppliers');
            $table->string('proveedor_nombre', 30)->nullable();

            $table->unsignedInteger('user_id')->default(1);
            $table->foreign('user_id')->references('id')->on('users');       
            $table->string('usuario_nombre', 191)->nullable();            
            $table->string('usuario_email', 191)->nullable();
            
            $table->unsignedInteger('tipo_documento_id')->default(1);
            $table->foreign('tipo_documento_id')->references('id')->on('tiposdocumentos');  
            
            $table->date('FechaDocumentoIngreso',300)->default('2017-11-09 22:13:32');
            $table->string('documento_no', 20);
            $table->double('SubTotal', 15, 8)->default(0);
            $table->double('Igv', 15, 8)->default(0);
            $table->double('Total', 15, 8)->default(0);
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
        Schema::drop('notaingresos');
    }
}
