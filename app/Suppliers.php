<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    protected $primaryKey = 'id';
  protected $table='suppliers';
  public static function Listar_Proveedores()
  {
  	return Suppliers::select('suppliers.id','suppliers.name')
  					->where('suppliers.estado_id',1)
  					->get();
  }
  public static function Devuelve_Nombre_Proveedor($codigo_proveedor)
  {

  	$proveedor = Suppliers::select('suppliers.name')
  					->where('suppliers.estado_id',1)
  					->where('suppliers.id',$codigo_proveedor)
  					->get(); 


  	if (count($proveedor) > 0) {
		return $proveedor[0]->name; 	  		
  	}else
  	{
  		return '';
  	}
  }
}
