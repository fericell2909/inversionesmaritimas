<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cie10 extends Model
{
	protected $table='cie10';
    public $primaryKey ='id';

    public static function Listar_search($name)
    {
         return Cie10::select('cie10.id','cie10.id10','cie10.dec10')
                //->Where('cie10.id10', 'like', "$name%")
                ->Where('cie10.dec10', 'like', "$name%")
                ->OrderBy('cie10.id','desc')
                ->get();
    }
 public static function Devuelve_Datos_Cie10($codigo)
    {

    	return Cie10::select('cie10.id','cie10.id10','cie10.dec10')
    										->where('cie10.id10',$codigo)
    										->get();
    }
}
