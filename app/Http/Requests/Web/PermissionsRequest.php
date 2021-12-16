<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class PermissionsRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
                'role'=> 'required'
            ];
    }

    public function messages()
    {
        return [
            'role.required'   => 'Role field is required'
        ];
    }
}
