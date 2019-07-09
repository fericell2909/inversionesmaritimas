<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTGrupoSanguineo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creando la Tabla.
        Schema::create('gruposanguineos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre_grupo', 50)->default('');
            $table->unsignedInteger('estado_id')->default(1);
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->timestamps();
        });

    // Insertando Grupos.

         DB::table('gruposanguineos')->insert([
            ['nombre_grupo' => 'A+'],
            ['nombre_grupo' => 'A-'],
            ['nombre_grupo' => 'B+'],
            ['nombre_grupo' => 'B-'],
            ['nombre_grupo' => 'AB+'],
            ['nombre_grupo' => 'AB-'],
            ['nombre_grupo' => 'O+'],
            ['nombre_grupo' => 'O-'],
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gruposanguineos');
    }
}
