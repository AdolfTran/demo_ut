@extends('layouts.main')
@section('title')
    <title>CMS管理サイト</title>
@stop

@section('content')
    <!--メインコンテンツ-->
    <div id="main-contests" class="error-contests main-contests col-xs-12">
        <br>
        <!--エラーメッセージ-->
        <div id="loginMsg" class="text-center center-block alert alert-danger">
            <p>ただいまメンテナンス中です。メンテナンスが終了するまでお待ち下さい。</p>
        </div>
    </div>
@stop
