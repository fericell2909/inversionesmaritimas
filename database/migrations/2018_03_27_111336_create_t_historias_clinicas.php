<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTHistoriasClinicas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historias_clinicas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('pacientes');
            $table->unsignedInteger('sexo_id');
            $table->foreign('sexo_id')->references('id')->on('sexos');
            $table->unsignedInteger('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('historiatipos');
            $table->unsignedInteger('ncorrelativo');
            $table->String('fecha_historia',10);
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->String('nombre_medico',100);
            $table->primary(array('paciente_id', 'tipo_id','ncorrelativo'));
            $table->unsignedInteger('estado_id')->default(1);
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->String('acompanante',100)->nullable();
           
            $table->text('paciente_funciones_biologicas')->nullable();        
            $table->text('paciente_antecedentes_generales')->nullable();
            $table->text('paciente_antecedentes_fisiologicos')->nullable();
            $table->text('paciente_antecedentes_familiares_otros')->nullable();
            $table->text('paciente_antecedentes_patologicos_otros')->nullable();
            $table->string('gineco_menarquia',100)->nullable();
            $table->string('gineco_regimen_catamenial',100)->nullable();
            $table->string('gineco_fur' ,100)->nullable();
            $table->string('gineco_edad_gestacional',100)->nullable();
            $table->string('gineco_gesta',100)->nullable();
            $table->string('gineco_para',100)->nullable();
            $table->string('gineco_irs',100)->nullable();
            $table->string('gineco_urs',100)->nullable();
            $table->string('gineco_mac',100)->nullable();
            $table->string('gineco_tipo_parto',100)->nullable();
            $table->string('gineco_pap',100)->nullable();
            $table->string('gineco_leucorrea',100)->nullable();
            $table->string('gineco_dispareunia',100)->nullable();
            $table->text('paciente_antecedentes_gineco_otros')->nullable();

            $table->string('fisico_pa',100)->nullable();
            $table->string('fisico_pulso',100)->nullable();
            $table->string('fisico_temperatura',100)->nullable();
            $table->string('fisico_frecuencia_respiratoria',100)->nullable();
            $table->string('fisico_sat_o2',100)->nullable();
            $table->string('fisico_imc',100)->nullable();
            $table->string('fisico_talla',100)->nullable();
            $table->string('fisico_peso',100)->nullable();
            $table->text('paciente_observaciones_examen_fisicos')->nullable(); 

            $table->text('paciente_plantrabajo_ayuda_dignostica')->nullable();
            $table->text('paciente_plantrabajo_laboratorio')->nullable();
            $table->text('paciente_plantrabajo_estudio_imagenes')->nullable(); 
            $table->text('paciente_plantrabajo_procedimientos_especiales')->nullable(); 
            $table->text('paciente_plantrabajo_interconsultas')->nullable();  
            $table->text('paciente_plantrabajo_referencia')->nullable(); 
            $table->text('paciente_tratamiento')->nullable();  
            $table->timestamps();
        });

        Schema::create('hc_biologicas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('pacientes');
            $table->unsignedInteger('sexo_id');
            $table->foreign('sexo_id')->references('id')->on('sexos');
            $table->unsignedInteger('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('historiatipos');
            $table->unsignedInteger('ncorrelativo');
            $table->unsignedInteger('estado_id')->default(1);
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->unsignedInteger('bio_id');
            $table->foreign('bio_id')->references('id')->on('maestro_funciones_biologicas');
            $table->unsignedInteger('valor_id');
            $table->primary(array('paciente_id', 'tipo_id','ncorrelativo','bio_id'));
            $table->timestamps();
        });

        Schema::create('hc__familiares', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('pacientes');
            $table->unsignedInteger('sexo_id');
            $table->foreign('sexo_id')->references('id')->on('sexos');
            $table->unsignedInteger('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('historiatipos');
            $table->unsignedInteger('ncorrelativo');
            $table->unsignedInteger('estado_id')->default(1);
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->unsignedInteger('fam_id');
            $table->foreign('fam_id')->references('id')->on('maestro_antecedentes_familiares');
            $table->unsignedInteger('valor_id');
            $table->primary(array('paciente_id', 'tipo_id','ncorrelativo','fam_id'));
            $table->timestamps();
        });

        Schema::create('hc__patologicos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('pacientes');
            $table->unsignedInteger('sexo_id');
            $table->foreign('sexo_id')->references('id')->on('sexos');
            $table->unsignedInteger('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('historiatipos');
            $table->unsignedInteger('ncorrelativo');
            $table->unsignedInteger('estado_id')->default(1);
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->unsignedInteger('pato_id');
            $table->foreign('pato_id')->references('id')->on('maestro_antecedentes_patologico');
            $table->unsignedInteger('valor_id');
            $table->primary(array('paciente_id', 'tipo_id','ncorrelativo','pato_id'));
            $table->timestamps();
        });

         Schema::create('hc__diagnostico', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('pacientes');
            $table->unsignedInteger('sexo_id');
            $table->foreign('sexo_id')->references('id')->on('sexos');
            $table->unsignedInteger('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('historiatipos');
            $table->unsignedInteger('ncorrelativo');
            $table->unsignedInteger('estado_id')->default(1);
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->unsignedInteger('diag_id');
            $table->foreign('diag_id')->references('id')->on('cie10');
            $table->String('id10',20)->nullable();
            $table->String('dec10',500)->nullable();
            $table->unsignedInteger('valor_id');
            $table->primary(array('paciente_id', 'tipo_id','ncorrelativo','diag_id'));
            $table->timestamps();
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
