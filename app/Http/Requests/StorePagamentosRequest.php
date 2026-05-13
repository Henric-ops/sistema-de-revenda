<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'valor_pago' => [
                'required',
                'numeric',
                'min:0.01',
                'max:999999.99',
                function ($attribute, $value, $fail) {
                    $compra = \App\Models\Compra::find($this->compra_id);
                    if ($compra && $value > $compra->saldo_restante) {
                        $fail("O valor pago ({$value}) não pode ser maior que o saldo restante ({$compra->saldo_restante}).");
                    }
                },
            ],
            'metodo_pagamento' => [
                'required',
                'string',
                'max:50',
                Rule::in(['dinheiro', 'credito', 'debito', 'pix', 'boleto', 'cheque', 'transferencia']),
            ],
            'data_pagamento' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'before_or_equal:today',
            ],
            'observacoes' => 'nullable|string|max:500',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'compra_id.required' => 'A compra é obrigatória.',
            'compra_id.exists' => 'A compra selecionada não existe.',
            'valor_pago.required' => 'O valor pago é obrigatório.',
            'valor_pago.numeric' => 'O valor pago deve ser um número.',
            'valor_pago.min' => 'O valor pago deve ser maior que zero.',
            'valor_pago.max' => 'O valor pago não pode exceder 999.999,99.',
            'metodo_pagamento.required' => 'O método de pagamento é obrigatório.',
            'metodo_pagamento.in' => 'O método de pagamento inválido.',
            'data_pagamento.required' => 'A data do pagamento é obrigatória.',
            'data_pagamento.date' => 'A data deve estar no formato válido.',
            'data_pagamento.before_or_equal' => 'A data do pagamento não pode ser no futuro.',
            'observacoes.max' => 'As observações não podem ter mais de 500 caracteres.',
        ];
    }
}
