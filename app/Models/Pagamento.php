<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;
    protected $fillable = [
        'compra_id',
        'valor_pago',
        'metodo_pagamento',
        'data_pagamento',
        'observacoes',
    ];


    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }

}
