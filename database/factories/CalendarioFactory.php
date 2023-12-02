<?php

namespace Database\Factories;

use App\Models\Calendario;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalendarioFactory extends Factory
{
    protected $model = Calendario::class;

    public function definition()
    {
        return [
            'nombre_semana' => $this->faker->word, // Genera una palabra aleatoria
            'fecha_inicio' => $this->faker->date(), // Genera una fecha aleatoria
            'fecha_fin' => $this->faker->date(), // Genera otra fecha aleatoria
        ];
    }
}
