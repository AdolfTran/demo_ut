@extends('layouts.main')
@section('title')
    <title>ログイン</title>
@stop

@section('css')
@stop

@section('content')
    <div class="row">
        <!-- メインコンテンツ -->
        <div id="main-contests" class="main-contests col-xs-12">
            <div class="login-form col-xs-8 col-xs-offset-2">
                {{ Form::open(['url' => "/login", 'method' => 'POST', 'autocomplete' => 'off']) }}
                <h2 class="form-signin-heading">ログイン</h2>
                <br>
                <!--エラーメッセージ-->
                @if (Session::has('error'))
                    <div id="loginMsg" class="text-center center-block alert alert-danger">
                        {{{ Session::get('error') }}}
                    </div>
                @endif
                <div class="form-group">
                    <label for="inputEmail" class="sr-only">メールアドレス</label>
                    <input type="text" id="email" class="form-control" name="email" placeholder="メールアドレス" value="{{{old('email')}}}" />
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="sr-only">パスワード</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="パスワード" />
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                </div>
                <br>
                <button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop

@section('script')
@stop
