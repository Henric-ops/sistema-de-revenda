<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePagamentosRequest extends FormRequest
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
            'compra_id' => 'required|exists:compras,id',
            'valor_pago' => 'required|numeric|min:0.01',
            'metodo_pagamento' => 'required|string',
            'data_pagamento' => 'required|date',
            'observacoes' => 'nullable|string',
        ];
    }
}
