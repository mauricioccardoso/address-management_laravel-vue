<?php

namespace App\Http\Requests;

use App\Models\Address;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        return [
            'cep' => [
                'required',
                'string',
                'regex:/^\d{5}-\d{3}$/',
                Rule::unique('addresses', 'cep')->ignore($this->address->id)
            ],
            'street' => ['required', 'string', 'min:3'],
            'neighborhood' => ['required', 'string',],
            'city' => ['required', 'string', 'min:3'],
            'state' => ['required', 'string', 'size:2'],
        ];
    }

    public function messages()
    {
        return [
            'cep.regex' => "O campo CEP está em um formato inválido. O campo deve ter o formato de '00000-000'.",
            'cep.unique' => 'O CEP informado já está cadastrado',

            '*.required' => 'Os campos de CEP, logradouro, bairro, cidade e estado são obrigatórios',
            '*.string' => 'Os campos de CEP, logradouro, bairro, cidade e estado devem ser um conjunto de caracteres',
            '*.min' => 'Os campos de logradouro e cidade devem ter no mínimo :min caracteres.',

            'state.size' => 'O campo estado deve ser uma sigla de :size caracteres'
        ];
    }
}
