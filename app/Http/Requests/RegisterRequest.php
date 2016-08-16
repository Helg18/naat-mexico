<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;


class RegisterRequest extends Request
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
        'nombre'            => 'required|required_with:apellido',
        'apellido'          => 'required|required_with:nombre',
        'email'             => 'required|email|unique:users,email',
        'pass'              => 'required|min:6|same:rpass',
        'fecha_nac'         => 'required|date|before:tomorrow',
        'fecha_ingreso_uvm' => 'required|date|before:tomorrow',
        'celular'           => 'required|min:10|max:10',
        'campus'            => 'required',
        'num_empleado'      => 'required',
        'puesto'            => 'required',
        'metas_ni'          => 'required',
        'metas_pno'         => 'required'
        ];
    }

}
