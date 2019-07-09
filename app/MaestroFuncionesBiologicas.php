<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaestroFuncionesBiologicas extends Model
{
    protected $table='maestro_funciones_biologicas';
   public $primaryKey ='id';

    public static function Listar_Funciones_Biologicas()
    {
    	return MaestroFuncionesBiologicas::select('maestro_funciones_biologicas.id','maestro_funciones_biologicas.nombre_campo')
    				 ->where('maestro_funciones_biologicas.estado_id',1)
    				->get();
    }
}
