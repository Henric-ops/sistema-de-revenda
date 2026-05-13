<?php

namespace Tests\Unit;

use App\Models\Cliente;
use App\Models\Compra;
use App\Models\Pagamento;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompraTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pode_criar_compra()
    {
        $cliente = Cliente::factory()->create();
        
        $compra = Compra::create([
            'cliente_id' => $cliente->id,
            'descricao_produtos' => 'Notebook',
            'valor_total' => 2500.00,
            'forma_pagamento' => 'credito',
            'qtd_parcelas' => 3,
            'status' => 'pendente',
            'data_compra' => now(),
        ]);

        $this->assertDatabaseHas('compras', [
            'cliente_id' => $cliente->id,
            'valor_total' => 2500.00,
        ]);
    }

    /** @test */
    public function compra_pertence_cliente()
    {
        $cliente = Cliente::factory()->create();
        $compra = Compra::create([
            'cliente_id' => $cliente->id,
            'descricao_produtos' => 'Produto',
            'valor_total' => 100.00,
            'forma_pagamento' => 'dinheiro',
            'qtd_parcelas' => 1,
            'status' => 'pendente',
            'data_compra' => now(),
        ]);

        $this->assertInstanceOf(Cliente::class, $compra->cliente);
        $this->assertEquals($cliente->id, $compra->cliente->id);
    }

    /** @test */
    public function compra_tem_pagamentos()
    {
        $cliente = Cliente::factory()->create();
        $compra = Compra::create([
            'cliente_id' => $cliente->id,
            'descricao_produtos' => 'Produto',
            'valor_total' => 300.00,
            'forma_pagamento' => 'credito',
            'qtd_parcelas' => 3,
            'status' => 'pendente',
            'data_compra' => now(),
        ]);

        Pagamento::create([
            'compra_id' => $compra->id,
            'valor_pago' => 100.00,
            'metodo_pagamento' => 'dinheiro',
            'data_pagamento' => now(),
        ]);

        $this->assertCount(1, $compra->pagamentos);
    }

    /** @test */
    public function calcula_saldo_restante_corretamente()
    {
        $cliente = Cliente::factory()->create();
        $compra = Compra::create([
            'cliente_id' => $cliente->id,
            'descricao_produtos' => 'Produto',
            'valor_total' => 500.00,
            'forma_pagamento' => 'credito',
            'qtd_parcelas' => 2,
            'status' => 'pendente',
            'data_compra' => now(),
        ]);

        Pagamento::create([
            'compra_id' => $compra->id,
            'valor_pago' => 200.00,
            'metodo_pagamento' => 'dinheiro',
            'data_pagamento' => now(),
        ]);

        $this->assertEquals(300.00, $compra->saldo_restante);
    }

    /** @test */
    public function deletar_compra_deleta_pagamentos()
    {
        $cliente = Cliente::factory()->create();
        $compra = Compra::create([
            'cliente_id' => $cliente->id,
            'descricao_produtos' => 'Produto',
            'valor_total' => 100.00,
            'forma_pagamento' => 'dinheiro',
            'qtd_parcelas' => 1,
            'status' => 'pendente',
            'data_compra' => now(),
        ]);

        $pagamento = Pagamento::create([
            'compra_id' => $compra->id,
            'valor_pago' => 50.00,
            'metodo_pagamento' => 'dinheiro',
            'data_pagamento' => now(),
        ]);

        $pagamentoId = $pagamento->id;
        $compra->delete();

        $this->assertDatabaseMissing('pagamentos', ['id' => $pagamentoId]);
    }
}
