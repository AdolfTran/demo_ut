@extends('layouts.main')
@section('title')
    <title>CMS管理サイト</title>
@stop

@section('content')
    <div id="main-contests" class="error-contests main-contests col-xs-12">
        <br>
        <!--エラーメッセージ-->
        <div id="loginMsg" class="text-center center-block alert alert-danger">
            <p>403 Forbidden</p>
            <span>このサーバーのこのページにアクセスする権限がありません。</span>
        </div>
        <div id="loginbox" class="form-inline text-center center-block">
            <span><a href="/">トップ画面へ戻る</a></span>
        </div>
    </div>
@stop
