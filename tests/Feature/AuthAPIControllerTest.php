<?php

use Tests\TestCase;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Spatie\Permission\Models\Role;

class AuthAPIControllerTest extends TestCase
{
    use RefreshDatabase; 
    use WithoutMiddleware; 

    protected function setUp(): void
    {
        parent::setUp();

        // Crear roles necesarios
        Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        Role::create(['name' => 'Docente', 'guard_name' => 'web']);
        Role::create(['name' => 'Jefe', 'guard_name' => 'web']);

        
    }

    public function test_login_success()
    {
        // Crear un usuario de prueba
        $user = Usuario::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password')
        ]);

        // Enviar petición de inicio de sesión
        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        // Afirmaciones
        $response->assertStatus(200);
        $response->assertJsonStructure(['token']);
    }

    public function test_login_failure()
    {
        // Enviar petición de inicio de sesión con credenciales incorrectas
        $response = $this->postJson('/api/login', [
            'email' => 'wrong@example.com',
            'password' => 'wrongpassword'
        ]);

        // Afirmaciones
        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Acceso denegado'
        ]);
    }
}