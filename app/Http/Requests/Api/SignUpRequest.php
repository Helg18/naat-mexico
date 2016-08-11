<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Request;

class SignUpRequest extends Request
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
            //
            //'name'      =>  "required|unique:plans,name,{$id},id",
            'email'             =>  "required|unique:users,email",
            'password'          =>  "required",
            'last_name'         =>  "required",
            'day_of_birth'      =>  "required",
            'sex'               =>  "required",
            'marital_status'    =>  "required",
            'state'             =>  "required",
            'city'              =>  "required",
            'zip'               =>  "required",
            'address'           =>  "required",


        ];
    }
}
