<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateCreateTMaestroFuncionesBiologicas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
         Schema::create('maestro_funciones_biologicas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_campo');
            $table->unsignedInteger('tipo_campo_id');
            $table->foreign('tipo_campo_id')->references('id')->on('tipocampos');
            $table->unsignedInteger('estado_id')->default(1);
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->timestamps();
        });

        DB::table('maestro_funciones_biologicas')->insert([
            ['nombre_campo' => 'Apetito','tipo_campo_id' => '2'],
            ['nombre_campo' => 'Sueño','tipo_campo_id' => '2'],
            ['nombre_campo' => 'Sed','tipo_campo_id' => '2'],            
            ['nombre_campo' => 'Orina','tipo_campo_id' => '2'],
            ['nombre_campo' => 'Deposición','tipo_campo_id' => '2'],
            ]);
    }

    public function down()
    {
         Schema::dropIfExists('maestro_funciones_biologicas');
    }
}
