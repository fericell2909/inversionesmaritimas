<?php

namespace App\Http\Controllers;

use App\Orders;
use App\Sales;
use App\Settings;
use App\TipoDocumento;
use App\TipoPago;
use App\Cotizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CotizacionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Http\Response
	 */
	
	public function index()
	{
		$getLastId = sales::all()->last();
		
		$print = DB::table('sales')
			->select(DB::raw('sales.quantity,orders.invoice_no,sales.info,products.p_id,products.p_discount,products.p_barcodeg,products.p_discount,sales.order_code,products.p_bname AS name, sales.price AS price,orders.created_at','orders.id'))
			->join('products', 'products.p_id', '=', 'sales.product_id')
			->join('orders', 'orders.order_code', '=', 'sales.order_code')
			->where('sales.order_code', $getLastId['order_code'])
			->get();
		
		// $sales = DB::table('orders')
		//     ->select(DB::raw('sales.order_code,products.p_id,orders.invoice_no ,products.p_discount, GROUP_CONCAT(products.p_bname SEPARATOR "," ) AS name,  SUM(sales.price * ( 100.0 - products.p_discount ) / 100.0) AS price , sales.created_at'))
		//     ->join('sales', 'sales.order_code', '=', 'orders.order_code')
		//     ->join('products', 'products.p_id', '=', 'sales.product_id')
		//     ->groupBy('sales.order_code')
		//     ->orderBy('orders.id', 'desc')
		//     ->paginate(40);
		
		$sales =Orders::Listar_Ventas();
		
		return view('sales.index', ['sales' => $sales, 'print' => $print]);
	}
	
	public function imprimir($codigo_documento,$tipo)
	{
		$orders = Cotizacion::Listar_Documento($codigo_documento);
		$ordendetalles = Cotizacion::Listar_Detalle_Documento($codigo_documento);
		$empresas =  Settings::Listar_Datos_Empresa();
		//var_dump($orders);
		$vistaurl="cotizaciones.documento";
		
		return $this->ImpimirPDF($orders,$ordendetalles,$empresas, $vistaurl,$tipo);
		
	}
	
	private function ImpimirPDF($orden,$detalle_orden,$empresas,$vistaurl,$tipo = 1)
	{
		
		$orders = $orden;
		$ordendetalles = $detalle_orden;
		
		$documento = strval($orders[0]->codigogenerado);
		
		$view =  \View::make($vistaurl,  ['orders' => $orders,'ordendetalles'=>$ordendetalles,'empresas' => $empresas])->render();
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($view);
		
		
		//return $pdf;
		if($tipo==1){return $pdf->stream(strval($documento));}
		if($tipo==2){return $pdf->download(strval($documento).'.pdf');}
	}
	
	public function create()
	{
		$product = DB::table('products')
			->select('p_bname', 'p_id', 'p_price', 'p_icon', 'p_discount', 'p_seffect', 'p_desc','p_image')
			->whereNotIn('p_id',[1])
			->get();
		
		
		//$tiposdocumentos = TipoDocumento::Listar_Tipo_Documento(2);
		$tiposdocumentos = TipoDocumento::Listar_Tipos_Documentos_Factura_Boleta();
		
		//var_dump($tiposdocumentos);
		//$series = Serie::Listar_Series_Boletas();
		$tipospagos = TipoPago::Listar_Tipo_Pago();
		
		//var_dump($tipospagos);
		
		return view('cotizaciones.create', compact('product','tiposdocumentos','tipospagos'));
		
		//return view('sales.create', compact('product','tiposdocumentos'));
		
	}
	
	public function store(Request $request)
	{
		$this->validate($request, array(
			'productID' => 'required|max:10',
			'orderPrice' => 'required|max:10',
			'orderQuantity' => 'required|max:10',
		));
		
		$data = $request->all();
		//var_dump($data);
		if ($data['cliente_id'] == null) {
			session()->flash('warning', 'Debe Seleccionar un Cliente.');
			return $this->Create();
		}
		
		$codigo_generado = 0;
		
		
		$bvalidacion = true;
		$bmensajevalidacion='';
		
		
		$bresultado = Cotizacion::GuardarDocumento($data,Auth::user()->id,Auth::user()->email,$codigo_generado);
		
		
		
		
		if ($bresultado === true) {
			
			// Llamada a Facturacion Electronica.
			// FacturacionElectronica::GeneraDocumentoElectronico($data,$codigo_generado);
			// FacturacionElectronica::GeneraDocumentoElectro($data,$codigo_generado);
			// Fin de Llamada a Facturacion Electonica.
			
			
			session()->flash('Correcto', 'Venta Realizada.');
			return redirect()->route('cotizaciones.show',$codigo_generado);
			
		} else
		{
			
			session()->flash('warning', 'La Venta no se ha realizado.');
			return $this->Create();
			
		}
		
		
	}
	
	public function show($id)
	{
		
		$orders = Cotizacion::Listar_Documento($id);
		$ordendetalles = Cotizacion::Listar_Detalle_Documento($id);
		$empresas =  Settings::Listar_Datos_Empresa();
		
		
		// $sale = DB::table('sales')
		//     ->join('products', 'products.p_id', '=', 'sales.product_id')
		//     ->selectRAW('sum(sales.quantity) AS quantity, sales.product_id,sales.created_at,order_code,products.p_discount,sales.price AS price , sales.info AS info, products.p_bname AS name')
		//     ->where('order_code', $id)
		//     ->get();
		
		return view('cotizaciones.show', ['orders' => $orders,'ordendetalles'=>$ordendetalles,'empresas'=>$empresas]);
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, $id)
	{
		// $this->validate($request, array(
		//     'id' => 'numeric',
		// ));
		// if ($request->ajax()) {
		//     $sale = Sales::where('order_code', $id);
		//     $sale->delete($request->all());
		//     return response(['msg' => 'Product deleted', 'status' => 'success']);
		// }
		// return response(['msg' => 'Failed deleting the product', 'status' => 'failed']);
		
		$bresultado = Orders::Anula_Documento($id);
		
		if ($bresultado == true) {
			return response(['msg' => 'Documento Anulado', 'status' => 'success']);
		}
		
		return response(['msg' => 'Documento no Anulado', 'status' => 'failed']);
		
	}
	
	/**
	 * Search the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response Json
	 */
	
	public function search(Request $request)
	{
		$number = $request->input('search');
		$this->validate($request, array(
			'search' => 'required|max:30',
		));
		if ($number) {
			
			$sales = Orders::select("orders.order_code","orders.invoice_no","orders.cliente AS name","orders.Total AS price","orders.FechaDocumento as created_at","orders.id")
				//->where('orders.cNumeroDocumento', 'like', "$number%")
				->where('orders.cDnicRuc', 'like', "$number%")
				
				->get();
		}
		
		
		
		return response()->json($sales);
		
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function pdfmedicas($id)
	{
		if (is_numeric($id)) {
			if ($id === '0') {
				$sales = DB::table('orders')
					->selectRAW('orders.order_code,orders.invoice_no,orders.cliente AS name,orders.Total AS price,orders.FechaDocumento as created_at,orders.id')
					->join('sales','sales.order_id','=','orders.id')
					->where("orders.estado_id",1)
					->where("sales.product_id",1)
					->get();
			} elseif ($id === '1') {
				$sales = DB::table('orders')
					->selectRAW('orders.order_code,orders.invoice_no,orders.cliente AS name,orders.Total AS price,orders.FechaDocumento as created_at,orders.id')
					->join('sales','sales.order_id','=','orders.id')
					->where("orders.estado_id",1)
					->where("sales.product_id",1)
					->whereRaw('orders.created_at between date_sub(now(),INTERVAL 1 WEEK) and now()')
					->get();
			} elseif ($id === '2') {
				$sales = DB::table('orders')
					->selectRAW('orders.order_code,orders.invoice_no,orders.cliente AS name,orders.Total AS price,orders.FechaDocumento as created_at,orders.id')
					->join('sales','sales.order_id','=','orders.id')
					->where("orders.estado_id",1)
					->where("sales.product_id",1)
					->whereRaw('orders.created_at between date_sub(now(),INTERVAL 1 MONTH) and now()')
					->get();
			} elseif ($id === '3') {
				$sales = DB::table('orders')
					->selectRAW('orders.order_code,orders.invoice_no,orders.cliente AS name,orders.Total AS price,orders.FechaDocumento as created_at,orders.id')
					->join('sales','sales.order_id','=','orders.id')
					->where("orders.estado_id",1)
					->where("sales.product_id",1)
					->whereRaw('orders.created_at between date_sub(now(),INTERVAL 6 MONTH) and now()')
					->get();
			} elseif ($id === '4') {
				$sales = DB::table('orders')
					->selectRAW('orders.order_code,orders.invoice_no,orders.cliente AS name,orders.Total AS price,orders.FechaDocumento as created_at,orders.id')
					->join('sales','sales.order_id','=','orders.id')
					->where("orders.estado_id",1)
					->where("sales.product_id",1)
					->whereRaw('orders.created_at between date_sub(now(),INTERVAL 1 YEAR) and now()')
					->get();
			}
			
			$empresas =  Settings::Listar_Datos_Empresa();
			
			$pdf = PDF::loadView('sales.pdf', ['sales' => $sales,'empresas' ,'empresas'=> $empresas]);
			
			return $pdf->download('sales.pdf');
		}
	}
	public function pdf($id)
	{
		if (is_numeric($id)) {
			if ($id === '0') {
				$sales = DB::table('orders')
					->selectRAW('orders.invoice_no ,orders.cliente AS name,  orders.Total AS price , orders.FechaDocumento as created_at')
					->where("orders.estado_id",1)
					->get();
			} elseif ($id === '1') {
				$sales = DB::table('orders')
					->selectRAW('orders.invoice_no ,orders.cliente AS name,  orders.Total AS price , orders.FechaDocumento as created_at')
					->where("orders.estado_id",1)
					->whereRaw('orders.FechaDocumento between date_sub(now(),INTERVAL 1 WEEK) and now()')
					->get();
			} elseif ($id === '2') {
				$sales = DB::table('orders')
					->selectRAW('orders.invoice_no ,orders.cliente AS name,  orders.Total AS price , orders.FechaDocumento as created_at')
					->where("orders.estado_id",1)
					->whereRaw('orders.FechaDocumento between date_sub(now(),INTERVAL 1 MONTH) and now()')
					->get();
			} elseif ($id === '3') {
				$sales = DB::table('orders')
					->selectRAW('orders.invoice_no ,orders.cliente AS name,  orders.Total AS price , orders.FechaDocumento as created_at')
					->where("orders.estado_id",1)
					->whereRaw('orders.FechaDocumento between date_sub(now(),INTERVAL 6 MONTH) and now()')
					->get();
			} elseif ($id === '4') {
				$sales = DB::table('orders')
					->selectRAW('orders.invoice_no ,orders.cliente AS name,  orders.Total AS price , orders.FechaDocumento as created_at')
					->where("orders.estado_id",1)
					->whereRaw('orders.FechaDocumento between date_sub(now(),INTERVAL 1 YEAR) and now()')
					->get();
			} elseif ($id === '5') {
				$sales = DB::table('orders')
					->selectRAW('orders.invoice_no ,orders.cliente AS name,  orders.Total AS price , orders.FechaDocumento as created_at')
					->where("orders.estado_id",1)
					->whereRaw('orders.FechaDocumento = curdate()')
					->get();
			}
			
			$cantidadtotalvendida = 0;
			
			foreach ($sales as $sale) {
				$cantidadtotalvendida = $cantidadtotalvendida + $sale->price;
			}
			
			$empresas =  Settings::Listar_Datos_Empresa();
			
			$pdf = PDF::loadView('sales.pdf', ['sales' => $sales,'cantidadtotalvendida' => $cantidadtotalvendida,'empresas'=> $empresas]);
			
			return $pdf->download('sales.pdf');
		}
	}
	
	public function getInvoice($id)
	{
		// $print = DB::table('sales')
		//     ->selectRAW('sales.quantity,orders.invoice_no,sales.info,products.p_id,products.p_discount,products.p_barcodeg,products.p_discount,sales.order_code,products.p_bname AS name, sales.price AS price,orders.created_at')
		//     ->join('products', 'products.p_id', '=', 'sales.product_id')
		//     ->join('orders', 'orders.order_code', '=', 'sales.order_code')
		//     ->where('sales.order_code', $id)
		//     ->get();
		
		return $this->imprimir($id,2);
		// return view('sales.invoice', ['print' => $print]);
	}
}
