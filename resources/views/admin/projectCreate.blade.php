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
                            <strong class="box-title">创建项目</strong>
                        </div>
                    </div>
                    <div class="box-body" style="padding-right: 200px;">
                        <div class="form-left">
                            <form action="" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>作者<strong class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" value="" name="username" placeholder="作者，必填" required>
                                </div>
                                <div class="form-group">
                                    <label>项目名<strong class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" value="" name="projectName" max="100" placeholder="项目名称，必填" required>
                                </div>
                                <div class="form-group">
                                    <label>公司名称<strong class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" value="" name="companyName" max="100" placeholder="公司名称，必填" required>
                                </div>
                                <div class="form-group">
                                    <label>公司电话<strong class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" name="companyPhone" value="" placeholder="公司联系方式，必填" required>
                                </div>
                                <div class="form-group">
                                    <label>邮箱<strong class="text-danger">*</strong></label>
                                    <input type="email" class="form-control" value=""  name="companyEmail" max="100" placeholder="公司邮箱，必填" required>
                                </div>
                                <div class="form-group">
                                    <label class="description">描述</label>
                                    <textarea class="form-control" rows="3" title="描述" name="description" id="description" maxlength="500"></textarea>
                                    <p style="color: #999;font-size: 12px;">描述不能超过500字</p>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success" >保存修改</button>
                                    <span id="form-error-message" class="error-message"></span>
                                </div>

                                {{--提示框--}}
                                @include('layouts.message')

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
