<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
        protected $table='settings';
    public $primaryKey ='id';

    public static function Listar_Datos_Empresa()
    {
    	return Settings::all();
    }

}
