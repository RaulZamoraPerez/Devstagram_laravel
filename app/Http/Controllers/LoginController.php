<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index(){
        return view('auth.login');
    }
    public function store(Request $request){
       //  dd('autenticnaod');
      
       //dd($request ->remember)

       $this->validate($request,[
        'email' => 'required|email',
        'password' =>  'required'

       ]);

     

   //comprobar si el usuario o las credenciales son correctas
   // attemp para intentar autenticar al user y el only para pasarle email y password
   //esto retorna un boolena
   //lo de abajo da boolen si es correcto da true entonces
   //le agregamos !  osea negamos la condicion para decirle si el usuario no se puede autenticar
   //mandaremos un  mensaje
   //en return back() con with    eso coloca ese mensaje en lo que se conoce como una sesio

       if(!auth()->attempt($request->only('email', 'password'), $request->remember)){//le pones $request->rember
            return back()->with('mensaje', 'credenciales incorrectas');
       }

       return redirect()->route('posts.index', auth()->user()->username);
    }
}
