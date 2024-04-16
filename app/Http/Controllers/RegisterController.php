<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
      public function index()
       {
        return view('auth.registrer');
    }
    public function store(Request $request )
    {
         
      //modificar el request
      //agregamos con add un arreglo asociativo username
      //reinscribimos username para que entre en la validacion de ababajo de username
      $request ->request->add(['username'=> Str::slug($request->username)]);


         //dd($request);//el dd es una funcion de laravel que se llama day endbombo y esta imprime lo que le pases ahi pero detiene la ejeuccion de laravel y ya no ejecuta las sigiuentes lineas y eso debuguea las variables
          //dd($request->get("name"));


          //VALIDACION
          $this->validate($request, [
              'name' => 'required|max:30|min:16',
              'username' => 'required|unique:users|min:3|max:20',
              'email' => 'required|unique:users|email|max:60',
              'password' =>  'required|confirmed|min:6'//con el confirm revisa el otro campo u¿igual

          ]);
          //cusndo pasa la validacion
         // dd("creando usuario");//

          ////metodo estaico que nos permite crear nuevos registros y es el equivalente a insert into usuarios usando el modelo
          
          //CREar registro
          User::create([
            'name' => $request ->name,
              'username'=>$request -> username,
              'email'=>$request->email,
              'password'=> Hash::make( $request->password)
          ]);
            
          
           //autenticar usuario
           //el helper de autj tiene una funcion para intentar autenticar al user y se llama attem
           //attemp  es intentar autenticar al usuario
           //attem retorna un boolean
           
          //  auth()->attempt([
          //   'email'=>$request->email,
          //   'password'=>$request->password
          //  ]);

          //otra forma
          auth()->attempt($request->only('email', 'password'));


          //podemos rediccionar

          return redirect()->route('posts.index', auth()->user()->username);
        }
}
