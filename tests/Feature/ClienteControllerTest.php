<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClienteControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function usuario_nao_autenticado_nao_pode_acessar_clientes()
    {
        $response = $this->get('/clientes');
        $response->assertRedirect('/login');
    }

    /** @test */
    public function usuario_autenticado_pode_listar_clientes()
    {
        Cliente::factory(3)->create();

        $response = $this->actingAs($this->user)->get('/clientes');
        $response->assertStatus(200);
        $response->assertViewHas('clientes');
    }

    /** @test */
    public function pode_criar_cliente()
    {
        $response = $this->actingAs($this->user)
            ->post('/clientes', [
                'nome' => 'João Silva',
                'celular' => '11999999999',
                'observacoes' => 'Cliente teste',
            ]);

        $response->assertRedirect('/clientes');
        $this->assertDatabaseHas('clientes', [
            'nome' => 'João Silva',
            'celular' => '11999999999',
        ]);
    }

    /** @test */
    public function nao_cria_cliente_sem_nome()
    {
        $response = $this->actingAs($this->user)
            ->post('/clientes', [
                'celular' => '11999999999',
            ]);

        $response->assertSessionHasErrors('nome');
        $this->assertDatabaseCount('clientes', 0);
    }

    /** @test */
    public function nao_cria_cliente_sem_celular()
    {
        $response = $this->actingAs($this->user)
            ->post('/clientes', [
                'nome' => 'João Silva',
            ]);

        $response->assertSessionHasErrors('celular');
    }

    /** @test */
    public function pode_editar_cliente()
    {
        $cliente = Cliente::factory()->create([
            'nome' => 'Original',
            'celular' => '11999999999',
        ]);

        $response = $this->actingAs($this->user)
            ->put("/clientes/{$cliente->id}", [
                'nome' => 'Novo Nome',
                'celular' => '11988888888',
            ]);

        $response->assertRedirect("/clientes/{$cliente->id}");
        $this->assertDatabaseHas('clientes', [
            'id' => $cliente->id,
            'nome' => 'Novo Nome',
            'celular' => '11988888888',
        ]);
    }

    /** @test */
    public function pode_deletar_cliente()
    {
        $cliente = Cliente::factory()->create();

        $response = $this->actingAs($this->user)
            ->delete("/clientes/{$cliente->id}");

        $response->assertRedirect('/clientes');
        $this->assertDatabaseMissing('clientes', ['id' => $cliente->id]);
    }

    /** @test */
    public function pode_visualizar_detalhes_cliente()
    {
        $cliente = Cliente::factory()->create();

        $response = $this->actingAs($this->user)
            ->get("/clientes/{$cliente->id}");

        $response->assertStatus(200);
        $response->assertViewHas('cliente');
    }
}
