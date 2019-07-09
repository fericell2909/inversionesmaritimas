<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
	protected $table='sub_categories';
	public $primaryKey ='id';
	
	public static function Listar_SubCategorias()
	{
		return SubCategories::select('sub_categories.id','sub_categories.name',
			                                  'sub_categories.categories_id','categories.name as nombrecategoria',
												'sub_categories.estado_id','estados.nombre_estado')
			->join('categories','categories.id','=','sub_categories.categories_id')
			->join('estados','estados.id','=','sub_categories.estado_id')
			->get();
	}
}
