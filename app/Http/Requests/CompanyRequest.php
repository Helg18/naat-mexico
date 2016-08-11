<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CompanyRequest extends Request
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

        $id = $this->segment(2);

        //dd($id);
        //dd($this->method);

        return [
            //
            //'name'      =>  "required|unique:companies,name,{$id},id"
            'name'      =>  "required"
        ];
    }
}
