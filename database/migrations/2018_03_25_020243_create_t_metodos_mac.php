<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTMetodosMac extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('maestro_macs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_campo');
            $table->unsignedInteger('estado_id')->default(1);
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->timestamps();
        });

        DB::table('maestro_macs')->insert([
            ['nombre_campo' => 'Preservativo masculino'],
            ['nombre_campo' => 'Preservativo Femenino'],
            ['nombre_campo' => 'Anticonceptivos orales'],
            ['nombre_campo' => 'Píldora del día siguiente'],            
            ['nombre_campo' => 'Anillo vaginal'],
            ['nombre_campo' => 'Parche transdérmico'],
            ['nombre_campo' => 'Progestágenos inyectables'],
            ['nombre_campo' => 'Diafragma'],
            ['nombre_campo' => 'DIU'],
            ['nombre_campo' => 'Método de la ovulación o Billings'],
            ]);
    }

    public function down()
    {
         Schema::dropIfExists('maestro_macs');
    }
}
