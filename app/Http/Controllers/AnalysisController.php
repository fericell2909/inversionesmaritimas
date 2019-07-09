<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Orders;
use App\User;
use App\Settings;
use App\Products;
use App\Mes;
use PDF;

class AnalysisController extends Controller
{
      public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = \Auth::user()->authorizeRoles(['superadmin','admin']);
            return $next($request);
        });
    }
    public function index()
    {
        $users = DB::table('users')
            ->select('users.id','users.name')
            ->where('users.estado_id',1)
            ->get();

        return view('analysis.index',compact('users'));
    }

    public function sales()
    {
        $week = DB::table('sales')
            ->selectRaw('SUM(sales.price * ( 100.0 - products.p_discount ) / 100.0)  as price, DAYNAME(sales.created_at) as day')
            ->join('products', 'products.p_id', '=', 'sales.product_id')
            ->whereRaw('sales.created_at > DATE_SUB(CURDATE(), INTERVAL 1 WEEK) GROUP BY (day)')
            ->get();

        $day = DB::table('sales')
            ->selectRaw(' SUM(sales.price * ( 100.0 - products.p_discount ) / 100.0) AS price, DAYNAME(sales.created_at) AS day')
            ->join('products', 'products.p_id', '=', 'sales.product_id')
            ->whereRaw('DATE(sales.created_at) = DATE(NOW() - INTERVAL 1 DAY) OR DATE(sales.created_at) =  DATE(NOW())')
            ->groupBy('day')
            ->orderBy('sales.created_at')
            ->get();
        $month = DB::table('sales')
            ->select(DB::raw('SUM(sales.price) as price, MONTHNAME(sales.created_at) as month '))
            ->groupBy(DB::raw('DATE_FORMAT(sales.created_at, "%m")'))
            ->get();

        $topDrugsDay = DB::table('sales')
            ->select(DB::raw(' COUNT(*) as total, products.p_gname as price'))
            ->join('products', 'products.p_id', '=', 'sales.product_id')
            ->whereRaw(' sales.created_at >= DATE_SUB(NOW(), INTERVAL 1 DAY)')
            ->groupBy(DB::raw('products.p_gname LIMIT 10'))
            ->get();
        $topDrugsWeek = DB::table('sales')
            ->select(DB::raw(' COUNT(*) as total, products.p_gname as price'))
            ->join('products', 'products.p_id', '=', 'sales.product_id')
            ->whereRaw('sales.created_at >= DATE_SUB(NOW(),INTERVAL 1 WEEK)')
            ->groupBy(DB::raw('products.p_gname LIMIT 10'))
            ->get();
        $topDrugsMonth = DB::table('sales')
            ->select(DB::raw(' COUNT(*) as total, products.p_gname as price'))
            ->join('products', 'products.p_id', '=', 'sales.product_id')
            ->whereRaw('sales.created_at >= DATE_SUB(NOW(),INTERVAL 1 MONTH)')
            ->groupBy(DB::raw('products.p_gname LIMIT 10'))
            ->get();
        $topDrugsYear = DB::table('sales')
            ->select(DB::raw('COUNT(*) as total, products.p_gname as price'))
            ->join('products', 'products.p_id', '=', 'sales.product_id')
            ->whereRaw('sales.created_at >= DATE_SUB(NOW(),INTERVAL 1 YEAR)')
            ->groupBy(DB::raw('products.p_gname LIMIT 10'))
            ->get();

        //day if today = null or yasterday = null return
        if (!isset($day[0]->price) && !isset($day[1]->price)) {
            $day = array('yasterday' => '0', 'today' => '0');
        } elseif (!isset($day[1]->price)) {
            $day = array('yasterday' => $day[0]->price, 'today' => '0');
        } elseif (!isset($day[0]->price)) {
            $day = array('yasterday' => '0', 'today' => $day[1]->price);
        } else {
            $day = array('yasterday' => $day[0]->price, 'today' => $day[1]->price);
        }

        return view('analysis.sales', ['week' => $week, 'day' => $day, 'month' => $month, 'topDrugsDay' => $topDrugsDay, 'topDrugsWeek' => $topDrugsWeek, 'topDrugsMonth' => $topDrugsMonth, 'topDrugsYear' => $topDrugsYear]);
    }


    public function purchases()
    {
        $year = DB::table('products')
            ->select(DB::raw('SUM(p_imprice) as price, MONTHNAME(created_at) as month'))
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%m")'))
            ->get();

        $topQuantity = DB::table('products')
            ->select(DB::raw('SUM(p_quantity) AS quantity, p_gname AS name'))
            ->whereNotIn('p_id', [1])
            ->groupBy('p_quantity')
            ->orderBy('p_quantity', 'desc')
            ->limit(10)
            ->get();

        $lastDrugs = DB::table('products')
            ->select(DB::raw('p_quantity AS quantity, p_gname AS name'))
            ->whereNotIn('p_id', [1])
            ->orderBy('p_quantity', 'DESC')
            ->limit(10)
            ->get();

        return view('analysis.purchases', ['year' => $year, 'topQuantity' => $topQuantity, 'lastDrugs' => $lastDrugs]);
    }

    public function customers()
    {
        $week = DB::table('customers')
            ->selectRaw('count(id) AS number, DAYNAME(created_at) as day')
            ->whereRaw('created_at >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND created_at < curdate() GROUP BY (day)')
            ->get();
        $year = DB::table('customers')
            ->selectRaw('count(id) AS number, MONTHNAME(created_at) as month')
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%m")'))
            ->get();
        $lastCustomers = DB::table('customers')
            ->select(DB::raw('number,name'))
            ->orderBy('id', 'DESC')
            ->limit(10)
            ->get();
        return view('analysis.customers', ['week' => $week, 'year' => $year, 'lastCustomers' => $lastCustomers]);
    }

    public function medicas()
    {
        $sales = Orders::Listar_Ventas_Medicas();

        return view('analysis.medicas',['sales' => $sales]);
    }

    public function stockmedicamentos()
    {

        $empresas =  Settings::Listar_Datos_Empresa();
        $productos = Products::ListarProductos();

        return view('analysis.rptstockmedicamentos', ['productos'=>$productos,'empresas'=>$empresas]);

    }
    public function preciosventa()
    {

        $empresas =  Settings::Listar_Datos_Empresa();
        $productos = Products::ListarProductos();

        return view('analysis.rptprecioventa', ['productos'=>$productos,'empresas'=>$empresas]);

    }
    public function pdfstockmedicamentos($id)
    {
        $empresas =  Settings::Listar_Datos_Empresa();
        $productos = Products::ListarProductos();
        
        $vistaurl = 'analysis.impresionstockmedicamentos';

        return $this->pdfstockmedicamentosreporte($empresas,$productos,$vistaurl,$id);

    }
    
    public function pdfpreciosventa($id){
    
    
    }
    
    private function pdfstockmedicamentosreporte($empresa,$producto,$vistaurl,$tipo)
    {
        $empresas = $empresa;

        $productos = $producto;
        
        $nombre_documento = 'Reporte-Stock-Medicamentos'; 

        $view =  \View::make($vistaurl,['empresas' => $empresas,'productos' => $productos])->render();
        
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
         
        //return $pdf; 
        if($tipo==2){return $pdf->stream(strval($nombre_documento));}
        if($tipo==1){return $pdf->download(strval($nombre_documento).'.pdf');}        
    
    } 

    public function pdfPrecioVenta($id)
    {

        $empresas =  Settings::Listar_Datos_Empresa();
        $productos = Products::ListarProductos();
        
        $vistaurl = 'analysis.impresionpreciosventa';

        return $this->pdf($empresas,$productos,$vistaurl,$id);
    }

    private function pdf($empresa,$producto,$vistaurl,$tipo)
    {

        $empresas = $empresa;

        $productos = $producto;
        
        $nombre_documento = 'Reporte-PrecioVenta'; 

        $view =  \View::make($vistaurl,['empresas' => $empresas,'productos' => $productos])->render();
        
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
         
        //return $pdf; 
        if($tipo==2){return $pdf->stream(strval($nombre_documento));}
        if($tipo==1){return $pdf->download(strval($nombre_documento).'.pdf');} 
    }

    public function movimientosalmacen()
    {
        $meses = Mes::Listar_Meses();
        $productos  = Products::ListarProductos();
        return view('analysis.rptmovimientoalmacen',compact('meses','productos'));
    }

    public function VentasUsuario()
    {
        $usuarios = User::ListarUsuarios();
        return view('analysis.rptventausuario',compact('usuarios'));
    }

    public function GenerarReporteReporteMovimientoAlmacen(Request $request)
    {

        $data = $request->all();

        $movimientos =  Orders::Listar_Movimiento_Almacen($data['anio_id'],$data['mes_id'],$data['producto_id']);

        $productos = Products::devuelveDatosProducto($data['producto_id']);
        $empresas =  Settings::Listar_Datos_Empresa();

        $nombre_documento = 'Reporte-Movimientos-Productos'; 

        $tipo  =$data['tipo_reporte_id'];

        $view =  \View::make('analysis.impresionmovimientoalmacen',['empresas' => $empresas,'productos' => $productos,'movimientos' => $movimientos])->render();
        
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
         
        //return $pdf; 
        if($tipo==2){return $pdf->stream(strval($nombre_documento));}
        if($tipo==1){return $pdf->download(strval($nombre_documento).'.pdf');} 

    }


    public function GenerarReporteVentasUsuario(Request $request)
    {
        $data = $request->all();
        
        //var_dump($data);

        $empresas = Settings::Listar_Datos_Empresa();
        $ventas = Orders::Listar_Ventas_Usuario($data['fechaventadocumento'],$data['usuario_id']);
        $usuarios =  User::Listar_Datos_Usuario($data['usuario_id']);

        $cantidadvendida = 0;
        $cantidadtotalvendida = 0;

        foreach ($ventas as $venta) {
            $cantidadvendida = $cantidadvendida + $venta->cantidad;
            $cantidadtotalvendida = $cantidadtotalvendida + $venta->total; 
        
        }

        $tipo = $data['tipo_reporte_id'];
        $nombre_documento = 'Reporte-VentaUsuario';

        //var_dump($ventas);


        $view =  \View::make('analysis.impresionventausuario',['empresas' => $empresas,'ventas' => $ventas,'usuarios' => $usuarios, 'cantidadvendida' => $cantidadvendida,'cantidadtotalvendida' =>$cantidadtotalvendida,'fechaventadocumento' => $data['fechaventadocumento']])->render();
        
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);


        if($tipo==2){return $pdf->stream(strval($nombre_documento));}
        if($tipo==1){return $pdf->download(strval($nombre_documento).'.pdf');}
        
    }
}
