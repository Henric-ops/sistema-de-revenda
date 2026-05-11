<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Compra extends Model
{
    protected $fillable = [
        'cliente_id',
        'descricao_produtos',
        'valor_total',
        'forma_pagamento',
        'qtd_parcelas',
        'status',
        'observacoes',
        'data_compra',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function pagamentos()
    {
        return $this->hasMany(Pagamento::class);
    }
}
