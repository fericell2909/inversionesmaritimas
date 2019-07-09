<?php

namespace App\Http\Controllers;

use App\Categories;
use App\SubCategories;
use App\Products;
use App\Suppliers;
use App\Settings;
use App\TipoDocumento;
use App\NotaIngreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = \Auth::user()->authorizeRoles(['superadmin','admin']);
            return $next($request);
        });
    }
    public function index()
    {
        // Sort by category
        $categorySort = \Request::get('cat');
        $category = SubCategories::all();
        if (isset($categorySort)) {
            $product = DB::table('products')
                ->join('sub_categories', 'products.p_cat', '=', 'sub_categories.id')
				->leftJoin('sales', 'sales.product_id', '=', 'products.p_id')
                ->selectRAW('products.*, sum(sales.quantity) as sale_quantity,sub_categories.name')
                ->where('p_cat', $categorySort)
                ->whereNotIn('p_id', [1])
				->groupBy('products.p_id')
                ->orderBy('p_id', 'DESC')
                ->paginate(15);
            return view('product.index', ['product' => $product->appends(\Request::except('page')), 'category' => $category]);
        } else {
            $product = DB::table('products')
                ->join('sub_categories', 'products.p_cat', '=', 'sub_categories.id')
                ->leftJoin('sales', 'sales.product_id', '=', 'products.p_id')
                ->whereNotIn('p_id', [1])
                ->selectRAW('products.*, sum(sales.quantity) as sale_quantity,sub_categories.name')
                //selectRAW('products.*, sum(sales.quantity) as sale_quantity,categories.name')
                ->groupBy('products.p_id')
                ->orderBy('p_id', 'DESC')
                ->paginate(15);
            return view('product.index', ['product' => $product, 'category' => $category]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = SubCategories::pluck('name', 'id');
        $provider = Suppliers::Listar_Proveedores();
			
        return view('product.create', ['category' => $category, 'provider' => $provider]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate data

        $this->validate($request, array(
            'gname' => 'required|max:70',
            'bname' => 'nullable|max:70',
            'desc' => 'nullable',
            'country' => 'nullable|max:70',
            'idnumber' => 'nullable|max:70',
            'imdate' => 'nullable|date',
            'exdate' => 'nullable|date',
            'statue' => 'nullable',
            'category' => 'required|max:70',
            'quantity' => 'required|numeric|max:100000000',
            'price' => 'numeric|max:100000000',
            'discount' => 'nullable|numeric|max:100',
            'imname' => 'max:70',
            'immoney' => 'nullable|numeric|max:100000000',

        ));

        //store data
        $product = new Products;
        $product->p_gname = ucfirst($request->gname);
        $product->p_bname = ucfirst($request->bname);
        $product->p_desc = $request->desc;
        $product->p_country = $request->country;
        $product->p_idnumber = $request->idnumber;
        $product->p_imdate = $request->imdate;
        $product->p_exdate = $request->exdate;
        $product->p_seffect = $request->statue;
        $product->p_cat = $request->category;
        $product->p_quantity = $request->quantity;
        $product->p_price = $request->money;
        $product->p_discount = $request->discount;
        $product->p_imname = $request->imname;
        $product->p_imprice = $request->immoney;
        $product->p_barcodeg = $request->barcodeg;
        
        // Saber Cuanto Fue el Ingreso de Producto.
        $product->p_cantidad_inicial = $request->quantity;

        // if discount empty return 0 
        if (empty($request->discount)) {
            $product->p_discount = 0;
        }

        //upload image
        if ($request->file('file')) {
            $photoName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move('upload', $photoName);
            $product->p_image = $photoName;
        }
        $product->p_icon = $request->icon;
        $product->save();

        session()->flash('success', 'Grabacion Correcta ' . $product->p_gname . ' Producto');
        return redirect()->route('product.index');
    }

    public function show($id)
    {
        // Show product
        if (is_numeric($id)) {
            $product = DB::table('products')
                ->join('sub_categories', 'sub_categories.id', '=', 'products.p_cat')
                ->join('sales', 'sales.product_id', '=', 'products.p_id')
                ->selectRAW(' products.*, sum(sales.quantity) as sale_quantity,sub_categories.name ')
                ->where('p_id', $id)
                ->get();
            return view('product.show')->withproduct($product);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = SubCategories::pluck('name', 'id');
        $product = Products::find($id);
	    $provider = Suppliers::Listar_Proveedores();
        return view('product.edit', ['product' => $product, 'category' => $category, 'provider' => $provider]);
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

        //validate data

        $this->validate($request, array(
            'gname' => 'required|max:70',
            'bname' => 'nullable|max:70',
            'desc' => 'nullable',
            'country' => 'nullable|max:70',
            'idnumber' => 'nullable|max:70',
            'imdate' => 'nullable|date',
            'exdate' => 'nullable|date',
            'statue' => 'nullable',
            'category' => 'required|max:70',
            'quantity' => 'required|numeric|max:100000000',
            'price' => 'numeric|max:100000000',
            'discount' => 'nullable|numeric|max:100',
            'imname' => 'max:70',
            'immoney' => 'nullable|numeric|max:100000000',
        ));

        //store data
        $product = Products::find($id);
        $product->p_gname = ucfirst($request->gname);
        $product->p_bname = ucfirst($request->bname);
        $product->p_desc = $request->desc;
        $product->p_country = $request->country;
        $product->p_idnumber = $request->idnumber;
        $product->p_imdate = $request->imdate;
        $product->p_exdate = $request->exdate;
        $product->p_seffect = $request->statue;
        $product->p_cat = $request->category;
        $product->p_quantity = $request->quantity;
        $product->p_price = $request->price;
        $product->p_discount = $request->discount;
        $product->p_imname = $request->imname;
        $product->p_imprice = $request->immoney;
        $product->p_barcodeg = $request->barcodeg;

        // if discount empty return 0 
        if (empty($request->discount)) {
            $product->p_discount = 0;
        }
        //upload image
        if ($request->file('file')) {
            $photoName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move('upload', $photoName);
            $product->p_image = $photoName;
        }
        //check icon not empty
        if (!empty($request->icon)) {
            $product->p_icon = $request->icon;
        }
        $product->save();
        session()->flash('success', 'Producto Actualizado ' . $product->p_gname . ' Producto');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // $product = Products::find($id);
        // if ($request->ajax()) {
        //     $product->delete($request->all());
        //     return response(['msg' => 'Product deleted', 'status' => 'success']);
        // }
        return response(['msg' => 'Accion Realizada Correctamente', 'status' => 'success']);
    }

    /**
     * Search the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response Json
     */

    public function search(Request $request)
    {
        $name = $request->input('search');
        $this->validate($request, array(
            'search' => 'required|max:30',
        ));
        if ($name) {
            $product = DB::table('products')
                ->join('categories', 'products.p_cat', '=', 'categories.id')
                ->selectRAW('products.p_gname
                            ,products.p_bname as p_bname 
                            ,products.p_desc as p_desc
                            ,products.p_country as p_country
                            ,products.p_idnumber as p_idnumber
                            ,products.p_imdate as p_imdate
                            ,products.p_exdate as p_exdate
                            ,products.p_seffect as p_seffect
                            ,products.p_cat as p_cat
                            ,products.p_quantity as p_quantity
                            ,products.p_price as p_price
                            ,products.p_imname as p_imname
                            ,products.p_imprice as p_imprice
                            ,products.p_discount as p_discount
                            ,products.p_image as p_image
                            ,products.p_icon as p_icon
                            ,products.p_barcodeg as p_barcodeg
                            ,products.p_id as p_id
                            ,products.created_at as created_at
                            ,products.updated_at as updated_at,datediff(products.p_exdate,now()) as dias,categories.name as name')
	            ->where('products.p_id','<>',1)
	            ->where('products.p_gname', 'like', "$name%")
                ->orWhere('products.p_bname', 'like', "$name%")
                ->orWhere('products.p_idnumber', 'like', "$name%")
                ->orWhere('products.p_barcodeg', 'like', "$name%")->get();
	            
            return response()->json($product);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {   
        $empresas =  Settings::Listar_Datos_Empresa();

        if ($id === '0') {
            $products = Products::all();
            $pdf = PDF::loadView('product.pdf', ['products' => $products,'empresas'=>$empresas]);
            return $pdf->download('Productos.pdf');
        } else {
            $products = DB::table('products')
                ->where('p_cat', $id)
                ->get();
            $pdf = PDF::loadView('product.pdf', ['products' => $products,'empresas'=>$empresas]);
            return $pdf->download('Productos.pdf');
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function outstock()
    {
        $product = DB::table('products')
            ->join('categories', 'products.p_cat', '=', 'categories.id')
            ->where('p_quantity', '<', '21')
            ->whereNotIn('p_id', [1])
            ->paginate(15);

        return view('product.outstock', ['product' => $product]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function expired()
    {
        $product = DB::table('products')
            ->join('categories', 'products.p_cat', '=', 'categories.id')
            ->whereRaw('p_exdate < CURDATE()')
            ->whereNotIn('p_id', [1])
            ->paginate(15);

        return view('product.expired', ['product' => $product]);
    }

    public function notaingreso()
    {


        $products = Products::ListarProductos();
        $proveedores = Suppliers::Listar_Proveedores();
        $tiposdocumentos = TipoDocumento::Listar_Tipos_Documentos_Factura();

        return view('product.notaingreso',compact('products','proveedores','tiposdocumentos'));

    }
    public function postnotaingreso(Request $request)
    {
        $data = $request->all();
        //var_dump($data);
    
    
        $bresultado = NotaIngreso::Registrar_Nota_Ingreso($data,Auth::user()->id,Auth::user()->name,Auth::user()->email); 
        
        if ($bresultado) {
            
            session()->flash('Correcto', 'Ingreso de Productos Realizado Correctamente.');
            return redirect()->route('product.index');
            
         } else
         {
            
            session()->flash('warning', 'EL Ingreso de Producto no ha sido realizado.');
            return redirect()->route('product.index');
        }
    }
}
