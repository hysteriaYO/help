<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/index.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <title>文档管理系统</title>
    <style>
        body{
            background-color: #f8f8f8;
        }
        .line-1{
            width: 100%;
            height: 3px;
            background-color:#009a61;
        }
        .line-2{
            width: 100%;
            height: 2px;
            background-color: #f1f1f1;
            /*margin-bottom: 0px;*/
        }
        .nav-list{
            display:flex;
            float: none;
            justify-content: center;
        }
        .footer{
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
                    <a href="{{ Route('home') }}" class="navbar-brand" title="Doc文档管理系统">

                        文档管理系统

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
                        <div class="searchbar pull-left visible-lg-inline-block visible-md-inline-block">
                            <form class="form-inline" action="/search" method="get">
                                <input class="form-control" name="keyword" type="search" style="width: 230px;" placeholder="请输入关键词..." value="">
                                <button class="search-btn">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </nav>

                </div>
                <nav class="navbar-collapse hidden-xs hidden-sm" role="navigation">

                    @if(Cookie::has('username'))
                        @if((Cookie::get('username')) == 'guest')

                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="{{route('login')}}">登录</a></li>
                            </ul>
                        @else
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown ">
                                    <a href="#" class="" data-toggle="dropdown" role="button"  aria-expanded="true">&nbsp;&nbsp;{{ Cookie::get('username') }}&nbsp;&nbsp;<span class="caret"></span></a>
                                    <ul class="dropdown-menu" style="min-width: 120px;">
                                        <li><a href="{{ Route('users.person') }}"><span class="glyphicon glyphicon-user"></span>个人中心</a></li>
                                        <li><a href="myProject?username={{Cookie::get('username')}}"><span class="glyphicon glyphicon-list"></span>我的项目</a></li>
                                        @if((Cookie::get('username')) == 'admin')
                                            <li><a href="{{ Route('dashboard') }}"><span class="glyphicon glyphicon-home"></span>管理后台</a></li>
                                        @endif
                                        <li><a href="{{ Route('users.logOut') }}"><span class="glyphicon glyphicon-log-out"></span>退出登录</a></li>
                                    </ul>
                                </li>
                            </ul>
                        @endif
                    @else
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{route('login')}}">登录</a></li>
                        </ul>
                    @endif
                </nav>
            </div>
        </header>

    @show

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
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
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
                <div class="line" style="width: 100%;height: 2px;background-color: #f1f1f1;margin-bottom: 0px;margin-top: 0px;z-index: 10"></div>
            @show
        </div>

{{--content  中间的内容--}}
<div class="content">
    @section('content')

    @show
</div>

<div class="container manual-body">
    <div class="row">
        {{--后台管理侧边栏--}}
        <div class="page-left">
            @section('page-left')
            <ul class="menu">
                <li class="active">
                    <a href="{{ route('dashboard') }}" class="item"><span class="glyphicon glyphicon-adjust" aria-hidden="true"></span> 仪表盘</a>
                </li>
                <li>
                    <a href="{{ route('userlist') }}" class="item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 用户管理</a>
                </li>
                <li>
                    <a href="{{ route('projectlist') }}" class="item"><span class="glyphicon glyphicon-hdd" aria-hidden="true"></span> 项目管理</a>
                </li>
                <li>
                    <a href="{{ route('photo') }}" class="item"><span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span> 附件管理</a>
                </li>
            </ul>
            @show
        </div>

        <div class="page-right">
            @section('page-right')

            @show
        </div>
    </div>
</div>
{{--footer 通用底部内容--}}
<div class="footer">
    @section('footer')
        <nav class="navbar navbar-default ">
            <div class="container">
                <ul class="nav navbar-nav nav-list"  >
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
<script src="js/canvas.js">

</script>
</body>
</html>