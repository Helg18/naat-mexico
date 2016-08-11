<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PlanRequest extends Request
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

        return [
            //
            'name'      =>  "required|unique:plans,name,{$id},id",
            'limit_user'   =>  'required',
            'limit_quiz'   =>  'required',
            'price'   =>  'required',

        ];
    }
}
