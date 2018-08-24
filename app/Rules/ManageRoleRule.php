<?php

namespace App\Rules;

use App\Models\ManageRole;
use App\Models\ManageUser;
use Illuminate\Contracts\Validation\Rule;

class ManageRoleRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $count = ManageUser::where('manage_role_id', ManageRole::ROLE_ADMIN)->count();
        return $count > 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.custom.role.custom_not_change');
    }
}
