<?php

namespace Database\Factories;

use App\Models\Unidade;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnidadeFactory extends Factory
{
    protected $model = Unidade::class;

    public function definition()
    {
        return [
            // Define los atributos de tu modelo aquí
            'asignatura_id' => 1, // Asegúrate de que este ID exista en la base de datos o ajústalo según sea necesario
            'nombre' => $this->faker->word,
            'objetivo' => $this->faker->sentence,
        ];
    }
}
