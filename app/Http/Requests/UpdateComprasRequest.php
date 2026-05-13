<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateComprasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'cliente_id' => [
                'required',
                'exists:clientes,id'
            ],

            'descricao_produtos' => [
                'required',
                'string',
                'min:5',
                'max:1000'
            ],

            'valor_total' => [
                'required',
                'numeric',
                'min:0.01',
                'max:999999.99'
            ],

            'forma_pagamento' => [
                'required',
                'string',
                Rule::in([
                    'pix',
                    'dinheiro',
                    'debito',
                    'credito',
                    'crediario'
                ]),
            ],

            'qtd_parcelas' => [
                'required',
                'integer',
                'min:1',
                'max:120'
            ],

            'status' => [
                'nullable',
                Rule::in([
                    'pendente',
                    'parcialmente_pago',
                    'pago'
                ]),
            ],

            'observacoes' => [
                'nullable',
                'string',
                'max:1000'
            ],

            'data_compra' => [
                'required',
                'date'
            ],

        ];
    }

    public function messages(): array
    {
        return [

            'cliente_id.required' => 'O cliente é obrigatório.',
            'cliente_id.exists' => 'O cliente selecionado não existe.',

            'descricao_produtos.required' => 'A descrição dos produtos é obrigatória.',
            'descricao_produtos.min' => 'A descrição deve ter no mínimo 5 caracteres.',
            'descricao_produtos.max' => 'A descrição não pode exceder 1000 caracteres.',

            'valor_total.required' => 'O valor total é obrigatório.',
            'valor_total.numeric' => 'Informe um valor válido.',
            'valor_total.min' => 'O valor deve ser maior que zero.',

            'forma_pagamento.required' => 'Selecione uma forma de pagamento.',
            'forma_pagamento.in' => 'A forma de pagamento selecionada é inválida.',

            'qtd_parcelas.required' => 'Informe a quantidade de parcelas.',
            'qtd_parcelas.integer' => 'As parcelas devem ser numéricas.',
            'qtd_parcelas.min' => 'Mínimo de 1 parcela.',
            'qtd_parcelas.max' => 'Máximo de 120 parcelas.',

            'status.in' => 'O status informado é inválido.',

            'observacoes.max' => 'As observações não podem ultrapassar 1000 caracteres.',

            'data_compra.required' => 'A data da compra é obrigatória.',
            'data_compra.date' => 'Data inválida.',
        ];
    }
}