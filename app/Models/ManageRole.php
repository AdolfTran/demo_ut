<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManageRole extends Model
{
    protected $table = "manage_roles";

    const ROLE_ADMIN = 1;
    const ROLE_GENERAL = 2;

    public static $roleNames = [
        self::ROLE_ADMIN => '管理者',
        self::ROLE_GENERAL => '一般'
    ];
}
