<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\Compra;
use App\Models\Pagamento;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompraControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function usuario_nao_autenticado_nao_pode_acessar_compras()
    {
        $response = $this->get('/compras');
        $response->assertRedirect('/login');
    }

    /** @test */
    public function usuario_autenticado_pode_listar_compras()
    {
        Compra::factory(3)->create();

        $response = $this->actingAs($this->user)->get('/compras');
        $response->assertStatus(200);
        $response->assertViewHas('compras');
    }

    /** @test */
    public function pode_filtrar_compras_por_status()
    {
        Compra::factory(2)->create(['status' => 'pendente']);
        Compra::factory(1)->create(['status' => 'pago']);

        $response = $this->actingAs($this->user)->get('/compras?status=pendente');
        $response->assertStatus(200);
    }

    /** @test */
    public function pode_buscar_compra_por_nome_cliente()
    {
        $cliente = Cliente::factory()->create(['nome' => 'João Silva']);
        Compra::factory()->create(['cliente_id' => $cliente->id]);

        $response = $this->actingAs($this->user)->get('/compras?search=João');
        $response->assertStatus(200);
    }

    /** @test */
    public function pode_criar_compra()
    {
        $cliente = Cliente::factory()->create();

        $response = $this->actingAs($this->user)
            ->post('/compras', [
                'cliente_id' => $cliente->id,
                'descricao_produtos' => 'Notebook',
                'valor_total' => 2500.00,
                'forma_pagamento' => 'credito',
                'qtd_parcelas' => 3,
                'data_compra' => now()->toDateString(),
            ]);

        $response->assertRedirect('/compras');
        $this->assertDatabaseHas('compras', [
            'cliente_id' => $cliente->id,
            'status' => 'pendente',
        ]);
    }

    /** @test */
    public function nao_cria_compra_sem_cliente()
    {
        $response = $this->actingAs($this->user)
            ->post('/compras', [
                'descricao_produtos' => 'Produto',
                'valor_total' => 100.00,
                'forma_pagamento' => 'dinheiro',
                'qtd_parcelas' => 1,
                'data_compra' => now()->toDateString(),
            ]);

        $response->assertSessionHasErrors('cliente_id');
    }

    /** @test */
    public function nao_cria_compra_com_cliente_inexistente()
    {
        $response = $this->actingAs($this->user)
            ->post('/compras', [
                'cliente_id' => 999,
                'descricao_produtos' => 'Produto',
                'valor_total' => 100.00,
                'forma_pagamento' => 'dinheiro',
                'qtd_parcelas' => 1,
                'data_compra' => now()->toDateString(),
            ]);

        $response->assertSessionHasErrors('cliente_id');
    }

    /** @test */
    public function pode_editar_compra()
    {
        $compra = Compra::factory()->create([
            'valor_total' => 1000.00,
        ]);

        $response = $this->actingAs($this->user)
            ->put("/compras/{$compra->id}", [
                'cliente_id' => $compra->cliente_id,
                'descricao_produtos' => 'Produto atualizado',
                'valor_total' => 1500.00,
                'forma_pagamento' => 'dinheiro',
                'qtd_parcelas' => 1,
                'data_compra' => now()->toDateString(),
            ]);

        $response->assertRedirect("/compras/{$compra->id}");
        $this->assertDatabaseHas('compras', [
            'id' => $compra->id,
            'valor_total' => 1500.00,
        ]);
    }

    /** @test */
    public function pode_deletar_compra()
    {
        $compra = Compra::factory()->create();

        $response = $this->actingAs($this->user)
            ->delete("/compras/{$compra->id}");

        $response->assertRedirect('/compras');
        $this->assertDatabaseMissing('compras', ['id' => $compra->id]);
    }

    /** @test */
    public function pode_visualizar_detalhes_compra()
    {
        $compra = Compra::factory()->create();
        Pagamento::factory(2)->create(['compra_id' => $compra->id]);

        $response = $this->actingAs($this->user)
            ->get("/compras/{$compra->id}");

        $response->assertStatus(200);
        $response->assertViewHas('compra');
    }
}
