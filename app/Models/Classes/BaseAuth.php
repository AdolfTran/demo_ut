<?php

namespace App\Models\Classes;


use App\Models\Traits\Modifier;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BaseAuth extends Authenticatable
{
    use SoftDeletes;
    use Modifier;

    protected $guarded = [
        'created_user_id',
        'updated_user_id',
        'deleted_user_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}