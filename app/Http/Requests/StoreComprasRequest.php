<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreComprasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cliente_id' => 'required|exists:clientes,id',
            'descricao_produtos' => 'required|string',
            'valor_total' => 'required|numeric|min:0.01',
            'forma_pagamento' => 'required|string',
            'qtd_parcelas' => 'required|integer|min:1',
            'observacoes' => 'nullable|string',
            'data_compra' => 'required|date',
        ];
    }
}
