<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Unidade;
use App\Models\Asignatura;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Role;

class UnidadesAPIControllerTest extends TestCase
{
    use RefreshDatabase;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        // Crear roles necesarios
        Role::create(['name' => 'Docente', 'guard_name' => 'web']);
        Role::create(['name' => 'Jefe', 'guard_name' => 'web']);

        // Crear un usuario de prueba y autenticarlo
        $this->user = Usuario::factory()->create();
        $this->user->assignRole('Docente'); // Asegúrate de que el rol 'Docente' exista
        Sanctum::actingAs($this->user);

        // Crear una asignatura de prueba
        Asignatura::factory()->create(['id' => 1]);
    }

    public function test_index_returns_unidades()
    {
        $response = $this->getJson('/api/unidades');
        $response->assertStatus(200);
    }

    public function test_store_creates_new_unidad()
    {
        $unidadeData = [
            'asignatura_id' => 1,
            'nombre' => 'Unidad de Prueba',
            'objetivo' => 'Objetivo de prueba'
        ];

        $response = $this->postJson('/api/unidades', $unidadeData);
        $response->assertStatus(201);
        $this->assertDatabaseHas('unidades', $unidadeData);
    }

    public function test_show_returns_unidad()
    {
        $unidade = Unidade::factory()->create();
        $response = $this->getJson("/api/unidades/{$unidade->id}");
        $response->assertStatus(200);
    }

    public function test_update_modifies_existing_unidad()
    {
        $unidade = Unidade::factory()->create();
        $updatedData = [
            'asignatura_id' => $unidade->asignatura_id, // Incluye el ID de asignatura existente
            'nombre' => 'Nombre Actualizado', 
            'objetivo' => 'Objetivo Actualizado'
        ];
    
        $response = $this->putJson("/api/unidades/{$unidade->id}", $updatedData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('unidades', $updatedData);
    }
    

    public function test_destroy_deletes_unidad()
    {
        $unidade = Unidade::factory()->create();
        $response = $this->deleteJson("/api/unidades/{$unidade->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('unidades', ['id' => $unidade->id]);
    }
}
