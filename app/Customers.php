<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $primaryKey = 'id';
         protected $table='customers';


     public static function Registrar_Cliente_Natural_Desde_Paciente($data,$codigo_usuario)
     {

     	$existe =  Customers::select('customers.dni')
     						  ->where('customers.dni',$data['dni'])
     						  ->get();

     	if (count($existe) > 0 ) {
     		return true;
     	} else {
     		$code = rand(5, 10000000000);

        $order = new Customers();
        $order->number = $code;
        $order->name = strval($data['nombres']) . ' ' . strval($data['apellido_paterno']) . ' ' . strval($data['apellido_materno']);

        $order->phone = $data['celular'];
        $order->info = 'Cliente Registrado desde Paciente';
        $order->estado_id = 1;
        $order->dni = $data['dni'];
        $order->tipo = 1;
        $order->address = '';

        $order->save();	
     	}
     	
       return true;
     }
}
