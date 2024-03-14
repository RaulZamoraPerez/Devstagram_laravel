<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable =[
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];
    public function user()
    {                                                 //con sleect nos traemos los valores que usaremos nomas
       return $this->belongsTo(User::class)->select(['name','username']);//relacion inversa un post- un usuario
    }
}
