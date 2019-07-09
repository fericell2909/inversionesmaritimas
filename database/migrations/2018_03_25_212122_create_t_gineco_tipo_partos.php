<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTGinecoTipoPartos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('gineco_tipo_partos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_campo');
            $table->unsignedInteger('estado_id')->default(1);
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->timestamps();
        });

        DB::table('gineco_tipo_partos')->insert([
            ['nombre_campo' => 'Cesarea'],
            ['nombre_campo' => 'Eutocito'],
            ]);
    }

    public function down()
    {
         Schema::dropIfExists('gineco_tipo_partos');
    }
}
