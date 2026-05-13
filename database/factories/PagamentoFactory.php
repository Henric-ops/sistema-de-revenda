<?php

namespace Database\Factories;

use App\Models\Compra;
use Illuminate\Database\Eloquent\Factories\Factory;

class PagamentoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'compra_id' => Compra::factory(),
            'valor_pago' => $this->faker->randomFloat(2, 10, 500),
            'metodo_pagamento' => $this->faker->randomElement(['dinheiro', 'credito', 'debito', 'pix']),
            'data_pagamento' => $this->faker->date(),
            'observacoes' => $this->faker->optional()->sentence(),
        ];
    }
}
