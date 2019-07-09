<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
	protected $table='categories';
	public $primaryKey ='id';
	
	public static function Listar(){
		
		return Categories::select('categories.id','categories.name')
			->get();
    }
}
