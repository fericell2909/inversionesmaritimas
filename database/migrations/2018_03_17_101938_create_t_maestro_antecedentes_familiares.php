<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTMaestroAntecedentesFamiliares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('maestro_antecedentes_familiares', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_campo');
            $table->unsignedInteger('tipo_campo_id');
            $table->foreign('tipo_campo_id')->references('id')->on('tipocampos');
            $table->unsignedInteger('estado_id')->default(1);
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->timestamps();
        });

        DB::table('maestro_antecedentes_familiares')->insert([
            ['nombre_campo' => 'Cáncer de Mama','tipo_campo_id' => '2'],
            ['nombre_campo' => 'Cáncer Cervix','tipo_campo_id' => '2'],
            ['nombre_campo' => 'Otros Cáncer','tipo_campo_id' => '2'],
            ['nombre_campo' => 'Hipertension Arterial','tipo_campo_id' => '2'],
            ['nombre_campo' => 'Diabetes Mellitus','tipo_campo_id' => '2'],
            ['nombre_campo' => 'Esposo(Pareja)','tipo_campo_id' => '2'],
            ]);
    }

    public function down()
    {
         Schema::dropIfExists('maestro_antecedentes_familiares');
    }
}
