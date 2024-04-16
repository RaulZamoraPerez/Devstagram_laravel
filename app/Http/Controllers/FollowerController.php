<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user){
          //dd($user->username);

         $user->followers()->attach(auth()->user()->id);
         return back();
    }

    public function destroy(User $user){
       $user->followers()->detach(auth()->user()->id);//detach eliminar en vez de delete
       return back();
    }
}


/*
Y anterior mente vimos que se podía hacer asi con create([
Sin embargo como esta es una relación con tablas pivote puedes usar 
o se recomienda mas pq es mas fácil usar attch y es util cuando tienes relacion muchos a muchos

*/