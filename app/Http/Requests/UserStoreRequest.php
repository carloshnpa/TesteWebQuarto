<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'required|max:191',
            'email'       => 'required',
            'password'    => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.requided'     => 'Por favor, informe o seu nome.',
            'name.max'          => 'Nome não deve ser maior que 191 caractéres',
            'email.required'    => 'Por favor, informe um email',
            'password.required' => 'Por favor, informe a senha'
        ];
    }
}
