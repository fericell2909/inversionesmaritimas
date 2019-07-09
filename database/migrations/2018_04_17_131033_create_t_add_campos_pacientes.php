<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTAddCamposPacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         
        Schema::table('pacientes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->String('lugarnacimiento',100)->nullable();
            $table->unsignedInteger('estado_civil_id')->default(1);
            $table->foreign('estado_civil_id')->references('id')->on('estadociviles');
            $table->String('CarnetExtranjeria',100)->nullable();
            $table->String('DomicilioActual',100)->nullable();
            $table->String('DomicilioProcedencia',100)->nullable();
            $table->String('GradoInstruccion',100)->nullable();
            $table->String('Ocupacion',100)->nullable();
            $table->String('Religion',100)->nullable();
            $table->String('NombreAcompanante',100)->nullable();
            $table->String('GradoParentesco',100)->nullable();
            $table->String('DomicilioAcompanante',100)->nullable();
        });
    }

}
