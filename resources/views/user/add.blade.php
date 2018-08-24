@extends('layouts.main')
@section('title')
    <title>{!! trans('user.user_list') !!}</title>
@stop

@section('content')
    <div class="row">
        <!-- メインコンテンツ -->
        <div id="main-contests" class="main-contests col-xs-12">

            <div class="page-header"><h4><b>{!! trans('user.user_list') !!}</b></h4></div>

            {{ Form::open(['url' => route('userCreateConfirm'), 'method' => 'POST']) }}
            <div class="page-body">

                <!-- 管理ユーザー情報 -->
                <div class="input-group input-group-add">
                    <span class="input-group-addon">
                        <label class="input-lable">{!! trans('user.role') !!}</label>
                        <label class="required-lable">
                        <span class="label label-danger label-as-badge">{!! trans('user.required') !!}</span>
                        </label>
                    </span>
                    {{ Form::select('manage_role_id', $roles ,null,array('class'=>'form-control')) }}
                </div>
                <div class='text-danger errTxt'>
                    {{ $errors->first('manage_role_id', ':message') }}
                </div>
                <br>

                <div class="input-group input-group-add">
                    <span class="input-group-addon">
                        <label class="input-lable">{!! trans('user.name') !!}</label>
                        <label class="required-lable">
                        <span class="label label-danger label-as-badge">{!! trans('user.required') !!}</span>
                        </label>
                    </span>
                    {{ Form::text('user_last_name', \Input::old('user_last_name') ,array('class'=>'form-control','placeholder'=>trans('user.last_name'))) }}
                </div>
                <div class='text-danger errTxt'>
                    {{ $errors->first('user_last_name', ':message') }}
                </div>
                <br>
                <div class="input-group input-group-add">
                    <span class="input-group-addon">
                        <label class="input-lable">{!! trans('user.first_name') !!}</label>
                        <label class="required-lable">
                        <span class="label label-danger label-as-badge">{!! trans('user.required') !!}</span>
                        </label>
                    </span>
                    {{ Form::text('user_first_name', \Input::old('user_first_name') ,array('class'=>'form-control','placeholder'=>trans('user.first_name'))) }}
                </div>
                <div class='text-danger errTxt'>
                    {{ $errors->first('user_first_name', ':message') }}
                </div>
                <br>

                <div class="input-group input-group-add">
                    <span class="input-group-addon">
                        <label class="input-lable">{!! trans('user.email') !!}</label>
                        <label class="required-lable">
                        <span class="label label-danger label-as-badge">{!! trans('user.required') !!}</span>
                        </label>
                    </span>
                    {{ Form::text('email', \Input::old('email') ,array('class'=>'form-control','placeholder'=>trans('user.email'))) }}
                </div>
                <div class='text-danger errTxt'>
                    {{ $errors->first('email', ':message') }}
                </div>
                <br>
                <div class="input-group input-group-add">
                    <span class="input-group-addon">
                        <label class="input-lable">{!! trans('user.email_confirm') !!}</label>
                        <label class="required-lable">
                        <span class="label label-danger label-as-badge">{!! trans('user.required') !!}</span>
                        </label>
                    </span>
                    {{ Form::text('email_confirmation', \Input::old('email_confirmation') ,array('class'=>'form-control','placeholder'=>trans('user.email_confirm'))) }}
                </div>
                <div class='text-danger errTxt'>
                    {{ $errors->first('email_confirmation', ':message') }}
                </div>
                <br>
                <div class="input-group input-group-add">
                    <span class="input-group-addon">
                        <label class="input-lable">{!! trans('user.password') !!}</label>
                        <label class="required-lable">
                        <span class="label label-danger label-as-badge">{!! trans('user.required') !!}</span>
                        </label>
                    </span>
                    {{ Form::password('password', array('class'=>'form-control')) }}
                </div>
                <div class='text-danger errTxt'>
                    {{ $errors->first('password', ':message') }}
                </div>
                <br>
                <div class="input-group input-group-add">
                    <span class="input-group-addon">
                        <label class="input-lable">{!! trans('user.pass_confirm') !!}</label>
                        <label class="required-lable">
                        <span class="label label-danger label-as-badge">{!! trans('user.required') !!}</span>
                        </label>
                    </span>
                    {{ Form::password('password_confirmation', array('class'=>'form-control')) }}
                </div>
                <div class='text-danger errTxt'>
                    {{ $errors->first('password_confirmation', ':message') }}
                </div>
                <br>

            </div>
            <div class="page-footer input-group-add text-center">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <button type="button" class="btn btn-default" onClick="location.href='{{{ url('') }}}/user'">
                            {!! trans('user.cancel') !!}
                        </button>
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
