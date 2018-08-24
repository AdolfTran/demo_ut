<?php

namespace App\Models\Traits;


use Illuminate\Support\Facades\Auth;

trait Modifier
{
    public static function boot()
    {
        parent::boot();
        if(Auth::guard()->check()){
            $user = Auth::user();
//
//            self::creating(function($model) use ($user) {
//                $model->created_user_id = $user->id;
//                $model->updated_user_id = $user->id;
//            });
//
//            self::updating(function($model) use ($user){
//                $model->updated_user_id = $user->id;
//            });
//
//            self::deleting(function($model) use ($user){
//                $model->deleted_user_id = $user->id;
//                $model->updated_user_id = $user->id;
//            });
        }
    }
}