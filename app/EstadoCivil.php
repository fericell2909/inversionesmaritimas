<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model
{
    protected $table='estadociviles';
    public $primaryKey ='id';

    public static function Listar_Estados_Civiles()
    {
    	return EstadoCivil::select('estadociviles.id','estadociviles.nombre_estado_civil')
    				->get();
    }
}
