<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsuarioFactory extends Factory
{
    protected $model = Usuario::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Asegúrate de que la contraseña sea adecuada para tus pruebas
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Usuario $user) {
            $roles = ['Docente', 'Jefe']; // Lista de roles disponibles
            $user->assignRole($this->faker->randomElement($roles)); // Asigna un rol aleatorio
        });
    }
}
