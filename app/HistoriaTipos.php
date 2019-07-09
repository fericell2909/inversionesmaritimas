<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriaTipos extends Model
{
    
   protected $table='historiatipos';
   public $primaryKey ='id';

    public static function Listar_Historia_Tipos()
    {
    	return HistoriaTipos::select('historiatipos.id','historiatipos.nombre_historia')
    				 ->where('historiatipos.estado_id',1)
    				->get();
    }
}
