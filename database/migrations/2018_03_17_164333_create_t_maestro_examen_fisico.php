<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTMaestroExamenFisico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('maestro_examen_fisico', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_campo');
            $table->unsignedInteger('tipo_campo_id');
            $table->foreign('tipo_campo_id')->references('id')->on('tipocampos');
            $table->unsignedInteger('estado_id')->default(1);
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->timestamps();
        });

        DB::table('maestro_examen_fisico')->insert([
            ['nombre_campo' => 'P.A.','tipo_campo_id' => '1'],
            ['nombre_campo' => 'Pulso','tipo_campo_id' => '1'],
            ['nombre_campo' => 'T.','tipo_campo_id' => '1'],            
            ['nombre_campo' => 'F.R.','tipo_campo_id' => '1'],
            ['nombre_campo' => 'Sat O2','tipo_campo_id' => '1'],
            ['nombre_campo' => 'Talla','tipo_campo_id' => '1'],
            ['nombre_campo' => 'Peso','tipo_campo_id' => '1'],
            ['nombre_campo' => 'IMC:','tipo_campo_id' => '1'],
            ]);
    }

    public function down()
    {
         Schema::dropIfExists('maestro_examen_fisico');
    }
}
