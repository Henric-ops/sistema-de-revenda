<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;


    class Compra extends Model
    {
        use HasFactory;
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

        public function getSaldoRestanteAttribute()
        {
            return $this->valor_total - $this->pagamentos->sum('valor_pago');
        }
    }
