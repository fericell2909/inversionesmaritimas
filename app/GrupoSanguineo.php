<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoSanguineo extends Model
{
   
   protected $table='gruposanguineos';
   public $primaryKey ='id';

    public static function Listar_Grupos()
    {
    	return GrupoSanguineo::select('gruposanguineos.id','gruposanguineos.nombre_grupo')
    				 ->where('gruposanguineos.estado_id',1)
    				->get();
    }

}
