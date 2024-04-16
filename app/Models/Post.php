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
    public function comentarios()
    {
        return $this-> hasMany(Comentario::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
/*Arriba tenemos la relación de likes asi que podemos usarla   no como funcion  porque eso es la funcion y solo queremos la información 
Ponemos  contains()  esto lo que hace es ir automáticamente debido a la relación y al modelo que tenemos y como ese modelo esta asociado a la migración y también al controlador, se sitúa en likes aquí  en el de debajo de la bd
y ese constains  va a revisar cualquiera de las columnas que tenemos en esta tabla entonces revisa el  de user_id  contiene user->id


, LO QUE HACE ESTO ES POSICIONARSE EN LA TABLA DE LIKES  DE LA BASE DE DATOS
 
Y UTILIZANDO CONTAINS  LE DECIMOS ESTA TABLA DE LIKES CONTIENE EN LA COLUMNA DE USER_ID  
 
CONTIENE ESTE USUARIO
 
DE ESTE POST
 
ESO ES LO QUE REVISA ESTE CHECLINE


*/
    public function checkLine(User $user){
         return $this->likes->contains('user_id', $user->id);///
    }
}
