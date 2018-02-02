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
                            <strong class="box-title">编辑项目</strong>
                        </div>
                    </div>
                    <div class="box-body" style="padding-right: 200px;">
                        <div class="form-left">
                            <form action="" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>作者</label>
                                    <input type="text" class="form-control disabled" value="{{ $datas->username }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>项目名<strong class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" value="{{ $datas->project_name }}" name="projectName" max="100" placeholder="项目名称，必填" required>
                                </div>
                                <div class="form-group">
                                    <label>公司名称<strong class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" value="{{ $datas->company_name }}" name="projectName" max="100" placeholder="公司名称，必填" required>
                                </div>
                                <div class="form-group">
                                    <label>公司电话<strong class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" name="companyPhone" value="{{ $datas->company_phone }}" placeholder="公司联系方式，必填" required>
                                </div>
                                <div class="form-group">
                                    <label>邮箱<strong class="text-danger">*</strong></label>
                                    <input type="email" class="form-control" value="{{ $datas->company_email }}" id="userEmail" name="email" max="100" placeholder="公司邮箱，必填" required>
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
