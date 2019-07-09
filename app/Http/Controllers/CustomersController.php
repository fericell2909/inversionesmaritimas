<?php

namespace App\Http\Controllers;

use App\Customers;
use App\Custorders;
use App\Lastcs;
use App\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = \Auth::user()->authorizeRoles(['superadmin','admin','farmacia']);
            return $next($request);
        });
    }
    public function listarseriesajax($id)
    {
        //$id : codigo de tipo de documento.
         $this->middleware(function ($request, $next) {
            $this->user = \Auth::user()->authorizeRoles(['farmacia']);
            return $next($request);
        });
        return Serie::listarseriesajax($id);

    }
    public function index()
    {
        $customers = DB::table('customers')
            ->paginate(40);
        return view('customers.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // mestrada

    public function CrearPaciente()
    {

        return view('customers.crearpaciente');
    }

    public function RegistrarPaciente(Request $request )
    {

        $data = $request->all();
        
        $this->validate($request,['dni' => 'unique:customers,dni,'.$data['dni']]);

        if ($data['tipo'] == 1) {
            if (strlen($data['dni']) < 8 ) {
               session()->flash('warning', 'EL dni tiene que tener 8 digitos');

                return $this->CrearPaciente();
            }
        
        } 
        else
        {
            if ($data['tipo'] == 2) {
                if (strlen($data['dni']) < 11 ) {
                   session()->flash('warning', 'EL Ruc tiene que tener 11 digitos');

                    return $this->CrearPaciente();
                }
        
            } 
        }


        //var_dump($data);


        $code = rand(5, intval(10000000000));

        $order = new Customers();
        $order->number = $code;
        $order->name = $data['name'];

        $order->phone = $data['phone'];
        $order->info = $data['info'];
        $order->dni = $data['dni'];
        $order->tipo = $data['tipo'];
        $order->address = '';

        $order->save();

        session()->flash('success', 'Los Datos se Registraron Correctamente.');

        return redirect()->route('customers.index');

    }

    public function create()
    {
        $product = DB::table('products')
            ->select('p_gname', 'p_id', 'p_price', 'p_icon', 'p_discount')
            ->get();
        return view('customers.create', ['product' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Porque el Telfonoooo ???
        if (!empty($request->phone)) {
            // cambio: mestrada

                    
            $this->validate($request, array(
                'productID' => 'required|max:10',
                'orderPrice' => 'required|max:10',
                'orderQuantity' => 'required|max:10',
                'name' => 'required|max:70',
                'dni' => 'required|max:11',
                'phone' => 'required|max:20',
                'price' => 'nullable|max:10',

                'info' => 'nullable',
            ));

            $this->validate($request,['dni' => 'unique:customers,dni,'.$request->input('dni')]);

            $id = $request->input('productID');
            $price = $request->input('orderPrice');
            $order_info = $request->input('orderInfo');
            $order_quantity = $request->input('orderQuantity');
            $code = rand(5, 10000000000);

            //store $order_code to orders table
            $order = new Customers();
            $order->number = $code;
            $order->name = $request->input('name');
            $order->phone = $request->input('phone');
            $order->info = $request->input('info');
  
            $order->dni = $request->input('dni');
            $order->address = '';

            $order->save();
            $isdone = true;

            // check if there id and price then store in to sales table
            if ($id && $price) {
                foreach ($id as $key => $value) {
                    $sale = new Custorders();
                    $sale->cust_no = $code;
                    $sale->info = $order_info[$key];
                    $sale->price = $price[$key];
                    $sale->quantity = $order_quantity[$key];
                    $sale->product_id = $id[$key];
                    $sale->save();
                }
            }

            // session message and redirect
            if ($isdone === true) {
                session()->flash('success', 'Paciente Agregado Correctamnte - ' . $order->name);
                return redirect()->route('customers.show', ['id' => $sale->cust_no]);
            }

        }

            // order print
        // } else {
        //     $this->validate($request, array(
        //         'customerno' => 'required|max:30',
        //     ));

        //     // Customer sales store
        //     $cs = new Lastcs();
        //     $cs->cust_no = $request->input('customerno');
        //     $cs->save();

        //     session()->flash('success', 'Successful selling ' . $cs->cust_no);
        //     return redirect()->route('customers.show', ['id' => $cs->cust_no]);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $custorders = DB::table('custorders')
        //     ->join('products', 'products.p_id', '=', 'custorders.product_id')
        //     ->join('customers', 'customers.number', '=', 'custorders.cust_no')
        //     ->select(DB::raw('customers.name,customers.address,customers.phone,customers.info,custorders.product_id,custorders.created_at,custorders.quantity,custorders.cust_no AS customer_number, custorders.price AS price , custorders.info AS druginfo, sum(custorders.quantity) , products.p_gname AS drugname, products.p_discount AS discount,products.p_barcodeg AS barcode'))
        //     ->where('custorders.cust_no', $id)
        //     ->get();


        // $lastsale = DB::table('lastcs')
        //     ->where('cust_no', $id)
        //     ->get();
        
        $custorders = Customers::select('customers.id','customers.number','customers.name','customers.address','customers.phone',
                                        'customers.info','customers.created_at','customers.updated_at','customers.dni',
                                        'customers.estado_id','customers.tipo')
                                ->where('customers.number',$id)
                                ->get();

        return view('customers.show', compact('custorders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = Customers::find($id);
        return view('customers.edit', ['customers' => $customers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //validate input
        $this->validate($request, array(

            'name' => 'required|max:70',
            'phone' => 'required|max:20',
            'price' => 'nullable|max:10',
            'info' => 'nullable',

        ));

        $data = $request->all();

        if ($data['tipo'] == 1) {
            if (strlen($data['dni']) < 8 ) {
               session()->flash('warning', 'EL dni tiene que tener 8 digitos');

                return $this->edit($id);
            }
        
        } 
        else
        {
            if ($data['tipo'] == 2) {
                if (strlen($data['dni']) < 11 ) {
                   session()->flash('warning', 'EL Ruc tiene que tener 11 digitos');

                    return $this->edit($id);
                }
        
            } 
        }

        //$this->validate($request,['dni' => 'unique:customers,dni,'.$data['dni']]);


        // Store data
        $customer = Customers::find($id);
        $customer->name = $request->input('name');
        $customer->address = $request->input('address');
        $customer->phone = $request->input('phone');
        $customer->info = $request->input('info');
        $customer->estado_id = $request->input('estado');
        $customer->dni = $request->input('dni');
        $customer->save();

        session()->flash('success', 'Actualizacion Correcta - ' . $customer->name);
        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $customers = Customers::find($id);
        if ($request->ajax()) {
            $customers->delete($request->all());
            return response(['msg' => 'Product deleted', 'status' => 'success']);
        }
        return response(['msg' => 'Failed deleting the product', 'status' => 'failed']);
    }

    /**
     * Search the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response Json
     */

    public function search(request $request)
    {
        $name = $request->input('search');
        $this->validate($request, array(
            'search' => 'required|max:30',
        ));
        if ($name) {
            $customers = db::table('customers')
                ->where('name', 'like', "$name%")
                ->orWhere('dni', 'like', "$name%")->get();
            return response()->json($customers);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        if (is_numeric($id)) {
            if ($id === '0') {
                $customers = Customers::all();
            } elseif ($id === '1') {
                $customers = DB::table('customers')
                    ->whereRaw('created_at between date_sub(now(),INTERVAL 1 WEEK) and now()')
                    ->get();
            } elseif ($id === '2') {
                $customers = DB::table('customers')
                    ->whereRaw('created_at between date_sub(now(),INTERVAL 1 MONTH) and now()')
                    ->get();
            } elseif ($id === '3') {
                $customers = DB::table('customers')
                    ->whereRaw('created_at between date_sub(now(),INTERVAL 6 MONTH) and now()')
                    ->get();
            } elseif ($id === '4') {
                $customers = DB::table('customers')
                    ->whereRaw('created_at between date_sub(now(),INTERVAL 1 Year) and now()')
                    ->get();
            }

            $pdf = PDF::loadView('customers.pdf', ['customers' => $customers]);
            return $pdf->download('customers.pdf');
        }
    }
}
