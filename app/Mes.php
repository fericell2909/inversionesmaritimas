<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mes extends Model
{
    protected $table='meses';
    public $primaryKey ='id';

    public static function Listar_Meses()
    {
    	return Mes::select('meses.id','meses.nombre_mes')
    				->get();
    }
}
