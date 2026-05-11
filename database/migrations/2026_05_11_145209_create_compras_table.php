<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')
                ->constrained()
                ->onDelete('cascade');
            $table->text('descricao_produtos');
            $table->decimal('valor_total', 10, 2);
            $table->string('forma_pagamento');
            $table->integer('qtd_parcelas')
                ->default(1);
            $table->string('status')
                ->default('pendente');
            $table->text('observacoes')
                ->nullable();
            $table->date('data_compra');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
