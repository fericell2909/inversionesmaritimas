<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function Account()
    {
        return view('account');
    }

    /**
     * Update account
     *
     * @return void
     */
      public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = \Auth::user()->authorizeRoles(['superadmin','admin','farmacia']);
            return $next($request);
        });
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if (!$request->input('password') == '') {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        session()->flash('success', 'Tu Cuenta ha sido Acualizada.');
        return redirect()->route('home');
    }
}
