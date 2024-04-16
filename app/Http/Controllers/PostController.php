<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
      $this->middleware('auth')->except(['show', 'index']);
    }
    public function index(User $user)
    {
        //auth es un helper que va a revisar si el usuario esta autenticado
        //todo lo guarda en user
    //  dd(auth()->user());

      $posts = Post::where('user_id', $user->id)->latest()->paginate(8);
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
    public function show(User $user, Post $post){//show es para mosrtar 
        return view('posts.show',[
           "post"=>$post,
           'user'=>$user
           
        ]);

    }

    public function destroy(Post $post)
    {
     $this->authorize('delete', $post);//el metodo del policy y le pasas el post de la url 
    
     $post->delete();//si pasa la autorizacion elimina el post



     //eliminar la imagen
     $imagen_path= public_path('uploads/' . $post->imagen);

     if(File::exists($imagen_path)){//comprobamos si el archivo existe
        unlink($imagen_path);
     } 
     return redirect()->route('posts.index', auth()->user()->username);

    }
}
