<?php

namespace App;

use App\Sales;
use App\TipoDocumento;
use App\Serie;
use App\TipoPago;
use App\Products;
use App\Customers;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as DB;

class Orders extends Model
{
  public static function ValidaStockProductoVenta($datos,&$bvalidacion,&$bmensaje)
  {
     $bhaystock = true;
      
       for ($i=0; $i < count($datos['productID']); $i++) { 
           // No hay Stock Disponible.
           $bhaystock = Products::ValidaStockProducto($datos['productID'][$i],$datos['orderQuantity'][$i]);
          
           if (!($bhaystock)) {
               $bvalidacion =  false;
               $bmensaje = 'No Existe Stock Disponible para el producto : ' . Products::devuelveNombreProducto($datos['productID']);        
              break;
           } 
       }    
  }

  public static function ValidaClienteTipoDocumento($datos)
  {
      $bresultado = false;

      $tipo_cliente =  Customers::select('customers.tipo')
                                  ->where('customers.id',$datos['cliente_id'])
                                  ->get();

      if (count($tipo_cliente) > 0) {
        //Factura
        if ($datos['cliente_tipo_documento_id'] == 1) {
            
            if ($tipo_cliente[0]->tipo == 2) {
              $bresultado = true;
            } else {
              $bresultado = false;
            }

        } else { //Boleta
          if ($tipo_cliente[0]->tipo == 1) {
              $bresultado = true;
            } else {
              $bresultado = false;
            }
        }
      } else {
        $bresultado = false;
      }
      
    return$bresultado;
  }


  public static function GuardarDocumento($datos,$codigo_usuario,$email,&$codigo_generado)
    {
    	try {
    		
            DB::beginTransaction();
    			
    			     Serie::ActualizarCorrelativo($datos['cliente_serie_id']);
            	
            	$numero_documento = Serie::DevuelveCorrelativo($datos['cliente_serie_id']);

            	$serie_numero_documento = Serie::DevuelveFormatoDenominacionSerie($datos['cliente_serie_id']);

            	$igv = 0;
            	$subtotal =0;
            	$total = 0;
            	$code = rand(5, intval(10000000000));


            	// Insertando Cabecera
            	$codigo_documento_generado = DB::table('orders')->insertGetId(
		     			[
		     				'order_code' => $code,
							'invoice_no' => $serie_numero_documento,
							'created_at' =>  date_create()->format('Y-m-d H:i:s'),
							'updated_at' =>  date_create()->format('Y-m-d H:i:s'),
							'estado_id' => 1,
							'cliente_id' => $datos['cliente_id'],
							'cliente' => $datos['cliente'],
							'cDnicRuc' => $datos['cDnicRuc'],
							'FechaDocumento' => $datos['cliente_fechadocumento'],
							'cNumeroDocumento' => $numero_documento,
							'serie_id' => $datos['cliente_serie_id'],
							'tipo_documento_id' => $datos['cliente_tipo_documento_id'],
							'tipo_pago_id' => $datos['cliente_tipo_pago_id'],
							'SubTotal' => $subtotal,
							'IGv' => $igv,
							'Total' => $total,
							'user_id' => $codigo_usuario,
							'email' => $email,
		     			]
				 	);

              $bandera_consulta_medica = false;
              $numero_detalle = count($datos['productID']);
              $numero_Medicamentos =  0; 
              $numero_Medica = 0;

            	// Insertando Detalle.
            	  for ($i=0; $i < count($datos['productID']); $i++) { 
                    
                  $precio = $datos['orderPrice'][$i];
				          $cantidad = $datos['orderQuantity'][$i];                   
				          $articulo = $datos['productID'][$i];
				          $info = $datos['orderInfo'][$i];

                  $subtotal = floatval($datos['orderPrice'][$i])*intval($datos['orderQuantity'][$i]);

               		$documento_detalle = new Sales();

               		$documento_detalle->order_code =  $code;
               		$documento_detalle->info = $info;
               		$documento_detalle->price = $precio;
               		$documento_detalle->quantity = $cantidad;
               		$documento_detalle->product_id = $articulo;
               		$documento_detalle->subtotal = $subtotal;
               		
               		$documento_detalle->order_id = $codigo_documento_generado;

               		$documento_detalle->save();


               		Products::ActualizarStockProducto($datos['productID'][$i],$cantidad);

               		$total = $total + $subtotal;
                  

                  

                  if ($datos['productID'][$i] == 1) {
                    $bandera_consulta_medica = true;
                    $numero_Medica = 1;

                  } else {
                    $numero_Medicamentos = $numero_Medicamentos + $cantidad;
                    if (!$bandera_consulta_medica) {
                      $bandera_consulta_medica = false;            
                      $numero_Medica = 0;
                    }
                  }
                    
               }

               if ($datos['cliente_tipo_documento_id'] == 1) {
               		
               		$igv = 0.18*$total;
               }else {
               		$igv = 0;
               }



               $totaligv = $total + $igv;

              //Datos que se agregaron para el reporte de Cantidad de Articulos Vendidos por usuarios solo Medicamentos.

               // Actualizando los Datos.

                $valores=array('igv'=> $igv,
                			   'subtotal' =>$total,
                			   'total' => $totaligv,
                         'nNumeroMedicamentos' => $numero_Medicamentos,
                         'nConsultaMedica' => $numero_Medica,
                          'nCantidadItemDetalle' => $numero_detalle
                         );

            	Orders::where('id',$codigo_documento_generado)
                	->update($valores);

                $valores= null;
                $igv = null;
                $totaligv = null; 
                $total =null;
                $codigo_generado = $codigo_documento_generado;
            	DB::commit();

          	return true;  
    	} catch (Exception $e) {
    		DB::rollback();

            return false; 
    	}
    }

