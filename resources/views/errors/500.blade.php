@extends('layouts.main')
@section('title')
    <title>CMS管理サイト</title>
@stop

@section('contents')

    <!--メインコンテンツ-->
    <div id="main-contests" class="error-contests main-contests col-xs-12">
        <br>
        <!--エラーメッセージ-->
        <div id="loginMsg" class="text-center center-block alert alert-danger">
            <p>500 Internal Server Error</p>
            <span>処理が正常に行われませんでした。時間をおいて、再度実行してください。</span></br>
            <span>それでも改善しない場合は、システム管理者までお問い合わせください。</span>
        </div>
        <div id="loginbox" class="form-inline text-center center-block">

            <span><a href="/">トップ画面へ戻る</a></span>
        </div>
    </div>

@stop
