<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCamposHistoriaClinica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('historias_clinicas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->text('paciente_general_apreciacion')->nullable();
            $table->text('paciente_general_piel_faneras')->nullable();
            $table->text('paciente_general_conjuntivas')->nullable();
            $table->text('paciente_general_cuello')->nullable();
            $table->text('paciente_general_torax_pulmones')->nullable();
            $table->text('paciente_general_cardiovascular')->nullable();
            $table->text('paciente_general_abdomen')->nullable();
            $table->text('paciente_general_genito_urinario')->nullable();
            $table->text('paciente_general_sistema_nervioso')->nullable();

        });
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
