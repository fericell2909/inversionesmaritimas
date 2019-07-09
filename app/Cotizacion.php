<?php
namespace App;

use App\Customers;
use App\Orders;
use App\Products;
use App\Sales;
use App\Serie;
use App\CotizacionDetalle;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as DB;

class Cotizacion extends Model {
	
	protected $table='cotizaciones';
	public $primaryKey='id';
	
	public static function ValidaStockProductoVenta($datos,&$bvalidacion,&$bmensaje){
		
		$bhaystock=true;
		
		for($i=0; $i<count($datos['productID']); $i++){
			// No hay Stock Disponible.
			$bhaystock=Products::ValidaStockProducto($datos['productID'][$i],$datos['orderQuantity'][$i]);
			
			if(!($bhaystock)){
				$bvalidacion=false;
				$bmensaje='No Existe Stock Disponible para el producto : '.Products::devuelveNombreProducto($datos['productID']);
				break;
			}
		}
	}
	
	public static function ValidaClienteTipoDocumento($datos){
		
		$bresultado=false;
		
		$tipo_cliente=Customers::select('customers.tipo')->where('customers.id',$datos['cliente_id'])->get();
		
		if(count($tipo_cliente)>0){
			//Factura
			if($datos['cliente_tipo_documento_id']==1){
				
				if($tipo_cliente[0]->tipo==2){
					$bresultado=true;
				}else{
					$bresultado=false;
				}
				
			}else{ //Boleta
				if($tipo_cliente[0]->tipo==1){
					$bresultado=true;
				}else{
					$bresultado=false;
				}
			}
		}else{
			$bresultado=false;
		}
		
		return $bresultado;
	}
	
	public static function GuardarDocumento($datos,$codigo_usuario,$email,&$codigo_generado){
		
		try{
			
			DB::beginTransaction();
			
			$igv=0;
			$subtotal=0;
			$total=0;
			$code=rand(5,intval(10000000000));
			
			// Insertando Cabecera
			
			$codigo_documento_generado=DB::table('cotizaciones')->insertGetId([
					'order_code'=>$code,
					'codigogenerado'=>'CT-'.$code,
					'created_at'=>date_create()->format('Y-m-d H:i:s'),
					'updated_at'=>date_create()->format('Y-m-d H:i:s'),
					'estado_id'=>1,
					'cliente_id'=>$datos['cliente_id'],
					'cliente'=>$datos['cliente'],
					'cDnicRuc'=>$datos['cDnicRuc'],
					'FechaDocumento'=>$datos['cliente_fechadocumento'],
					'cNumeroDocumento'=>'',
					'SubTotal'=>$subtotal,
					'IGv'=>$igv,
					'Total'=>$total,
					'user_id'=>$codigo_usuario,
					'email'=>$email,
				]);
			
			$bandera_consulta_medica=false;
			$numero_detalle=count($datos['productID']);
			$numero_Medicamentos=0;
			$numero_Medica=0;
			
			// Insertando Detalle.
			for($i=0; $i<count($datos['productID']); $i++){
				
				$precio=$datos['orderPrice'][$i];
				$cantidad=$datos['orderQuantity'][$i];
				$articulo=$datos['productID'][$i];
				$info=$datos['orderInfo'][$i];
				
				$subtotal=floatval($datos['orderPrice'][$i])*intval($datos['orderQuantity'][$i]);
				
				$documento_detalle=new CotizacionDetalle();
				
				$documento_detalle->order_code=$code;
				$documento_detalle->info=$info;
				$documento_detalle->price=$precio;
				$documento_detalle->quantity=$cantidad;
				$documento_detalle->product_id=$articulo;
				$documento_detalle->subtotal=$subtotal;
				
				$documento_detalle->cotizacion_id=$codigo_documento_generado;
				
				$documento_detalle->save();
				
				$total = $total + $subtotal;
				
			}
			
			if($datos['cliente_tipo_documento_id']==1){
				
				$igv=0.18*$total;
				
			}else{
				$igv=0;
			}
			
			$totaligv=$total+$igv;
			
			//Datos que se agregaron para el reporte de Cantidad de Articulos Vendidos por usuarios solo Medicamentos.
			
			// Actualizando los Datos.
			
			$valores=array(
				'igv'=>$igv,
				'subtotal'=>$total,
				'total'=>$totaligv,
				'nNumeroMedicamentos'=>$numero_Medicamentos,
				'nConsultaMedica'=>$numero_Medica,
				'nCantidadItemDetalle'=>$numero_detalle
			);
			
			Cotizacion::where('id',$codigo_documento_generado)->update($valores);
			
			$valores=null;
			$igv=null;
			$totaligv=null;
			$total=null;
			$codigo_generado=$codigo_documento_generado;
			DB::commit();
			
			return true;
		}catch(Exception $e){
			DB::rollback();
			
			return false;
		}
	}
	
	public static function Listar_Ventas(){
		
		$ventas=Orders::select("orders.order_code","orders.invoice_no","orders.cliente AS name","orders.Total AS price","orders.FechaDocumento as created_at","orders.id")->where("orders.estado_id",1)->orderBy('orders.id','desc')->paginate(40);
		
		return $ventas;
	}
	
	public static function Listar_Ventas_Medicas(){
		
		$ventas=Orders::select("orders.order_code","orders.invoice_no","orders.cliente AS name","orders.Total AS price","orders.FechaDocumento as created_at","orders.id")->join('sales','sales.order_id','=','orders.id')->where("orders.estado_id",1)->where("sales.product_id",1)->orderBy('orders.id','desc')->paginate(40);
		
		return $ventas;
	}
	
	public static function Listar_Documento($codigo_documento){
		
		return Cotizacion::select('cotizaciones.order_code','cotizaciones.invoice_no','cotizaciones.cliente',
									'cotizaciones.cDnicRuc','cotizaciones.FechaDocumento','cotizaciones.cNumeroDocumento',
									'cotizaciones.SubTotal','cotizaciones.IGv',
									'cotizaciones.Total','cotizaciones.user_id','cotizaciones.email','cotizaciones.id',
									'cotizaciones.codigogenerado'
								)
							->where('id',$codigo_documento)->get();
	}
	
	public static function Devuelve_Numero_Correlativo_Facturaction_Electro($codigo_documento){
		
		$correlativo=Orders::select('orders.cNumeroDocumento')->where('id',$codigo_documento)->get();
		
		if(count($correlativo)>0){
			return $correlativo[0]->cNumeroDocumento;
		}else{
			return '';
		}
		
	}
	
	public static function Listar_Detalle_Documento($codigo_documento){
		
		return CotizacionDetalle::select('cotizaciones_detalle.price','cotizaciones_detalle.quantity','products.p_gname','cotizaciones_detalle.SubTotal')
						->join('products','products.p_id','=','cotizaciones_detalle.product_id')
						->where('cotizaciones_detalle.cotizacion_id',$codigo_documento)->get();
	}
	
	public static function Anula_Documento($codigo_documento){
		
		$valores=array('estado_id'=>2);
		
		Orders::where('id',$codigo_documento)->update($valores);
		$valores=null;
		
		return true;
	}
	
	public static function Listar_Ventas_Usuario($fecha_usuario,$usuario_id){
		
		return DB::select('call usp_laurus_venta_usuario(?,?)',[$fecha_usuario,$usuario_id]);
	}
	
	public static function Listar_Movimiento_Almacen($anio,$mes_id,$producto_id){
		
		return DB::select('call usp_laurus_reporte_mov_almacen(?,?,?)',[$anio,$mes_id,$producto_id]);
		
	}
}