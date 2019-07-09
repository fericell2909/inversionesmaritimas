<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubCategories;
use App\Categories;

class SubCategoryController extends Controller
{
	/**
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
		
		$subcategory = SubCategories::Listar_SubCategorias();
		
		return view('subcategory.index', ['subcategory' => $subcategory]);
	
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$category = Categories::All();
		return view('subcategory.create',['category' => $category]);

	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$subcategory = new SubCategories;
		$subcategory->name = ucfirst($request->name);
		$subcategory->categories_id = $request->categories_id;
		$subcategory->save();
		session()->flash('success', 'Nueva Sub Categoria Grabada Correctamente : ' . $subcategory->name . '');
		return redirect()->route('subcategory.index');
	}
	
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$subcategory = SubCategories::find($id);
		$category = Categories::Listar();
		
		return view('subcategory.edit',['category' => $category,'subcategory'=> $subcategory]);
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
		$subcategory = SubCategories::find($id);
		$subcategory->name = ucfirst($request->input('name'));
		$subcategory->categories_id = $request['categories_id'];
		$subcategory->estado_id = $request['estado_id'];
		$subcategory->save();
		session()->flash('success', 'Actualizacion Correcta - ' . $subcategory->name . '.');
		return redirect()->route('subcategory.index');
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, $id)
	{
		
		$subcategory = SubCategories::find($id);
		
		if ($request->ajax()) {
			$subcategory->delete();
			
			
			return response(['msg' => 'Sub Categoria Eliminada ', 'status' => 'success']);
		}
		return response(['msg' => 'Error en la eliminacion de la Sub Categoria. ', 'status' => 'failed']);
	}
}
