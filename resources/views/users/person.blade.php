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
                <!--        基本信息右边栏 start-->
                <div class="page-right">
                    <div class="m-box">
                        <div class="box-head">
                            <strong class="box-title">基本信息</strong>
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
                                    <label for="user-email">邮箱<strong class="text-danger">*</strong></label>
                                    <input type="email" class="form-control" value="{{ $datas->email }}" id="userEmail" name="email" max="100" placeholder="邮箱" required>
                                </div>
                                <div class="form-group">
                                    <label>手机号</label>
                                    <input type="text" class="form-control" id="userPhone" name="phone" maxlength="20" title="手机号码" placeholder="手机号码" value="{{ $datas->phone }}" >
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
                            </form>
                        </div>
                        <div class="form-right">
                            <label>
                                <a href="javascript:;" data-toggle="modal" data-target="#upload-logo-panel">
                                    <img src="" onerror="" class="img-circle" alt="头像" style="max-width: 120px;max-height: 120px;" id="headimgurl">
                                </a>
                            </label>
                        </div>
                    </div>
                </div>
                <!--        基本信息右边栏 end-->

            </div>
        </div>

        <!--修改头像 start-->
        <div class="modal fade" id="upload-logo-panel" tabindex="-1" role="dialog" aria-labelledby="修改头像" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">修改头像</h4>
                    </div>
                    <div class="modal-body">
                        <div class="wraper">
                            <div id="image-wraper">

                            </div>
                        </div>
                        <div class="watch-crop-list">
                            <div class="preview-title">预览</div>
                            <ul>
                                <li>
                                    <div class="img-preview preview-lg"></div>
                                </li>
                                <li>
                                    <div class="img-preview preview-sm"></div>
                                </li>
                            </ul>
                        </div>
                        <div style="clear: both"></div>
                    </div>
                    <div class="modal-footer">
                        <span id="error-message"></span>
                        <div id="filePicker" class="btn">选择</div>
                        <button type="button" id="saveImage" class="btn btn-success" style="height: 40px;width: 77px;" data-loading-text="上传中...">上传</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('footer')
    @parent
@endsection