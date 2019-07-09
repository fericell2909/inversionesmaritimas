<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTMaestroAntecedentesGineco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('maestro_antecedentes_gineco', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_campo');
            $table->unsignedInteger('tipo_campo_id');
            $table->foreign('tipo_campo_id')->references('id')->on('tipocampos');
            $table->unsignedInteger('estado_id')->default(1);
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->timestamps();
        });

        DB::table('maestro_antecedentes_gineco')->insert([
            ['nombre_campo' => 'MENARQUIA','tipo_campo_id' => '2'],
            ['nombre_campo' => 'REGIMEN CATAMENIAL','tipo_campo_id' => '1'],
            ['nombre_campo' => 'FUR','tipo_campo_id' => '3'],
            ['nombre_campo' => 'EDAD GESTACIONAL','tipo_campo_id' => '1'],
            ['nombre_campo' => 'GESTA','tipo_campo_id' => '1'],
            ['nombre_campo' => 'PARA','tipo_campo_id' => '1'],
            ['nombre_campo' => 'FUP','tipo_campo_id' => '3'],
            ['nombre_campo' => 'TIPO PARTO','tipo_campo_id' => '2'],
            ['nombre_campo' => 'PAP','tipo_campo_id' => '1'],
            ['nombre_campo' => 'LEUCORREA','tipo_campo_id' => '2'],
            ['nombre_campo' => 'DISPAREUMIA','tipo_campo_id' => '2'],
            ['nombre_campo' => 'IRS','tipo_campo_id' => '1'],
            ['nombre_campo' => 'URS','tipo_campo_id' => '2'],
            ['nombre_campo' => 'SINTOMAS CLIMATERICOS','tipo_campo_id' => '1'],
            ['nombre_campo' => 'MAC','tipo_campo_id' => '2'],
            ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('maestro_antecedentes_gineco');
    }
}