    public static function Listar_Ventas()
    {

    	$ventas = Orders::select("orders.order_code","orders.invoice_no","orders.cliente AS name","orders.Total AS price","orders.FechaDocumento as created_at","orders.id")
    					->where("orders.estado_id",1)
    					->orderBy('orders.id', 'desc')
        				->paginate(40);

		return $ventas;
    }

    public static function Listar_Ventas_Medicas()
    {
     
     $ventas = Orders::select("orders.order_code","orders.invoice_no","orders.cliente AS name","orders.Total AS price","orders.FechaDocumento as created_at","orders.id")
              ->join('sales','sales.order_id','=','orders.id')
              ->where("orders.estado_id",1)
              ->where("sales.product_id",1)
              ->orderBy('orders.id', 'desc')
              ->paginate(40);

      return $ventas; 
    }

    public static function Listar_Documento($codigo_documento)
    {
      return Orders::select('orders.order_code',
                            'orders.invoice_no',
                            'orders.cliente',
                            'orders.cDnicRuc',
                            'orders.FechaDocumento',
                            'orders.cNumeroDocumento',
                            'orders.serie_id',
                            'orders.tipo_documento_id',
                            'orders.tipo_pago_id',
                            'orders.SubTotal',
                            'orders.IGv',
                            'orders.Total',
                            'orders.user_id',
                            'orders.email','orders.id')
                    ->where('id',$codigo_documento)->get();
    }

    public static function Devuelve_Numero_Correlativo_Facturaction_Electro($codigo_documento)
    {
      $correlativo = Orders::select('orders.cNumeroDocumento')
                    ->where('id',$codigo_documento)->get(); 
    
      if (count($correlativo) > 0) {
        return $correlativo[0]->cNumeroDocumento;
      } else {
        return '';
      }
      
      
    }

    public static function Listar_Detalle_Documento($codigo_documento)
    {
      return Sales::select('sales.price','sales.quantity','products.p_gname','sales.SubTotal')
              ->join('products','products.p_id','=','sales.product_id')
              ->where('sales.order_id',$codigo_documento)->get();
    }

    public static function Anula_Documento($codigo_documento)
    {

      $valores=array('estado_id'=>2);

            Orders::where('id',$codigo_documento)
                ->update($valores);
                $valores = null;

       return true;         
    }

    public static function Listar_Ventas_Usuario($fecha_usuario,$usuario_id)
    {

      return DB::select('call usp_laurus_venta_usuario(?,?)',[$fecha_usuario,$usuario_id]);
    }

    public static function Listar_Movimiento_Almacen($anio,$mes_id,$producto_id)
    {

      return DB::select('call usp_laurus_reporte_mov_almacen(?,?,?)',[$anio,$mes_id,$producto_id]); 

    }

}
