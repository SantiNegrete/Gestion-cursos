<?php

namespace Database\Factories;

use App\Models\Asignatura;
use Illuminate\Database\Eloquent\Factories\Factory;

class AsignaturaFactory extends Factory
{
    protected $model = Asignatura::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->sentence(3), 
            'objetivo' => $this->faker->paragraph, 
            'competencia_general' => $this->faker->text(200), 
            'competencia_especifica' => $this->faker->text(200), 
            'fuentes_informacion' => $this->faker->sentence(6) 
        ];
    }
}
