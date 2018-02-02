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
                @include('layouts.left')

                <div class="page-right">
                    <div class="m-box">
                        <div class="box-head">
                            <strong class="box-title">编辑用户</strong>
                        </div>
                    </div>
                    <div class="box-body" style="padding-right: 200px;">
                        <div class="form-left">
                            <form action="" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>用户名</label>
                                    <input type="text" class="form-control disabled" value="{{ $datas->username }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="password">新密码</label>
                                    <input type="password" class="form-control" id="password" name="password" max="100" placeholder="新密码,不改密码请为空">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">确认密码</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" maxlength="20" placeholder="确认密码">
                                </div>
                                <div class="form-group">
                                    <label for="user-email">邮箱<strong class="text-danger">*</strong></label>
                                    <input type="email" class="form-control" value="{{ $datas->email }}" id="userEmail" name="email" max="100" placeholder="邮箱" required>
                                </div>
                                <div class="form-group">
                                    <label>手机号</label>
                                    <input type="text" class="form-control" id="userPhone" name="phone" size="11" title="手机号码" placeholder="手机号码" value="{{ $datas->phone }}" >
                                </div>
                                <div class="form-group">
                                    <label class="description">描述</label>
                                    <textarea class="form-control" rows="3" title="描述" name="description" id="description" maxlength="500">{{ $datas->description }}</textarea>
                                    <p style="color: #999;font-size: 12px;">描述不能超过500字</p>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success" >保存修改</button>
                                    <span id="form-error-message" class="error-message"></span>
                                </div>
                                {{--提示框--}}
                                @foreach (['success','warning'] as $msg)
                                    @if(session()->has($msg))
                                        <div class="flash-message">
                                            <p class="alert alert-{{ $msg }}">
                                                {{ session()->get($msg) }}
                                            </p>
                                        </div>
                                    @endif
                                @endforeach

                                {{--出错提示框--}}
                                <p class="prompt">
                                    @if (count($errors) > 0)
                                        @foreach ($errors->all() as $message)
                                            <span>{{ $message }}</span>
                                        @endforeach
                                    @endif
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
