<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
	        ['name' => 'logistica', 'description' => 'Logistica'],
            ['name' => 'admin', 'description' => 'Administrador'],
            
        ]);
    }
}
