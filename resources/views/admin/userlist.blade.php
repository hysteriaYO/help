
@extends('layouts.basic')

@section('title','home')

@section('header')
    @parent
@endsection

@section('page-left')
    @parent
@endsection

@section('page-right')
    <div class="m-box">
        <div class="box-head">
            <strong class="box-title">用户管理</strong>
            <button type="button" class="btn btn-success btn-sm pull-right">
                <span class="glyphicon glyphicon-plus"></span>
                添加用户
            </button>
        </div>
    </div>
    <div class="box-body manager">
        <div id="userList" class="users-list">
            <table class="table">
                <thead>
                <tr>
                    <th width="80">ID</th>
                    <th width="80">用户名</th>
                    <th>邮箱</th>
                    <th>创建时间</th>
                    <th>更新时间</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @forelse($datas as $data)
                    <tr>
                        <td>{{ $data->uid }}</td>
                        <td>{{ $data->username }}</td>
                        <td>{{ $data->email }}</td>
                        <td> {{ $data->created_at }} </td>
                        <td> {{ $data->updated_at }} </td>
                        <td><span class="label label-danger">禁用</span></td>
                        <td>
                            <a href="/manager/users/edit" class="btn btn-sm btn-default">编辑</a>
                            <button type="button" class="btn btn-success btn-sm">禁用</button>
                            <button type="button" class="btn btn-danger btn-sm">删除</button>
                        </td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection