<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>home</title>
    <style>
        body {
            background-color: #f8f8f8;
        }
        .inp {
            position: relative;
            top: 7px;
        }
        .line-1 {
            width: 100%;
            height: 3px;
            background-color: #009a61;
        }
        .line-2 {
            width: 100%;
            height: 2px;
            background-color: #f1f1f1;
            /*margin-bottom: 0px;*/
        }
        .nav-list {
            display: flex;
            float: none;
            justify-content: center;
        }
        .footer {
            margin-top: 20px;
            border:none;
        }
    </style>
</head>
<body>
{{--唐利华--}}

@section('header')

@show
{{--content  中间的内容--}}
<div class="content">
@section('content')

@show
</div>
{{--footer 通用底部内容--}}
<style>
    .foot-box {
        position: fixed;
        bottom: 0;
        width: 100%;
        background: #f5f5f5;
        z-index: 100;
    }
</style>
<div class="footer">
    @section('footer')
    <div class="foot-box">
        <div class="container">
            <ul class="nav navbar-nav nav-list">
                <li><a href="#">Link</a></li>
                <li><a href="#">反馈意见</a></li>
                <li><a href="#">Link</a></li>
            </ul>
        </div>
    </div>
        @show
</div>

{{--login register 的footer--}}
{{--<div class="log-footer">--}}
    {{--@section('log-footer')--}}

    {{--@show--}}
{{--</div>--}}

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/canvas.js"></script>
</body>
</html>