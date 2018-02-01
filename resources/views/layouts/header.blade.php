{{--header  通用头部--}}
<div class="header">
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

</div>