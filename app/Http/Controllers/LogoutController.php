<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //
    public function store(){
        //dd('cerrando sesion');
        auth()->logout();//cerrar sesion
         return redirect()->route('login');
    }
}
