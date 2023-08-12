<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchAddressRequest extends FormRequest
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
    public function rules()
    {
        return [
            'cep' => [
                'required_without_all:street,neighborhood,city,state',
                'string',
                'regex:/^\d{5}-\d{3}$/'
            ],

            'street' => ['required_without_all:cep', 'string', 'min:3'],
            'neighborhood' => ['nullable', 'string'],
            'city' => ['required_without_all:cep', 'string', 'min:3'],
            'state' => ['required_without_all:cep', 'string', 'size:2'],
        ];
    }

    public function messages()
    {
        return [
            'cep.regex' => "O campo CEP está em um formato inválido. O campo deve ter o formato de '00000-000'.",

            '*.required_without_all' => 'Preencha o CEP ou os campos logradouro, cidade e estado.',
            '*.string' => 'O campo de CEP ou os campos de logradouro, cidade e estado devem ser um conjunto de caracteres',
            '*.min' => 'Os campos de logradouro e cidade devem ter no mínimo :min caracteres.',

            'state.size' => 'O campo estado deve ser uma sigla de :size caracteres',
        ];
    }
}
