<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CrearPremiosRequest extends Request
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
            'premios'             => 'required|min:5',
            'descripcion_premios' => 'required|min:50'
        ];
    }
}
