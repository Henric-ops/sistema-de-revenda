<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompraFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cliente_id' => Cliente::factory(),
            'descricao_produtos' => $this->faker->sentence(),
            'valor_total' => $this->faker->randomFloat(2, 50, 5000),
            'forma_pagamento' => $this->faker->randomElement(['dinheiro', 'credito', 'debito']),
            'qtd_parcelas' => $this->faker->numberBetween(1, 12),
            'status' => $this->faker->randomElement(['pendente', 'parcialmente_pago', 'pago']),
            'observacoes' => $this->faker->optional()->sentence(),
            'data_compra' => $this->faker->date(),
        ];
    }
}
