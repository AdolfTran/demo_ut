<?php

namespace App\Http\Requests;

use App\Models\ManageRole;
use App\Models\ManageUser;
use App\Rules\ManageRoleRule;
use App\Rules\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
        $items = \Input::get();
        $user = ManageUser::find($items['id']);
        $rules = [
            'user_last_name'       => 'required|string|max:100',
            'user_first_name'      => 'required|string|max:100',
            'manage_role_id' => 'required',
            'email' => 'required|email|confirmed|max:320',
            'email_confirmation'    => 'required|email|same:email',
        ];
        if($items['email'] != $user['email']) {
            $rules['email'] = 'required|email|confirmed|max:320|unique:manage_users,email,NULL,id,deleted_at,NULL';
        }
        if(!empty($items['password'])){
            $rules['password'] = [
                'required',
                'confirmed',
                new PasswordRule()
            ];
            $rules['password_confirmation'] = 'required|same:password';
        }
        // if only one admin, don't change roles of admin.
        if($items['manage_role_id'] == ManageRole::ROLE_GENERAL && $user->manage_role_id == ManageRole::ROLE_ADMIN){
            $rules['manage_role_id'] = [new ManageRoleRule()];
        }
        return $rules;
    }
}
