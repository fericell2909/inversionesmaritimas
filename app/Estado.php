<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table='estados';
    public $primaryKey ='id';

    public static function Listar_Estados()
    {
    	return Estado::select('estados.id','estados.nombre_estado')
    				->get();
    }
}
