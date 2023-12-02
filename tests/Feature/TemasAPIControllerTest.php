<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Unidade;
use App\Models\Asignatura;
use App\Models\Tema;
use App\Models\Practica;
use App\Models\Calendario;
use App\Models\Instrumentacion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use App\Models\Usuario;
use Spatie\Permission\Models\Role;

class TemasAPIControllerTest extends TestCase
{
    use RefreshDatabase;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
    
        // Crear roles necesarios
        Role::create(['name' => 'Docente', 'guard_name' => 'web']);
        Role::create(['name' => 'Jefe', 'guard_name' => 'web']);
    
        // Crear un usuario y autenticarlo con Sanctum
        $user = Usuario::factory()->create();
        $user->assignRole('Docente'); // O el rol que necesites asignar al usuario
        Sanctum::actingAs($user);
    
        // Crear datos necesarios
        Asignatura::factory()->create(['id' => 1]);
        Practica::factory()->create(['id' => 1]);
        Calendario::factory()->create(['id' => 1]);
        Instrumentacion::factory()->create(['id' => 1]);
        Unidade::factory()->create(['asignatura_id' => 1]);
    }
    

    public function test_index_returns_temas()
    {
        // Crear temas en la base de datos
        $tema = Tema::factory()->create(['id_unidad' => 1]);

        $response = $this->getJson("/api/temas/{$tema->id_unidad}");

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => ['id', 'nombre', 'id_unidad', 'practica_id', 'calendario_id', 'instrumentacion_id']
                 ]);
    }

    public function test_store_creates_new_tema()
    {
        $temaData = [
            'id_unidad' => 1,
            'nombre' => 'Nuevo Tema',
            'practica_id' => 1,
            'calendario_id' => 1,
            'instrumentacion_id' => 1
        ];

        $response = $this->postJson('/api/temas', $temaData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('temas', $temaData);
    }

    public function test_show_returns_tema()
    {
        $tema = Tema::factory()->create();

        $response = $this->getJson("/api/temas/{$tema->id}");

        $response->assertStatus(200)
                 ->assertJson($tema->toArray());
    }

    public function test_update_modifies_existing_tema()
    {
        $tema = Tema::factory()->create();
        $updatedData = [
            'nombre' => 'Nombre Actualizado',
            'practica_id' => $tema->practica_id,
            'calendario_id' => $tema->calendario_id,
            'instrumentacion_id' => $tema->instrumentacion_id
        ];

        $response = $this->putJson("/api/temas/{$tema->id}", $updatedData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('temas', $updatedData);
    }

    public function test_destroy_deletes_tema()
    {
        $tema = Tema::factory()->create();

        $response = $this->deleteJson("/api/temas/{$tema->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('temas', ['id' => $tema->id]);
    }
}
