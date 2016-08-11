<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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

        $id = $this->segment(3);

        //dd($id);
        //dd($this->method);
        $rules =[
            //
            'name'      =>  "required|unique:users,name,{$id},id",
            'email'     =>  "required|unique:users,email,{$id},id",
            'password'  =>  'same:password_confirmation|required_unless:_method,PUT|min:10|alpha_num'
        ];

        if(!\Auth::user()->is('customer')){
            $rules['role_id']   =  'required';
        }

        return $rules;
    }
}
