<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaestroAntecedentesPatologicos extends Model
{
      protected $table='maestro_antecedentes_patologico';
   public $primaryKey ='id';

    public static function Listar_Funciones_Patologicas()
    {
    	return MaestroAntecedentesPatologicos::select('maestro_antecedentes_patologico.id','maestro_antecedentes_patologico.nombre_campo','maestro_antecedentes_patologico.tipo_campo_id')
    				 			->where('maestro_antecedentes_patologico.estado_id',1)
    							->get();
    }
}
