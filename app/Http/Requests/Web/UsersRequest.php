<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // print_r($this->route('user'));
        // exit;

        $id = base64_decode(base64_decode($this->route('user'))) ?? null;

        if ($id === null) 
        {
            return [
                'first_name'=> 'required|regex:/^[a-zA-Z0-9\s]+$/u',
                'last_name' => 'required|regex:/^[a-zA-Z0-9\s]+$/u',
                'email'     => 'required|email|unique:users,email',
                'password'  => 'required|min:6',
                'confirm_password'  => 'required|same:password',
                'role'      => 'required',
            ];
        }
        else
        {
            return [
                'first_name'=> 'required|regex:/^[a-zA-Z0-9\s]+$/u',
                'last_name' => 'required|regex:/^[a-zA-Z0-9\s]+$/u',
                'email'     => 'required|email|unique:users,email,'.$id,
                'password'  => 'nullable|min:6',
                'confirm_password'  => 'same:password'
            ];
        }
    }

    public function messages()
    {
        return [

            'first_name.regex'      => 'First name should accept letter\'s and numbers only.',
            'last_name.regex'       => 'Last name should accept letter\'s and numbers only.',

            'first_name.required'   => __('admin.ERR_FIRST_NAME'),
            'last_name.required'    => __('admin.ERR_LAST_NAME'),
            
            'email.required'        => __('admin.ERR_EMAIL_NAME'),
            'email.email'           => __('admin.ERR_EMAIL_FORMAT'),
            'email.unique'          => __('admin.ERR_EMAIL_DUP'),
            
            'password.required'     => __('admin.ERR_PASS'),
            'password.min'          => __('admin.ERR_PASS_MIN_SIZE'),

            'confirm_password.required' => __('admin.ERR_CONFIRM_PASS'),
            'confirm_password.same' => __('admin.ERR_COMPARE_PASS'),
            
            'role.required'         => __('admin.ERR_ROLE'),
        ];
    }
}
