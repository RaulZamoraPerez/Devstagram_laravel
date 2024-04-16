<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class PerfilController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
       return view('perfil.index');
    }
    public function store(Request $request)
    {
        $request ->request->add(['username'=> Str::slug($request->username)]);
       $this->validate($request,[
        'username' => ['required', 'unique:users,username,'. auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],//NOT INLISTA NEGRA, IN ES LISTA FORZADA
       ]);

       if($request->imagen){
                $imagen = $request->file('imagen');//obtener el archivo

                $nombreImagen = Str::uuid() . "." . $imagen->extension();//


                $imagenServidor = Image::make($imagen);

                $imagenServidor->fit(1000,1000);//tamaño de 1000 *1000 pixeles


                //mover al servidor la img
            $imagenPath = public_path('perfiles') ."/" . $nombreImagen;
            $imagenServidor->save($imagenPath);
       }

       //sino hay pues no hacemos nada


       //guardar cambios
       $usuario = User::find(auth()->user()->id);
       $usuario->username= $request->username;
       $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;  // si esta sino null
       $usuario->save();


       //redireccionar

       return redirect()->route('posts.index', $usuario->username);//le pasas el usuario con el nombre por si se modifico
    }
}
