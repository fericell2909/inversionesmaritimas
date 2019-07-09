<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTEstadoCivil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('estadociviles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->String('nombre_estado_civil',50);
            $table->unsignedInteger('estado_id')->default(1);
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->timestamps();
        });


         DB::table('estadociviles')->insert([
            ['nombre_estado_civil' => 'Soltero(a)','estado_id' => '1'],
            ['nombre_estado_civil' => 'Casado(a)','estado_id' => '1'],
            ['nombre_estado_civil' => 'Divorciado(a)','estado_id' => '1'],            
            ['nombre_estado_civil' => 'Viudo(a)','estado_id' => '1'],
            ['nombre_estado_civil' => 'Conviviente(a)','estado_id' => '1'],
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
