<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GinecoTipoPartos extends Model
{
   protected $table='gineco_tipo_partos';
   public $primaryKey ='id';

    public static function Listar_Tipo_Partos()
    {
    	return GinecoTipoPartos::select('gineco_tipo_partos.id','gineco_tipo_partos.nombre_campo')
    				 			->where('gineco_tipo_partos.estado_id',1)
    							->get();
    }
}
