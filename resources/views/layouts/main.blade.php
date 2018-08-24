<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    @section('meta')
    @show
    @section('title')
        @yield('title')
    @show
    <meta name="apple-mobile-web-app-title" content="AudienceOne UU数見積もりツール">
    <link rel="apple-touch-icon-precomposed" href="{{ url('') }}/apple-touch-icon.png">
    <link rel="apple-touch-icon" href="{{ url('') }}/apple-touch-icon.png">
    <link rel="shortcut icon" href="{{ url('') }}/favicon.ico" />
    <link type="text/css" href="{{ url('') }}/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="{{ url('') }}/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link type="text/css" href="{{ url('') }}/css/common.css" rel="stylesheet">
    <link type="text/css" href="{{ url('') }}/fontawesome/css/fontawesome-all.min.css"  rel="stylesheet">
    <link type="text/css" href="{{ url('') }}/css/select2/select2.min.css"  rel="stylesheet">
    @section ('css')
    @show
</head>
<body>
@section('header')
    @include('layouts.header')
@show

@include('layouts.menu')

<div class="container">
@yield('content')
</div>

</body>
@include('layouts.footer')

@section('modal')
@show

<script type='text/javascript' src="{{{ url('') }}}/js/jquery-2.2.1.min.js"></script>
<script type='text/javascript' src="{{{ url('') }}}/bootstrap/js/bootstrap.min.js"></script>
<script type='text/javascript' src="{{{ url('') }}}/js/moment-with-locales.js"></script>
<script type='text/javascript' src="{{{ url('') }}}/js/bootstrap-datetimepicker.js"></script>
<script type='text/javascript' src="{{{ url('') }}}/js/select2/select2.min.js"></script>
<script type='text/javascript' src="{{{ url('') }}}/fontawesome/js/fontawesome-all.min.js"></script>
@section('script')
@show
</html>