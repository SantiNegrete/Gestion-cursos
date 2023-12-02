<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Usuario;
use App\Models\Asignatura;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;

class AsignaturasAPIControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Crear roles necesarios
        Role::create(['name' => 'Docente', 'guard_name' => 'web']);
        Role::create(['name' => 'Jefe', 'guard_name' => 'web']);

        // Crear un usuario de prueba y asignarle un rol
        $user = Usuario::factory()->create();
        $user->assignRole('Docente'); // Asumiendo que el usuario necesita este rol

        // Usar Sanctum para autenticación API
        Sanctum::actingAs($user);
    }

    public function test_index_returns_asignaturas()
    {
        $asignatura = Asignatura::factory()->create();

        $response = $this->getJson('/api/asignaturas');

        $response->assertStatus(200)
                 ->assertJson([
                     'asignaturas' => true
                 ]);
    }

    public function test_store_creates_new_asignatura()
    {
        $asignaturaData = Asignatura::factory()->make()->toArray();

        $response = $this->postJson('/api/asignaturas', $asignaturaData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('asignaturas', $asignaturaData);
    }

    public function test_show_returns_asignatura()
    {
        $asignatura = Asignatura::factory()->create();

        $response = $this->getJson("/api/asignaturas/{$asignatura->id}");

        $response->assertStatus(200)
                 ->assertJson($asignatura->toArray());
    }

    public function test_update_modifies_existing_asignatura()
    {
        $asignatura = Asignatura::factory()->create();
        $newData = Asignatura::factory()->make()->toArray();

        $response = $this->putJson("/api/asignaturas/{$asignatura->id}", $newData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('asignaturas', $newData);
    }

    public function test_destroy_deletes_asignatura()
    {
        $asignatura = Asignatura::factory()->create();
    
        $response = $this->deleteJson("/api/asignaturas/{$asignatura->id}");
    
        $response->assertStatus(200);
    
        // Verificar que el registro ha sido eliminado
        $this->assertDatabaseMissing('asignaturas', ['id' => $asignatura->id]);
    }
    
    
}
