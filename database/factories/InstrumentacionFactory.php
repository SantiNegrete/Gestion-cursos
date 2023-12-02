<?php

namespace Database\Factories;

use App\Models\Instrumentacion;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstrumentacionFactory extends Factory
{
    protected $model = Instrumentacion::class;

    public function definition()
    {
        return [
            'tipo_instrumentacion' => $this->faker->randomElement(['Catedra Docente', 'Práctica de Laboratorio', 'Proyecto']),
            
        ];
    }
}
