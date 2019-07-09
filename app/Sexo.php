<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
     protected $table='sexos';
    public $primaryKey ='id';

    public static function Listar_Sexos()
    {
    	return Sexo::select('sexos.id','sexos.nombre_sexo')
    				 ->where('sexos.estado_id',1)
    				->get();
    }

}
