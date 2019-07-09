<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRangoHoras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('rangohoras', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('descripcion_rango', 50)->nullable();
            $table->string('string_numero_rango', 50)->nullable();
            $table->timestamps();
        });


         DB::table('rangohoras')->insert([
            ['descripcion_rango' => '00:00 - 00:59','string_numero_rango' => '00'],
            ['descripcion_rango' => '01:00 - 01:59','string_numero_rango' => '01'],
            ['descripcion_rango' => '02:00 - 02:59','string_numero_rango' => '02'],
            ['descripcion_rango' => '03:00 - 03:59','string_numero_rango' => '03'],
            ['descripcion_rango' => '04:00 - 04:59','string_numero_rango' => '04'],
            ['descripcion_rango' => '05:00 - 05:59','string_numero_rango' => '05'],
            ['descripcion_rango' => '06:00 - 06:59','string_numero_rango' => '06'],
            ['descripcion_rango' => '07:00 - 07:59','string_numero_rango' => '07'],
            ['descripcion_rango' => '08:00 - 08:59','string_numero_rango' => '08'],
            ['descripcion_rango' => '09:00 - 09:59','string_numero_rango' => '09'],
            ['descripcion_rango' => '10:00 - 10:59','string_numero_rango' => '10'],
            ['descripcion_rango' => '11:00 - 11:59','string_numero_rango' => '11'],
            ['descripcion_rango' => '12:00 - 12:59','string_numero_rango' => '12'],
            ['descripcion_rango' => '13:00 - 13:59','string_numero_rango' => '13'],
            ['descripcion_rango' => '14:00 - 14:59','string_numero_rango' => '14'],
            ['descripcion_rango' => '15:00 - 15:59','string_numero_rango' => '15'],
            ['descripcion_rango' => '16:00 - 16:59','string_numero_rango' => '16'],
            ['descripcion_rango' => '17:00 - 17:59','string_numero_rango' => '17'],
            ['descripcion_rango' => '18:00 - 18:59','string_numero_rango' => '18'],
            ['descripcion_rango' => '19:00 - 19:59','string_numero_rango' => '19'],
            ['descripcion_rango' => '20:00 - 20:59','string_numero_rango' => '20'],
            ['descripcion_rango' => '21:00 - 21:59','string_numero_rango' => '21'],
            ['descripcion_rango' => '22:00 - 22:59','string_numero_rango' => '22'],
            ['descripcion_rango' => '23:00 - 23:59','string_numero_rango' => '23'],
            ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rangohoras');
    }
}
