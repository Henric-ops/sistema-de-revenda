<?php

namespace Tests\Unit;

use App\Models\Cliente;
use App\Models\Compra;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClienteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pode_criar_cliente()
    {
        $cliente = Cliente::create([
            'nome' => 'João Silva',
            'celular' => '11999999999',
            'observacoes' => 'Cliente vip',
            'ativo' => true,
        ]);

        $this->assertDatabaseHas('clientes', [
            'nome' => 'João Silva',
            'celular' => '11999999999',
        ]);
    }

    /** @test */
    public function cliente_tem_compras()
    {
        $cliente = Cliente::factory()->create();
        
        Compra::create([
            'cliente_id' => $cliente->id,
            'descricao_produtos' => 'Produto teste',
            'valor_total' => 100.00,
            'forma_pagamento' => 'credito',
            'qtd_parcelas' => 1,
            'status' => 'pendente',
            'data_compra' => now(),
        ]);

        $this->assertCount(1, $cliente->compras);
        $this->assertInstanceOf(Compra::class, $cliente->compras->first());
    }

    /** @test */
    public function cliente_pode_ser_inativo()
    {
        $cliente = Cliente::create([
            'nome' => 'Pedro Santos',
            'celular' => '11988888888',
            'ativo' => false,
        ]);

        $this->assertFalse($cliente->ativo);
    }

    /** @test */
    public function deletar_cliente_deleta_compras()
    {
        $cliente = Cliente::factory()->create();
        
        Compra::create([
            'cliente_id' => $cliente->id,
            'descricao_produtos' => 'Produto teste',
            'valor_total' => 100.00,
            'forma_pagamento' => 'credito',
            'qtd_parcelas' => 1,
            'status' => 'pendente',
            'data_compra' => now(),
        ]);

        $compraId = $cliente->compras->first()->id;
        $cliente->delete();

        $this->assertDatabaseMissing('compras', ['id' => $compraId]);
    }
}
