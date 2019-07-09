<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
     protected $table='tipospagos';
    public $primaryKey ='id';
    public static function Listar_Tipo_Pago()
    {
    	return TipoPago::select("tipospagos.id as tipo_pago_id","tipospagos.nombre_tipo_pago")
    					->get();
    }
}
