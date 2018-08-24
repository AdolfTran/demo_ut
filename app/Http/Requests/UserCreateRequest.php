<?php

namespace App\Http\Requests;

use App\Rules\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'user_last_name'       => 'required|string|max:100',
            'user_first_name'      => 'required|string|max:100',
            'manage_role_id' => 'required',
            'email' => 'required|email|confirmed|max:320|unique:manage_users,email,NULL,id,deleted_at,NULL',
            'email_confirmation'    => 'required|email|same:email',
            'password' => [
                'required',
                'confirmed',
                new PasswordRule()
            ],
            'password_confirmation' => 'required|same:password'

        ];
    }
}
