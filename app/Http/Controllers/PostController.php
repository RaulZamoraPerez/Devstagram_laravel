<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
      /*
      cuando accedes a una ruta en otro navegador
    el contructor es lo que se ejcuta cuando es
    instanciado el controlador o esta clase, y lo proteges con algo llamado 
    middleware y le decimos que ejecute el middleware de autenticación. 
     ASI QUE ANTES DE QUE SE EJECUTE EL INDEX UN MIDDLEWARE SE VA A  EJECUTAR ANTES.
      Y ESTE REVISA ANTES DE PASAR EL INDEX QUE EL USUARIO ESTE AUTENTICADO
   */
    public function __construct()
    {
      $this->middleware('auth');
    }
    public function index(User $user)
    {
        //auth es un helper que va a revisar si el usuario esta autenticado
        //todo lo guarda en user
    //  dd(auth()->user());

      $posts = Post::where('user_id', $user->id)->paginate(5);
     //dd($posts);

    return view('dashboard',[
         'user'=> $user,
           'posts'=>$posts
    ]);
    }

    public function create()
    {
      //  dd("creando post");
      return view('posts.create');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
          "titulo"=>"required|max:255",
          "descripcion"=>"required",
          "imagen"=>"required"
        ]);

        // Post::create([
        //          'titulo'=>$request->titulo,
        //          'descripcion'=>$request->descripcion,
        //          'imagen'=>$request->imagen,
        //          'user_id'=>auth()->user()->id
        // ]);


        
        //otra forma de crear registrps
        // $post = new Post;//creas instancia de ese modelo
        // $post ->titulo =$request->titulo;
        // $post->descripcion=$request->descripcion;
        // $post->imagen=$request->imagen;
        // $post->user_id=auth()->user()->id;
        // //debes poner para guardar nomas
        // $post->save();



        //otra forma alamacenar con una relacion, es mas al estilo de laravel
        $request->user()->posts()->create([
                    'titulo'=>$request->titulo,
                    'descripcion'=>$request->descripcion,
                    'imagen'=>$request->imagen,
                    'user_id'=>auth()->user()->id
        ]);
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
