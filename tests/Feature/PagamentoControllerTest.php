<?php

namespace Tests\Feature;

use App\Models\Compra;
use App\Models\Pagamento;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagamentoControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function usuario_nao_autenticado_nao_pode_criar_pagamento()
    {
        $compra = Compra::factory()->create();

        $response = $this->post('/pagamentos', [
            'compra_id' => $compra->id,
            'valor_pago' => 100.00,
            'metodo_pagamento' => 'dinheiro',
            'data_pagamento' => now()->toDateString(),
        ]);

        $response->assertRedirect('/login');
    }

    /** @test */
    public function pode_criar_pagamento()
    {
        $compra = Compra::factory()->create([
            'valor_total' => 300.00,
            'status' => 'pendente',
        ]);

        $response = $this->actingAs($this->user)
            ->post('/pagamentos', [
                'compra_id' => $compra->id,
                'valor_pago' => 100.00,
                'metodo_pagamento' => 'dinheiro',
                'data_pagamento' => now()->toDateString(),
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('pagamentos', [
            'compra_id' => $compra->id,
            'valor_pago' => 100.00,
        ]);
    }

    /** @test */
    public function pagamento_atualiza_status_para_parcialmente_pago()
    {
        $compra = Compra::factory()->create([
            'valor_total' => 300.00,
            'status' => 'pendente',
        ]);

        $this->actingAs($this->user)
            ->post('/pagamentos', [
                'compra_id' => $compra->id,
                'valor_pago' => 100.00,
                'metodo_pagamento' => 'dinheiro',
                'data_pagamento' => now()->toDateString(),
            ]);

        $compra->refresh();
        $this->assertEquals('parcialmente_pago', $compra->status);
    }

    /** @test */
    public function pagamento_atualiza_status_para_pago()
    {
        $compra = Compra::factory()->create([
            'valor_total' => 200.00,
            'status' => 'pendente',
        ]);

        $this->actingAs($this->user)
            ->post('/pagamentos', [
                'compra_id' => $compra->id,
                'valor_pago' => 200.00,
                'metodo_pagamento' => 'dinheiro',
                'data_pagamento' => now()->toDateString(),
            ]);

        $compra->refresh();
        $this->assertEquals('pago', $compra->status);
    }

    /** @test */
    public function nao_cria_pagamento_sem_compra()
    {
        $response = $this->actingAs($this->user)
            ->post('/pagamentos', [
                'valor_pago' => 100.00,
                'metodo_pagamento' => 'dinheiro',
                'data_pagamento' => now()->toDateString(),
            ]);

        $response->assertSessionHasErrors('compra_id');
    }

    /** @test */
    public function nao_cria_pagamento_com_compra_inexistente()
    {
        $response = $this->actingAs($this->user)
            ->post('/pagamentos', [
                'compra_id' => 999,
                'valor_pago' => 100.00,
                'metodo_pagamento' => 'dinheiro',
                'data_pagamento' => now()->toDateString(),
            ]);

        $response->assertSessionHasErrors('compra_id');
    }

    /** @test */
    public function nao_cria_pagamento_com_valor_zero()
    {
        $compra = Compra::factory()->create();

        $response = $this->actingAs($this->user)
            ->post('/pagamentos', [
                'compra_id' => $compra->id,
                'valor_pago' => 0,
                'metodo_pagamento' => 'dinheiro',
                'data_pagamento' => now()->toDateString(),
            ]);

        $response->assertSessionHasErrors('valor_pago');
    }

    /** @test */
    public function pode_deletar_pagamento()
    {
        $compra = Compra::factory()->create([
            'valor_total' => 300.00,
            'status' => 'parcialmente_pago',
        ]);
        $pagamento = Pagamento::factory()->create([
            'compra_id' => $compra->id,
            'valor_pago' => 100.00,
        ]);

        $response = $this->actingAs($this->user)
            ->delete("/pagamentos/{$pagamento->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('pagamentos', ['id' => $pagamento->id]);
    }

    /** @test */
    public function deletar_pagamento_recalcula_status()
    {
        $compra = Compra::factory()->create([
            'valor_total' => 300.00,
            'status' => 'parcialmente_pago',
        ]);
        $pagamento = Pagamento::factory()->create([
            'compra_id' => $compra->id,
            'valor_pago' => 300.00,
        ]);
        $compra->update(['status' => 'pago']);

        $this->actingAs($this->user)
            ->delete("/pagamentos/{$pagamento->id}");

        $compra->refresh();
        $this->assertEquals('pendente', $compra->status);
    }
}
