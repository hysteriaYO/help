<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    {{--<link rel="stylesheet" href="css/base.css">--}}
    <link rel="stylesheet" href="css/index.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

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
        }
    </style>
</head>
<body>
{{--唐利华--}}

{{--header  通用头部--}}
<div class="header">
    @section('header')
        <header class="navbar navbar-static-top navbar-fixed-top manual-header" role="banner">
            <div class="container">
                <div class="navbar-header col-sm-12 col-md-9 col-lg-8">
                    <a href="{{ Route('home') }}" class="navbar-brand" title="MinDoc文档管理系统">

                        MinDoc文档管理系统

                    </a>
                    <nav class="collapse navbar-collapse col-sm-10">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="{{ Route('home') }}" title="首页">首页</a>
                            </li>
                            <li>
                                <a href="/tags" title="标签">标签</a>
                            </li>
                        </ul>
                        <div class="inp searchbar pull-left visible-lg-inline-block visible-md-inline-block">
                            <input class="form-control keyword" style="width: 230px;" placeholder="请输入关键词..." value="">
                        </div>
                    </nav>

                    {{--<div class="btn-group dropdown-menu-right pull-right slidebar visible-xs-inline-block visible-sm-inline-block">--}}
                    {{--<button class="btn btn-default dropdown-toggle hidden-lg" type="button" data-toggle="dropdown"><i class="fa fa-align-justify"></i></button>--}}
                    {{--<ul class="dropdown-menu" role="menu">--}}

                    {{--<li>--}}
                    {{--<a href="/setting" title="个人中心"><i class="fa fa-user" aria-hidden="true"></i> 个人中心</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="/book" title="我的项目"><i class="fa fa-book" aria-hidden="true"></i> 我的项目</a>--}}
                    {{--</li>--}}

                    {{--<li>--}}
                    {{--<a href="/manager" title="管理后台"><i class="fa fa-university" aria-hidden="true"></i> 管理后台</a>--}}
                    {{--</li>--}}

                    {{--<li>--}}
                    {{--<a href="/logout" title="退出登录"><i class="fa fa-sign-out"></i> 退出登录</a>--}}
                    {{--</li>--}}


                    {{--</ul>--}}
                    {{--</div>--}}

                </div>
                <nav class="navbar-collapse hidden-xs hidden-sm" role="navigation">

                    {{--{{ $cookie->getValue('username') }}--}}
                    @if((Cookie::get('username')) == 'guest')

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{route('login')}}">登录</a></li>
                        </ul>
                    @else
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown ">
                                <a href="#" class="" data-toggle="dropdown" role="button" aria-expanded="true">&nbsp;&nbsp;{{ Cookie::get('username') }}
                                    &nbsp;&nbsp;<span class="caret"></span></a>
                                <ul class="dropdown-menu" style="min-width: 120px;">
                                    <li><a href="{{ Route('users.person') }}">个人中心</a></li>
                                    <li><a href="myProject?username={{ Cookie::get('username') }}">我的项目</a></li>
                                    @if((Cookie::get('username')) == 'admin')
                                        <li><a href="{{ Route('center') }}">管理后台</a></li>
                                    @endif
                                    <li><a href="{{ Route('users.logOut') }}">退出登录</a></li>
                                </ul>
                            </li>
                        </ul>
                    @endif

                </nav>
            </div>
        </header>

    @show





    {{--@section('header')--}}
    {{--<div class="line-1"></div>--}}

    {{--<div class="container">--}}
    {{--<nav class="navbar navbar-default" style="border: none;margin-bottom: 0">--}}
    {{--<div class="container-fluid">--}}
    {{--<!-- Brand and toggle get grouped for better mobile display -->--}}
    {{--<div class="navbar-header">--}}
    {{--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">--}}
    {{--<span class="sr-only">Toggle navigation</span>--}}
    {{--<span class="icon-bar"></span>--}}
    {{--<span class="icon-bar"></span>--}}
    {{--<span class="icon-bar"></span>--}}
    {{--</button>--}}
    {{--<a class="navbar-brand" href="#">Brand</a>--}}
    {{--</div>--}}

    {{--<!-- Collect the nav links, forms, and other content for toggling -->--}}
    {{--<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">--}}
    {{--<ul class="nav navbar-nav">--}}
    {{--<li class="active"><a href="#">首页 <span class="sr-only">(current)</span></a></li>--}}
    {{--<li><a href="#">标签</a></li>--}}

    {{--</ul>--}}
    {{--<form class="navbar navbar-form navbar-left">--}}
    {{--<div class="form-group">--}}
    {{--<input type="text" class="form-control" placeholder="Search">--}}
    {{--<span class="ico"></span>--}}
    {{--</div>--}}
    {{--<button type="submit" class="btn btn-default">搜索</button>--}}
    {{--</form>--}}
    {{--@if(1==1)--}}

    {{--<ul class="nav navbar-nav navbar-right">--}}
    {{--<li><a href="{{url('userlogin')}}">登录</a></li>--}}
    {{--</ul>--}}
    {{--@else--}}
    {{--<ul class="nav navbar-nav navbar-right">--}}
    {{--<li class="dropdown ">--}}
    {{--<a href="#" class="" data-toggle="dropdown" role="button"  aria-expanded="true">&nbsp;&nbsp;admin&nbsp;&nbsp;<span class="caret"></span></a>--}}
    {{--<ul class="dropdown-menu" style="min-width: 120px;">--}}
    {{--<li><a href="#">个人中心</a></li>--}}
    {{--<li><a href="#">我的项目</a></li>--}}
    {{--<li><a href="#">管理后台</a></li>--}}
    {{--<li><a href="#">退出登录</a></li>--}}
    {{--</ul>--}}
    {{--</li>--}}
    {{--</ul>--}}
    {{--@endif--}}
    {{--</div><!-- /.navbar-collapse -->--}}
    {{--</div><!-- /.container-fluid -->--}}
    {{--</nav>--}}

    {{--</div>--}}
    {{--<div class="line-2"></div>--}}
    {{--@show--}}
</div>


{{--login register 的header--}}
<div class="log-header">
    @section('log-header')
        <div class="line" style="width: 100%;height: 2px;background-color:#009a61;"></div>
        <div class="container">
            <nav class="navbar navbar-default" style="border: none;margin-bottom: 0">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{{ Route('home') }}">文档管理系统</a>
                    </div>

                </div>
            </nav>

        </div>
        <div class="line"
             style="width: 100%;height: 2px;background-color: #f1f1f1;margin-bottom: 0px;margin-top: 0px;z-index: 10"></div>
    @show
</div>

{{--content  中间的内容--}}
<div class="content">
    @section('content')

    @show
</div>

{{--footer 通用底部内容--}}
<div class="footer">
    @section('footer')
        <nav class="navbar navbar-default ">
            <div class="container">
                <ul class="nav navbar-nav nav-list">
                    <li><a href="#">Link</a></li>
                    <li><a href="#">反馈意见</a></li>
                    <li><a href="#">Link</a></li>
                </ul>
            </div>
        </nav>
    @show
</div>


{{--login register 的footer--}}
<div class="log-footer">
    @section('log-footer')

    @show
</div>
{{--<script src="js/canvas.js">--}}

{{--//</script>--}}
</body>
</html>