<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@inversionesmaritimas.pr',
            'password' => bcrypt('admin'),
        ]);
        DB::table('roles_user')->insert([
            'roles_id' => '2',
            'user_id' => User::get()->last()->id,
        ]);
    }
}
