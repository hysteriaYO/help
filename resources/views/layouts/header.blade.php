{{--header  通用头部--}}
<div class="header">
    @section('header')
        <header class="navbar-static-top navbar-fixed-top manual-header" role="banner">
            <nav class="container">
                <a href="{{ Route('home') }}" class="nav-system" title="MinDoc文档管理系统">
                    文档管理系统
                </a>
                <div class="nav-list-c">
                    <ul class="nav-ul">
                        <li>
                            <a href="{{ Route('home') }}" title="首页">首页</a>
                        </li>
                    </ul>
                    <div class="nav-search">
                        <input class="form-control keyword" id="sea-keyword" placeholder="请输入关键词...按Enter搜索" value="">
                    </div>
                </div>
                <div class="nav-login" role="navigation">

                    @if(Cookie::has('username'))
                        @if((Cookie::get('username')) == 'guest')

                            <ul class="nav-login-lo">
                                <li><a href="{{route('login')}}">登录</a></li>
                            </ul>
                        @else
                            <ul class="nav-login-lo">
                                <li class="dropdown ">
                                    <a href="#" class="" data-toggle="dropdown" role="button"  aria-expanded="true">&nbsp;&nbsp;{{ Cookie::get('username') }}&nbsp;&nbsp;<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ Route('user.show') }}"><span class="glyphicon glyphicon-user"></span>个人信息</a></li>
                                        <li><a href="myProject?username={{Cookie::get('username')}}"><span class="glyphicon glyphicon-list"></span>我的项目</a></li>
                                        @if((Cookie::get('username')) == 'admin')
                                            <li><a href="{{ Route('dashboard') }}"><span class="glyphicon glyphicon-home"></span>管理后台</a></li>
                                        @endif
                                        <li><a href="{{ Route('user.logOut') }}"><span class="glyphicon glyphicon-log-out"></span>退出登录</a></li>
                                    </ul>
                                </li>
                            </ul>
                        @endif
                    @else
                        <ul class="nav-login-lo">
                            <li><a href="{{route('login')}}">登录</a></li>
                        </ul>
                    @endif
                </div>
            </nav>
        </header>
    @show
</div>

