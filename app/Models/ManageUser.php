<?php

namespace App\Models;

use App\Enums\UserSearchOption;
use App\Models\Classes\BaseAuth;

class ManageUser extends BaseAuth
{
    protected $table = "manage_users";

    public function getDates()
    {
        return array_merge(parent::getDates(),[
            'reminder_at'
        ]);
    }

    /**
     * Hash password
     *
     * @param string $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }

    /**
     * Check user is correct role with input
     *
     * @param int $role
     * @return bool
     */
    public function isRole($role){
        return $this->manage_role_id == $role;
    }

    /**
     * Get list user by param
     *
     * @param int $option, string $keyword
     * @return array
     */
    public static function getListUserForSearch($option, $keyword)
    {
        if (!is_null($option) || !empty($keyword)) {
            if ($option == UserSearchOption::BY_EMAIL) {
                $users = self::where('email', 'like', '%' . $keyword . '%');
            } elseif ($option == UserSearchOption::BY_NAME) {
                $users = self::where('user_first_name', 'like', '%' . $keyword . '%')
                    ->orWhere('user_last_name', 'like', '%' . $keyword . '%');
            } else {
                $users = self::where('email', 'like', '%' . $keyword . '%')
                    ->orWhere('user_first_name', 'like', '%' . $keyword . '%')
                    ->orWhere('user_last_name', 'like', '%' . $keyword . '%');
            }

            $users = $users->orderBy('updated_at', 'DESC')->get();
        } else {
            $users = self::orderBy('updated_at', 'DESC')->get();
        }
        return $users;
    }

    /**
     * get data for export list user
     *
     * @param string $option search by select item
     * @param string $keyword search keyword
     * @return mixed
     *
     */
    public static function queryToExport($option, $keyword){
        if ($option == UserSearchOption::BY_EMAIL) {
            $results = self::join('manage_roles','manage_users.manage_role_id','=','manage_roles.id')
                ->select('manage_users.id','manage_role_id','email','user_last_name','user_first_name')
                ->where('email', 'like', '%' . $keyword . '%')->get()->toArray();
        } elseif ($option == UserSearchOption::BY_NAME) {
            $results = self::join('manage_roles','manage_users.manage_role_id','=','manage_roles.id')
                ->select('manage_users.id','manage_role_id','email','user_last_name','user_first_name')
                ->where('user_first_name', 'like', '%' . $keyword . '%')
                ->orWhere('user_last_name', 'like', '%' . $keyword . '%')->get()->toArray();
        } else {
            $results = self::join('manage_roles','manage_users.manage_role_id','=','manage_roles.id')
                ->select('manage_users.id','manage_roles.role_name','email','user_last_name','user_first_name')
                ->where('email', 'like', '%' . $keyword . '%')
                ->orWhere('user_first_name', 'like', '%' . $keyword . '%')
                ->orWhere('user_last_name', 'like', '%' . $keyword . '%')->get()->toArray();
        }
        return $results;
    }
}
