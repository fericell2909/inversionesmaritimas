<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Roles_user;
use App\Roles;

class UsersController extends Controller
{


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = \Auth::user()->authorizeRoles(['superadmin','admin']);
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //modificado.
    public function index()
    {

        $users = DB::table('users')
            ->select('users.id', 'users.name', 'users.email', 'users.created_at', 'users.updated_at', 'roles_user.roles_id', 'roles_user.user_id','roles.name as nombreroles','estados.nombre_estado as nombre_estado','users.estado_id as estado_id')
            ->join('roles_user', 'users.id', '=', 'roles_user.user_id')
            ->join('roles','roles.id','=','roles_user.roles_id')
            ->join('estados','estados.id','=','users.estado_id')
            ->get();
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Roles::Listar_Roles();
        return view('users.create',compact('roles'));
    }

   public function search(Request $request)
    {
        $number = $request->input('search');
        $this->validate($request, array(
            'search' => 'required|max:30',
        ));

        if ($number) {
            $series = User::Listar_Busqueda_Usuarios($number);
            return $series;
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|max:50',
            'email' => 'required|max:100',
            'password' => 'required|max:100'
        ));

        $data = $request->all();

        $bresultado = User::RegistrarUsuario($data);

        if ($bresultado) {
            $bresultado = null;
            session()->flash('success', 'La Cuenta ha sido creada correctamente.');
            return redirect()->route('users.index');
        
        } else {
            $bresultado = null;
            session()->flash('warning', 'Ha OCurrido un Error!!! La Cuenta no ha sido creada.');
            
            return redirect()->route('users.index');
        
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Roles::Listar_Roles();

        $users = DB::table('users')
            ->select('users.id', 'users.name', 'users.email', 'users.created_at', 'users.updated_at', 'roles_user.roles_id', 'roles_user.user_id','roles.name as nombreroles','estados.nombre_estado as nombre_estado','users.estado_id as estado_id')
            ->join('roles_user', 'users.id', '=', 'roles_user.user_id')
            ->join('roles','roles.id','=','roles_user.roles_id')
            ->join('estados','estados.id','=','users.estado_id')
            ->where('users.id', $id)
            ->first();


        return view('users.edit',compact('roles'))->withusers($users);
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
        $this->validate($request, array(
            'name' => 'required|max:50',
            'email' => 'required|max:100'
        ));

        $data = $request->all();

        $bactualizapass = true;

        if ($data['password'] == null) {
            $bactualizapass = false;
        }
        

        $bresultado = User::ActualizarUsuario($data,$id,$bactualizapass);

        if ($bresultado) {
            $bresultado = null;
            session()->flash('success', 'La Cuenta ha sido Actualizada correctamente.');
            return redirect()->route('users.index');
        
        } else {
            $bresultado = null;
            session()->flash('warning', 'Ha OCurrido un Error!!! La Cuenta no ha sido actualizada.');
            
            return redirect()->route('users.index');
        
        }
        
    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        return response(['msg' => 'Failed deleting the product', 'status' => 'failed']);
}
}

