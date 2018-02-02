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
                                    <th>创建时间</th>
                                    <th>更新时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($datas as $data)
                                    <tr>
                                        <td> {{ $data->pid }} </td>
                                        <td> {{ $data->photo_name }} </td>
                                        <td> {{ $data->project_name }} </td>
                                        <td> {{ $data->created_at }} </td>
                                        <td> {{ $data->updated_at }} </td>
                                        <td>
                                            <button id="btn-delete" type="button" onclick="delete(${{ $data->pid }})" class="btn btn-danger btn-sm">删除</button>
                                            <a href="/detailed" class="btn btn-success btn-sm">详情</a>
                                        </td>
                                    </tr>
                                @empty
                                    <span>Nothing.</span>
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





