<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class RolesRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id  = base64_decode(base64_decode($this->route('endID'))) ?? null;
        if ($id === null) 
        {         
            return [
                'name'=> 'required|regex:/^[a-zA-Z\-]+$/u|unique:roles,name'
            ];
        }else{
            return [
                'name'=> 'required|regex:/^[a-zA-Z\-]+$/u|unique:roles,name,'.$id
            ];
        }
        
    }

    public function messages()
    {
        return [
            'name.regex'   => 'Role name should accept letter\'s and \'-\' only.',
            'name.unique'   => 'Role name has already taken.',
            'name.required'   => 'Role name field is required.'
        ];
    }
}


// public function rules()
//     {
//         'role' => 'required|unique:roles,name'
//     }

//     public function messages()
//     {
//         return [

//             'role.unique' => 'Role name already taken.',
//             'role.required' => 'Role name field is required.',
//         ];
//     }