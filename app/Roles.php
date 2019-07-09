<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{

    public function users()
    {
        return $this
            ->belongsToMany('App\User')
            ->withTimestamps();
    }
    public static function Listar_Roles()
    {
    	return Roles::select("roles.id","roles.name")
    					->get();
    }
}
