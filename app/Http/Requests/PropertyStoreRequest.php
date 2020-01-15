<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyStoreRequest extends FormRequest
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
            'user_id'     => 'required',
            'title'       => 'required|max:191',
            'photo'       => 'required',
            'description' => 'required',
            'value'       => 'required',
            'street'      => 'required',
            'number'      => 'required|integer|max:6',
            'postal_code' => 'required|integer',
            'complement'  => 'max:24',
            'city'        => 'required',
            'state'       => 'required'
        ];
    }

    public function messages()
    {
        return [
            'user_id.required'     => 'user.id not found',
            'title.required'       => 'É preciso um título para seu anúncio.',
            'title.max'            => 'Título do anúncio não deve exceder 191 caractéres.',
            'photo.required'       => 'Uma foto é a melhor maneira de seus anúncios serem vistos, não deixe de enviar.',
            'description.required' => 'Por favor forneça uma descrição para o anúncio.',
            'value.required'       => 'Informe um valor para o anúncio.',
            'street.required'      => 'Informe o nome da rua do seu imóvel anunciado.',
            'number.integer'       => 'O campo só deve conter números.',
            'number.required'      => 'Informe o número do seu imóvel.',
            'number.max'           => 'O número não pode ter mais que 6 dígitos.',
            'postal_code.required' => 'O CEP deve ser fornecido.',
            'postal_code.integer'  => 'O CEP deve conter apenas números.',
            'postal_code.size'     => 'CEP inválido.',
            'complement.max'       => 'O campo não deve conter mais que 24 caratéres.',
            'city.required'        => 'Por favor forneça o nome da cidade.',
            'state.required'       => 'Por favor, informe o estado.',
        ];
    }
}
