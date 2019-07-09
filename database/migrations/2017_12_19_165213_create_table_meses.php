<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMeses extends Migration
{

    public function up()
    {
        Schema::create('meses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre_mes', 50)->default('');
            $table->timestamps();
        });

        // Insertando Registros en la Tabla Meses.

        DB::table('meses')->insert([
            ['nombre_mes' => 'Enero'],
            ['nombre_mes' => 'Febrero'],
            ['nombre_mes' => 'Marzo'],
            ['nombre_mes' => 'Abril'],
            ['nombre_mes' => 'Mayo'],
            ['nombre_mes' => 'Junio'],
            ['nombre_mes' => 'Julio'],
            ['nombre_mes' => 'Agosto'],
            ['nombre_mes' => 'Setiembre'],
            ['nombre_mes' => 'Octubre'],
            ['nombre_mes' => 'Noviembre'],
            ['nombre_mes' => 'Diciembre'],
            ]);

    }

    public function down()
    {
        Schema::drop('meses');
    }
}
