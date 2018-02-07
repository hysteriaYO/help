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
                            <strong class="box-title">上传附件</strong>
                        </div>
                    </div>
                    <div class="box-body" style="padding-right: 200px;">
                        <div class="form-left">
                            <form method="post" enctype="multipart/form-data" action="">
                                {{ csrf_field() }}
                                <p>上传文件支持格式类型：png、jpg、jpeg、html、docx</p>
                                <label for="file">选择文件</label>
                                <input type="radio" name="type" value="public" checked>公开
                                <input type="radio" name="type" value="private">私有
                                <input type="file" name="file">
                                <button type="submit">上传</button>

                                {{--提示框--}}
                                @include('layouts.message')

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
