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
                            <strong class="box-title">仪表盘</strong>
                        </div>
                    </div>
                    <div class="box-body manager" style="padding-right: 200px;">
                        <a href="{{ route('projectList') }}" class="dashboard-item">
                            <span class="bo glyphicon glyphicon-book"></span>
                            <span class="bo-class">项目数量</span>
                            <span class="bo-class">{{ $data['projectNum'] }}</span>
                        </a>
                        <div class="dashboard-item">
                            <span class="bo glyphicon glyphicon-file"></span>
                            <span class="bo-class">文章数量</span>
                            <span class="bo-class">{{ $data['docNum'] }}</span>
                        </div>
                        <a href="{{ route('userList') }}" class="dashboard-item">
                            <span class="bo glyphicon glyphicon-user"></span>
                            <span class="bo-class">会员数量</span>
                            <span class="bo-class">{{ $data['userNum'] }}</span>
                        </a>
                        <a href="{{ route('fileList') }}" class="dashboard-item">
                            <span class="bo glyphicon glyphicon-cloud-download"></span>
                            <span class="bo-class">附件数量</span>
                            <span class="bo-class">{{ $data['photoNum'] }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer')
    @parent
@endsection