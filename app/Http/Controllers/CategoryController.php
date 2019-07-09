<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;

class CategoryController extends Controller
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
        $category = Categories::all();
        return view('category.index', ['category' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Categories;
        $category->name = ucfirst($request->name);
        $category->save();
        session()->flash('success', 'Grabacion Correcta : ' . $category->name . '');
        return redirect()->route('category.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Categories::find($id);
        return view('category.edit')->withcategory($category);
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
        $category = Categories::find($id);
        $category->name = ucfirst($request->input('name'));
	    $category->estado_id = $request['estado_id'];
            $category->save();
        session()->flash('success', 'Actualizacion Correcta - ' . $category->name . '.');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $category = Categories::find($id);

        if ($request->ajax()) {
            $category->delete($request->all());
            return response(['msg' => 'Categoria Eliminada ', 'status' => 'success']);
        }
        return response(['msg' => 'Error en la eliminacion de la Categoria. ', 'status' => 'failed']);
    }
}
