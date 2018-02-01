{{--login register 的header--}}
{{--田写的header--}}
{{--<div class="log-header">--}}
    {{--<div class="line" style="width: 100%;height: 2px;background-color:#009a61;"></div>--}}
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
                    {{--<a class="navbar-brand" href="{{ Route('home') }}">文档管理系统</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</nav>--}}
    {{--</div>--}}
    {{--<div class="line" style="width: 100%;height: 2px;background-color: #f1f1f1;margin-bottom: 0px;margin-top: 0px;z-index: 10"></div>--}}
{{--</div>--}}

<div class="header">
    @section('header')
        <header class="navbar navbar-static-top navbar-fixed-top manual-header" role="banner">
            <div class="container">
                <div class="navbar-header col-sm-12 col-md-9 col-lg-8">
                    <a href="{{ Route('home') }}" class="navbar-brand" title="Doc文档管理系统">

                        文档管理系统

                    </a>
                </div>
            </div>
        </header>
    @show

</div>