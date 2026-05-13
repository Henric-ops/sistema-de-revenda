<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'celular' => $this->faker->phoneNumber(),
            'observacoes' => $this->faker->sentence(),
            'ativo' => true,
        ];
    }
}
