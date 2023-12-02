<?php

namespace Database\Factories;

use App\Models\Practica;
use Illuminate\Database\Eloquent\Factories\Factory;

class PracticaFactory extends Factory
{
    protected $model = Practica::class;

    public function definition()
    {
        return [
            'descripcion' => $this->faker->sentence, 
        ];
    }
}
