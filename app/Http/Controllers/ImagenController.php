<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //
    public function store(Request $request)
    {
        //   $input = $request->all();
        $imagen = $request->file('file');//obtener el archivo

        $nombreImagen = Str::uuid() . "." . $imagen->extension();//


        $imagenServidor = Image::make($imagen);

        $imagenServidor->fit(1000,1000);//tamaño de 1000 *1000 pixeles


        //mover al servidor la img
       $imagenPath = public_path('uploads') ."/" . $nombreImagen;
       $imagenServidor->save($imagenPath);//la guardamos, guarda esa ruta o mueva la imagen hacia esa ruta con ese nombre

        return response()->json(['imagen'=>$nombreImagen]);
    }

}
