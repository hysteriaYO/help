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
                            <strong class="box-title">附件管理</strong>
                            <a href="uploadFile" type="button" class="btn btn-success btn-sm pull-right">
                                <span class="glyphicon glyphicon-plus"></span>
                                上传附件
                            </a>
                        </div>
                    </div>
                    <div class="box-body manager">
                        <div id="userList" class="users-list">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th width="80">ID</th>
                                    <th width="80">附件名称</th>
                                    <th>项目名称</th>
                                    <th>文件大小</th>
                                    <th>是否公开</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($datas as $data)
                                    <form action="deleteFile={{ $data->pid }}" method="post" >
                                        {{ csrf_field() }}
                                        <tr>
                                            <td> {{ $data->pid }} </td>
                                            <td> {{ $data->file_name }} </td>
                                            <td> {{ $data->project_name }} </td>
                                            <td> {{ $data->file_size }} </td>
                                            <td>
                                                @if($data->file_type == 1 )
                                                    私有
                                                @elseif($data->file_type == 0)
                                                    公开
                                                @endif
                                            </td>
                                            <td>
                                                <button  type="submit" class="btn btn-danger btn-sm">删除</button>
                                                <a href="fileId={{ $data->pid }}" class="btn btn-success btn-sm">详情</a>
                                            </td>
                                        </tr>
                                    </form>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer')
    @parent
@endsection





