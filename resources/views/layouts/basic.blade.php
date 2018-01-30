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

    <title>home</title>
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
    </style>
</head>
<body>
{{--唐利华--}}

{{--header  通用头部--}}
<div class="header">
    @section('header')
        <div class="line-1"></div>

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

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="{{ Route('home') }}">首页 <span class="sr-only">(current)</span></a></li>
                            <li><a href="#">标签</a></li>

                        </ul>
                        <form class="navbar navbar-form navbar-left">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-default">搜索</button>
                        </form>
                        {{--{{ $cookie->getValue('username') }}--}}
                        @if((Cookie::get('username')) == 'guest')

                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="{{route('login')}}">登录</a></li>
                                </ul>
                        @else
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown ">
                                    <a href="#" class="" data-toggle="dropdown" role="button"  aria-expanded="true">&nbsp;&nbsp;{{ Cookie::get('username') }}&nbsp;&nbsp;<span class="caret"></span></a>
                                    <ul class="dropdown-menu" style="min-width: 120px;">
                                        <li><a href="{{ Route('users.person') }}">个人中心</a></li>
                                        <li><a href="{{ Route('users.project') }}">我的项目</a></li>
                                        @if((Cookie::get('username')) == 'admin')
                                        <li><a href="{{ Route('center') }}">管理后台</a></li>
                                        @endif
                                        <li><a href="{{ Route('users.logOut') }}">退出登录</a></li>
                                    </ul>
                                </li>
                            </ul>
                        @endif
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>

        </div>
        <div class="line-2"></div>
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