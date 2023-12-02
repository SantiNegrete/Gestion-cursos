<?php

namespace Database\Factories;

use App\Models\Tema;
use App\Models\Unidade;
use App\Models\Practica;
use App\Models\Calendario;
use App\Models\Instrumentacion;
use Illuminate\Database\Eloquent\Factories\Factory;

class TemaFactory extends Factory
{
    protected $model = Tema::class;

    public function definition()
    {
        return [
            'id_unidad' => Unidade::factory(), // Esto creará una nueva Unidade y usará su ID
            'nombre' => $this->faker->sentence, // Genera un nombre ficticio
            'practica_id' => Practica::factory(), // Esto creará una nueva Practica y usará su ID
            'calendario_id' => Calendario::factory(), // Esto creará un nuevo Calendario y usará su ID
            'instrumentacion_id' => Instrumentacion::factory(), // Esto creará una nueva Instrumentacion y usará su ID
        ];
    }
}
