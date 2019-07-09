<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTPacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::create('pacientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('apellido_paterno',100);
            $table->string('apellido_materno',100);
            $table->string('nombres',100);
            $table->string('dni',8)->unique();
            $table->unsignedInteger('sexo_id')->default(1);
            $table->foreign('sexo_id')->references('id')->on('sexos');
            $table->string('direccion',200)->nullable();
            $table->string('telefono',50)->nullable();
            $table->string('celular',50)->nullable();
            $table->date('fecha_nacimiento');
            $table->unsignedInteger('edad');
            $table->unsignedInteger('grupo_sanguineo_id')->default(1);
            $table->foreign('grupo_sanguineo_id')->references('id')->on('gruposanguineos');
            $table->unsignedInteger('estado_id')->default(1);
            $table->foreign('estado_id')->references('id')->on('estados');
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
        Schema::dropIfExists('pacientes');
    }
}
