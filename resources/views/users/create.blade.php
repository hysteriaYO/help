
@extends('layouts.basic')

@section('header')
    @include('layouts.loginHeader')
@endsection

@section('content')
    <div class="content">
    <div class="container">
        <div class="login">
            <form action="" method="POST">
            {{ csrf_field() }}
            <h3 class="system">用户注册</h3>
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                @endif
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-user"></span>
                    </div>
                    <input class="form-control username all" placeholder="用户名 只能用英文字和汉字" type="text" name="username">
                </div>
                <p class="errusername errall"></p>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-lock"></span>
                    </div>
                    <input class="form-control password all" placeholder="密码" type="password" name="password">
                </div>
                <p class="errpassword errall"></p>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-lock"></span>
                    </div>
                    <input class="form-control pwds all" placeholder="确认密码" type="password" name="password_confirmation">
                </div>
                <p class="errpwds errall"></p>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-envelope"></span>
                    </div>
                    <input class="form-control useremail all" placeholder="用户邮箱" type="email" name="email">
                </div>
                <p class="erruseremail errall"></p>
            </div>
            <div class="form-group volidate">
                <div class="input-group col-xs-7 col-sm-7 col-md-7">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-check"></span>
                    </div>
                    <input class="form-control volidate-input validate all" placeholder="请输入验证码" type="text">
                </div>
                <canvas id="canvas-r" class="canvas" width="140" height="50"></canvas>
                <p class="errvalidate errall"></p>
            </div>
            <div class="form-group">
                <button type="submit" class="form-control btn btn-r">注册</button>
            </div>
            <div class="form-group">
                已有账号?<a href="login" title="立即注册">立即登录</a>
            </div>
        </form>
        </div>
    </div>
    </div>
@endsection