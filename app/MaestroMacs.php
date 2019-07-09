<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaestroMacs extends Model
{
     protected $table='maestro_macs';
   public $primaryKey ='id';

    public static function Listar_Macs()
    {
    	return MaestroMacs::select('maestro_macs.id','maestro_macs.nombre_campo')
    				 			->where('maestro_macs.estado_id',1)
    							->get();
    }
}
