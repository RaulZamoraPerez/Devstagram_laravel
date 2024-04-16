<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts()
    {
      return $this->hasMany(Post::class);//es la de one to many
    }
    public function likes(){
       return $this->hasMany(Like::class);  
    }


    //Almacena los seguidores de un usario
      public function followers()//los que me siguen
      { 
          return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
      }

       //Almacenar  los que segumos

       public function following()//los que me siguen
       { 
           return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
       }
 


      //comprobar si un usuario ya a sigue a otro
      public function siguiendo(User $user)//usuario que 
      {
           return $this->followers->contains($user->id);//La función contains() devuelve true si la colección contiene el elemento especificado y false 
      }
   


    
}
