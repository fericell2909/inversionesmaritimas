<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCampoBHistoriaClinicaNNumeroHistoriaClinica extends Migration
{

      public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->Integer('bHistoriaClinica')->unsigned()->default(0);
            $table->Integer('nNumeroHistoriaClinica')->unsigned()->default(0);
        });
    }

    public function down()
    {
        Schema::table('pacientes', function ($table) {
           $table->dropColumn('bHistoriaClinica');
           $table->dropColumn('nNumeroHistoriaClinica');
        });
    }
}
