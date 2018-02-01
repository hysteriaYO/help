{{--login 的header--}}

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
