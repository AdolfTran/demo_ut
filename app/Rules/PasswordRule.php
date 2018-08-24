<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordRule implements Rule
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
        $isSizeOK = strlen($value) >= 8;
        $isCharOK = preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]/', $value);
        $isContainOK = preg_match('/[a-z]+/', $value)
        && preg_match('/[A-Z]+/', $value)
        && preg_match('/[0-9]+/', $value);
        $items = \Input::get();
        $isNotSameEmail = $items['email'] != $items['password'];

        return $isSizeOK && $isCharOK && $isContainOK && $isNotSameEmail;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.custom.*.custom_password_check');
    }
}
