<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //aqui es donde puedes definir tus datos falsos 
            'titulo'=> $this->faker->sentence(5),//crea un enunciado con 5 palabras  con sentence
            'descripcion'=>$this->faker->sentence(20) ,//faker es la libreria aqui pones 20 palabras
            'imagen'=> $this->faker->uuid() . '.jpg',//agrega el uunid id y concatena con el jpg, compruebas que venga el unique id y la extencio
            'user_id' => $this->faker->randomElement([1,8,9]),// 
        ];
    }
}
