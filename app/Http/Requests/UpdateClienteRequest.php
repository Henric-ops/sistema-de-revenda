<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
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
            'nome' => 'required|string|max:255|min:3',
            'celular' => 'required|string|max:20|min:10',
            'observacoes' => 'nullable|string|max:1000',
            'ativo' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',
            'nome.max' => 'O nome não pode exceder 255 caracteres.',
            'celular.required' => 'O celular é obrigatório.',
            'celular.min' => 'O celular deve ter pelo menos 10 dígitos.',
            'celular.max' => 'O celular não pode exceder 20 caracteres.',
            'observacoes.max' => 'As observações não podem exceder 1000 caracteres.',
        ];
    }
}
