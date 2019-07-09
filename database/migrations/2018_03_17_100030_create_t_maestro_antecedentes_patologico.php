<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTMaestroAntecedentesPatologico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('maestro_antecedentes_patologico', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_campo');
            $table->unsignedInteger('tipo_campo_id');
            $table->foreign('tipo_campo_id')->references('id')->on('tipocampos');
            $table->unsignedInteger('estado_id')->default(1);
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->timestamps();
        });

        DB::table('maestro_antecedentes_patologico')->insert([
            ['nombre_campo' => 'Cirugía Previas','tipo_campo_id' => '2'],
            ['nombre_campo' => 'Hipertensión Arterial','tipo_campo_id' => '2'],
            ['nombre_campo' => 'Diabetes Mellitus','tipo_campo_id' => '2'],
            ['nombre_campo' => 'Transfusiones','tipo_campo_id' => '2'],
            ['nombre_campo' => 'Hiperlipemia','tipo_campo_id' => '2'],
            ['nombre_campo' => 'Medicamentos de Uso Frecuentes','tipo_campo_id' => '2'],
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('maestro_antecedentes_patologico');
    }
}
