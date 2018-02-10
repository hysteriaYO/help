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
                            <strong class="box-title">项目管理</strong>
                            <a href="createProject" type="button" class="btn btn-success btn-sm pull-right">
                                <span class="glyphicon glyphicon-plus"></span>
                                添加项目
                            </a>
                        </div>
                    </div>
                    <div class="box-body manager">
                        <div id="userList" class="users-list">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th width="80">ID</th>
                                    <th width="80">项目名</th>
                                    <th>文档数量</th>
                                    <th>创建时间</th>
                                    <th>更新时间</th>
                                    <th>是否公开</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($datas as $data)
                                    <form action="deleteProject={{ $data->id }}" method="post" >
                                        {{ csrf_field() }}
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->project_name }}</td>
                                        <td>{{ $data->doc_num }}</td>
                                        <td> {{ $data->created_at }} </td>
                                        <td> {{ $data->updated_at }} </td>
                                        <td>
                                            @if($data->sign == 1 )
                                                私有
                                            @elseif($data->sign == 0)
                                                公开
                                            @endif
                                        </td>
                                        <td>
                                            <a href="projectId={{ $data->id }}" class="btn btn-sm btn-default">编辑项目</a>
                                            <a href="myDoc?project_name={{$data->project_name}}" type="button" class="btn btn-success btn-sm">查看文档</a>
                                            <button type="submit" class="btn btn-danger btn-sm">删除项目</button>
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


