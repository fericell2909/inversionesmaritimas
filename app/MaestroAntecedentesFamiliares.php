<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaestroAntecedentesFamiliares extends Model
{
       protected $table='maestro_antecedentes_familiares';
   public $primaryKey ='id';

    public static function Listar_Funciones_Familiares()
    {
    	return MaestroAntecedentesFamiliares::select('maestro_antecedentes_familiares.id','maestro_antecedentes_familiares.nombre_campo','maestro_antecedentes_familiares.tipo_campo_id')
    				 			->where('maestro_antecedentes_familiares.estado_id',1)
    							->get();
    }
}
