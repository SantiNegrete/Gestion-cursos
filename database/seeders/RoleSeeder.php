<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles y asignar permisos existentes
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Docente']);
        $role3 = Role::create(['name' => 'Jefe']);

        // Crear permisos
        Permission::create(['name' => 'Acceso'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'Nuevo'])->syncRoles([$role1]);
        Permission::create(['name' => 'Editar'])->syncRoles([$role1]);
        Permission::create(['name' => 'Eliminar'])->syncRoles([$role1]);

        
    }
}
