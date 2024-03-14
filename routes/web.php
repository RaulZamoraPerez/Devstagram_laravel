<?php

use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('principal');
});

//la ruta el controlador, su clase y el metodo de esa clase
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);//una enviemos una peticion post a esa ur entonces llama el metodo store

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);


Route::post('/Logout',[LogoutController::class, 'store'])->name('logout');


//cuando inicia sesion
//user es un modelo que actualmente tenemos en el proyect
Route::get('{user:username}', [PostController::class, 'index'])->name('posts.index');


//publicaciones
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts',[PostController::class, 'store'])->name('posts.store');

Route::post('/imagenes',[ImagenController::class, 'store'])->name('imagenes.store');



