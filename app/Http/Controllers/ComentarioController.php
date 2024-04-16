<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{

    public function store(Request $request,  User $user, Post $post)
    {

       // dd($post->id);
       //dd($user->username);
         //validar
            $this ->validate($request,[
                "comentario"=>'required|max:255'
            ]);


         //alamcenar resultado
         Comentario::create([
              'user_id'=>auth()->user()->id,
              'post_id'=>$post->id,
              'comentario'=> $request->comentario
         ]);



         //imprimir el mensake
         return back()->with('mensaje', 'comentario realizado correctamente' );
    }
}
