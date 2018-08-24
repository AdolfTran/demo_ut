@extends('layouts.main')
@section('title')
    <title>{!! trans('user.user_list') !!}</title>
@stop

@section('content')
    <div class="row">
        <!-- メインコンテンツ -->
        <div id="main-contests" class="main-contests col-xs-12">

            <div class="page-header"><h4><b>{!! trans('user.register_confirm') !!}</b></h4></div>

            {{ Form::open(['url' => route('userCreateComplete'), 'method' => 'POST']) }}
            <div class="page-body">

                <!-- 管理ユーザー情報 -->
                <div class="input-group input-group-add">
                    <span class="input-group-addon">
                        <label class="input-lable" >{!! trans('user.role') !!}</label>
                        <label class="required-lable" >
                        <span class="label label-danger label-as-badge">{!! trans('user.required') !!}</span>
                        </label>
                    </span>
                    <div class="form-control" >
                        {!! !empty($roles) && $roles[$inputs['manage_role_id']] ? $roles[$inputs['manage_role_id']] : '' !!}
                    </div>
                    {{ Form::hidden('manage_role_id', $inputs['manage_role_id']) }}
                </div>
                <br>

                <div class="input-group input-group-add">
                    <span class="input-group-addon">
                        <label class="input-lable" >{!! trans('user.last_name') !!}</label>
                        <label class="required-lable" >
                        <span class="label label-danger label-as-badge">{!! trans('user.required') !!}</span>
                        </label>
                    </span>
                    <div class="form-control form-control-height-max" >
                        {{{$inputs['user_last_name']}}}
                        {{ Form::hidden('user_last_name', $inputs['user_last_name']) }}
                    </div>
                </div>
                <br>
                <div class="input-group input-group-add">
                    <span class="input-group-addon">
                        <label class="input-lable" >{!! trans('user.first_name') !!}</label>
                        <label class="required-lable" >
                        <span class="label label-danger label-as-badge">{!! trans('user.required') !!}</span>
                        </label>
                    </span>
                    <div class="form-control form-control-height-max" >
                        {{{$inputs['user_first_name']}}}
                        {{ Form::hidden('user_first_name', $inputs['user_first_name']) }}
                    </div>
                </div>
                <br>

                <div class="input-group input-group-add">
                    <span class="input-group-addon">
                        <label class="input-lable" >{!! trans('user.email') !!}</label>
                        <label class="required-lable" >
                        <span class="label label-danger label-as-badge">{!! trans('user.required') !!}</span>
                        </label>
                    </span>
                    <div class="form-control" >
                        {{{$inputs['email']}}}
                        {{ Form::hidden('email', $inputs['email']) }}
                    </div>
                </div>
                <br>
                <div class="input-group input-group-add">
                    <span class="input-group-addon">
                        <label class="input-lable" >{!! trans('user.password') !!}</label>
                        <label class="required-lable" >
                        <span class="label label-danger label-as-badge">{!! trans('user.required') !!}</span>
                        </label>
                    </span>
                    <div class="form-control" >
                        {{{ str_repeat('*', strlen($inputs['password']))}}}
                        {{ Form::hidden('password', $inputs['password']) }}
                    </div>
                </div>
                <br>

            </div>
            <div class="page-footer input-group-add text-center">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <button type="button" class="btn btn-default" onClick="location.href='{{{ url('') }}}/user/create'">{!! trans('user.cancel') !!}</button>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-primary">{!! trans('user.register') !!}</button>
                    </div>
                </div>
            </div>
            {{ Form::close() }}

        </div>
    </div>
@stop