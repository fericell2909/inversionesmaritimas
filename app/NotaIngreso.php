<?php

namespace App;

use App\Suppliers;
use App\NotaIngresoDetalle;
use App\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as DB;

class NotaIngreso extends Model
{
	protected $primaryKey = 'id';
	protected $table='cab_notaingresos';

	public static function Registrar_Nota_Ingreso($data,$codigo_usuario,$nombre_usuario,$email_usuario)
	{

		try {
				
				$nombre_proveedor =  Suppliers::Devuelve_Nombre_Proveedor($data['proveedor_id']);


				DB::beginTransaction();

					// Insertando Nota de Ingreso Cabecera.
            		$codigo_nota_ingreso_generado = DB::table('cab_notaingresos')->insertGetId(
		     			[
		     				'estado_id' =>  1,
							'proveedor_id' =>  $data['proveedor_id'],
							'proveedor_nombre' => $nombre_proveedor,
							'user_id' =>  $codigo_usuario,
							'usuario_nombre' => $nombre_usuario,  
							'usuario_email' =>  $email_usuario,
							'tipo_documento_id' => $data['tipo_documento_id'], 
							'FechaDocumentoIngreso' => $data['FechaDocumentoCompra'],
							'documento_no' => $data['NumeroDocumento'], 
							'created_at' =>  date_create()->format('Y-m-d H:i:s'),
							'updated_at' =>  date_create()->format('Y-m-d H:i:s'),
		     			]
				 	);

            		// Insertar el Detalle de la Nota de Ingreso

            		$total = 0;
            		$subtotal = 0;

            		for ($i=0; $i < count($data['idarticulo']) ; $i++) {

            			$products = Products::devuelveDatosProducto($data['idarticulo'][$i]);

            			$nota_detalle = new NotaIngresoDetalle();

						$nota_detalle->cab_nota_ingreso_id = $codigo_nota_ingreso_generado; 
						$nota_detalle->info =  $products[0]->p_gname;
						$nota_detalle->product_id = $data['idarticulo'][$i];  
						$nota_detalle->product_gname =  $products[0]->p_gname;
						$nota_detalle->product_bname = $products[0]->p_bname;
						$nota_detalle->cantidad = intval($data['cantidad'][$i]); 
						$nota_detalle->precio_unitario_compra =  $data['precio'][$i];
						$nota_detalle->SubTotal = floatval($data['cantidad'][$i] * $data['precio'][$i]);
						$nota_detalle->created_at = date_create()->format('Y-m-d H:i:s');
						$nota_detalle->updated_at = date_create()->format('Y-m-d H:i:s'); 

						$nota_detalle->save();
						

						// AUmentar el Stock del Producto

						Products::AumentarStockProducto($data['idarticulo'][$i],intval($data['cantidad'][$i]));

						// Aqui se debe Insertar el Movimiento de Almacen. 

						$subtotal = floatval($data['cantidad'][$i] * $data['precio'][$i]);

						$products = null;

						$total = $total + $subtotal;


            		}

            		$igv = 0.18*$total;

            		$totaligv = $total + $igv;

	                $valores=array('SubTotal'=> $total,
	                			   'Igv' =>$igv,
	                			   'Total' => $totaligv);

	            	NotaIngreso::where('id',$codigo_nota_ingreso_generado)
	                	->update($valores);



				DB::commit();

				return true;

		} catch (Exception $e) {
			DB::rollback();

            return false; 
		}

	}
}
