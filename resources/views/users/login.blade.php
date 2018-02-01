@extends('layouts.basic')

@include('layouts.loginHeader')

@section('content')
    <div class="container">
        <div class="login">
            <form action="" method="POST">
                {{ csrf_field() }}
                <h3 class="system">用户登录</h3>
                <div class="form-group">
                    {{--成功提示框--}}
                    @foreach (['success'] as $msg)
                        @if(session()->has($msg))
                            <div class="flash-message">
                                <p class="alert alert-{{ $msg }}">
                                    {{ session()->get($msg) }}
                                </p>
                            </div>
                        @endif
                    @endforeach

                    {{--出错提示框--}}
                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    @endif
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-user"></span>
                        </div>
                        <input class="form-control" placeholder="用户名" type="text" name="username">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-lock"></span>
                        </div>
                        <input class="form-control" placeholder="密码" type="password" name="password">
                    </div>
                </div>
                <div class="form-group volidate">
                    <div class="input-group col-xs-7 col-sm-7 col-md-7">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-check"></span>
                        </div>
                        <input class="form-control volidate-input validlogin " placeholder="请输入验证码" type="text">
                    </div>
                    <canvas id="canvas" class="canvas" width="140" height="50"></canvas>
                    <p class="errlogin errall"></p>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember">
                        记住我
                    </label>
                    <a class="forget-pwd" href="">忘记密码?</a>
                </div>
                <div class="form-group">
                    <button type="submit" class="form-control btn">登录</button>
                </div>
                <div class="form-group">
                    还没有账号?<a href="{{ route('create') }}" title="立即注册">立即注册</a>
                </div>
            </form>
        </div>
    </div>
@endsection

