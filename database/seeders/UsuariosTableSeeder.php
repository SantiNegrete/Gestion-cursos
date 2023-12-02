<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegúrate de que el rol 'Admin' existe. Si no, créalo.
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);

        // Crear un usuario administrador
        $admin = Usuario::create([
            'name' => 'Santiago Negrete',
            'email' => 'snegrete257@gmail.com',
            'password' => Hash::make('$anti12345'),
            // Elimina la línea 'role_id'
        ]);

        // Asigna el rol 'Admin' al usuario
        $admin->assignRole($adminRole);

        // Crear 99 usuarios más con el factory
        Usuario::factory(99)->create();
    }
}   
