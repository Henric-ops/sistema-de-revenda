<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nome',
        'celular',
        'observacoes',
        'ativo',
    ];

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }
}
