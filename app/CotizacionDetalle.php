<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as DB;

class CotizacionDetalle extends Model {
	
	protected $table='cotizaciones_detalle';
	public $primaryKey='id';

}