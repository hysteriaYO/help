<style>
    .content{
        height: 100%;
    }

</style>

@extends('layouts.basic')

@section('header')
    @include('layouts.header')
@endsection

@section('content')

    <div class="content">

        <div class="container manual-body">
            <div class="row">
                <div class="page-left">
                    <ul class="menu">
                        <li class="active">
                            <a href="{{ Route('user.show') }}" class="item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 基本信息</a>
                        </li>
                        <li>
                            <a href="{{ Route('user.password') }}" class="item"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> 修改密码</a>
                        </li>
                    </ul>
                </div>
                <!--        修改密码右边栏 start-->
                <div class="page-right">
                    <div class="m-box">
                        <div class="box-head">
                            <strong class="box-title">修改密码</strong>
                        </div>
                    </div>
                    <div class="box-body" style="padding-right: 200px;">
                        <div class="form-left">
                            <form method="post" enctype="multipart/form-data" action="">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="oldpassword">原始密码</label>
                                    <input name="oldpassword" type="password" id="oldpassword" class="form-control disabled" placeholder="原始密码">
                                </div>
                                <div class="form-group">
                                    <label for="password">新密码</label>
                                    <input type="password" class="form-control" id="password" name="password" max="100" placeholder="新密码">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">确认密码</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" maxlength="20" placeholder="确认密码">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success" data-loading-text="保存中...">保存修改</button>
                                    <span id="form-error-message" class="error-message"></span>
                                </div>

                                {{--提示框--}}
                                @include('layouts.message')

                            </form>
                        </div>
                    </div>
                </div>
                <!--        基本信息右边栏 end-->
            </div>
        </div>

    </div>

@section('footer')
    @parent
@endsection