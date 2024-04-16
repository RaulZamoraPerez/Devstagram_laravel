<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLiked=false;
    public $likes;

    public function mount($post)
    { 
          $this->isLiked= $post->checkLine(auth()->user());
          $this->likes = $post->likes->count();
    }

    public function like()
    {
        if($this->post->checkLine(auth()->user())){
          $this->post->likes()->where('post_id', $this->post->id)->delete();
          $this->isLiked=false;
          $this->likes--;
        }else{
              $this->post->likes()->create([
                'user_id'=>auth()->user()->id
               ]);
               $this->isLiked=true;
               $this->likes++;
        }
    }
    public function render()
    {
        return view('livewire.like-post');
    }
}


/*
esta parte funciona con laravel aquí puedes ejecutar
 un modelo solo que no puedes acceder en este archivo es el REQUEST 
 livewire tiene su propia forma de hacerlo
*/
