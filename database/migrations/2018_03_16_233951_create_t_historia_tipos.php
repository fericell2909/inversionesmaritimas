<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTHistoriaTipos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
         Schema::create('historiatipos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre_historia', 100)->default('');
            $table->unsignedInteger('estado_id')->default(1);
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->timestamps();
        });

    // Insertando historiatipos.

         DB::table('historiatipos')->insert([
            ['nombre_historia' => 'Consulta Externa'],
            ['nombre_historia' => 'Continuadora'],
            ['nombre_historia' => 'Hospitalizacion'],
            ['nombre_historia' => 'Emergencia'],
            ['nombre_historia' => 'Consulta Externa Adicional'],
            ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historiatipos');
    }
}
