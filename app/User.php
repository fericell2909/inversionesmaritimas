<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Role;
use App\Roles_user;
use Illuminate\Support\Facades\DB as DB;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $table='users';
    public $primaryKey ='id';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this
            ->belongsToMany('App\Roles')
            ->withTimestamps();
    }
    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'This action is unauthorized.');
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public static function Listar_Busqueda_Usuarios($number)
    {
        if ($number == 'Todos') {
            $usuarios = User::select('users.id', 'users.name', 'users.email', 'users.created_at', 'users.updated_at', 'roles_user.roles_id', 'roles_user.user_id','roles.name as nombreroles','estados.nombre_estado as nombre_estado','users.estado_id as estado_id')
                        ->join('roles_user', 'users.id', '=', 'roles_user.user_id')
                        ->join('roles','roles.id','=','roles_user.roles_id')
                        ->join('estados','estados.id','=','users.estado_id')
                      ->get();
        } else {
            $usuarios = User::select('users.id', 'users.name', 'users.email', 'users.created_at', 'users.updated_at', 'roles_user.roles_id', 'roles_user.user_id','roles.name as nombreroles','estados.nombre_estado as nombre_estado','users.estado_id as estado_id')
                        ->join('roles_user', 'users.id', '=', 'roles_user.user_id')
                        ->join('roles','roles.id','=','roles_user.roles_id')
                        ->join('estados','estados.id','=','users.estado_id')
                        ->where('users.name', 'like', "$number%")
                      ->get();
        }
        
         
    
        return  response()->json($usuarios);
    }

    public static function RegistrarUsuario($data)
    {

        // Insertando Usuario
        try {
                    
                DB::beginTransaction();

                $codigo_usuario_generado = DB::table('users')->insertGetId(
                                [
                                    'name' => $data['name'],
                                    'email' => $data['email'],
                                    'password' => bcrypt($data['password']),
                                    'created_at' =>  date_create()->format('Y-m-d H:i:s'),
                                    'updated_at' =>  date_create()->format('Y-m-d H:i:s'),
                                ]
                            );

                // Insertando Rol de Usuario

                $usuario_rol = new Roles_user();

                $usuario_rol->roles_id = $data['role'];
                $usuario_rol->user_id = $codigo_usuario_generado;

                $usuario_rol->save();

                DB::commit();

                    return true;  
                } catch (Exception $e) {
                    DB::rollback();

                    return false; 
                }
    }
    public static function ActualizarUsuario($data,$codigo_usuario,$actualiza_pass)
    {
        try {
                DB::beginTransaction();

                    // Actualizadno Datos del Usuario.

                    if ($actualiza_pass) {
                        $usuario =  array('name' => $data['name'],'email' => $data['email'],'estado_id' =>$data['estado'],'password'=>bcrypt($data['password']));
                    } else {
                        $usuario =  array('name' => $data['name'],'email' => $data['email'],'estado_id' =>$data['estado']);
                    }
                    

                    User::where('id',$codigo_usuario)
                          ->update($usuario);

                    $usuario = null;
                    // Actualizando el Rol Asignado.

                    $usuario_rol =  array('roles_id' => $data['role']);

                    Roles_user::where('user_id',$codigo_usuario)
                                ->update($usuario_rol);

                    $usuario_rol = null;

                    DB::commit();
                    
                    return true;
        
        } catch (Exception $e) {
        
                DB::rollback();
        
                return false;
        
        }
    }

    public static function ListarUsuarios()
    {
        $usuarios = User::select('users.id','users.email')
                        ->where('users.estado_id',1)
                      ->get();

        return $usuarios;
    }
    public static function Listar_Datos_Usuario($codigo_usuario)  
    {
        $usuarios = User::select('users.id', 'users.name', 'users.email')
                        ->where('users.id', '=', $codigo_usuario)
                      ->get();

        return $usuarios;
    
    }
}   
