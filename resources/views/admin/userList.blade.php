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
                            <strong class="box-title">用户管理</strong>
                            <a href="createUser" type="button" class="btn btn-success btn-sm pull-right">
                                <span class="glyphicon glyphicon-plus"></span>
                                添加用户
                            </a>
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
                                    {{--<th>状态</th>--}}
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($datas as $data)
                                    <form action="deleteUser={{ $data->uid }}" method="post" >
                                        {{ csrf_field() }}
                                        <tr>
                                            <td>{{ $data->uid }}</td>
                                            <td>{{ $data->username }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td> {{ $data->created_at }} </td>
                                            <td> {{ $data->updated_at }} </td>
                                            {{--<td><span class="label label-danger">禁用</span></td>--}}
                                            <td>
                                                <a href="userId={{ $data->uid }}" class="btn btn-sm btn-default">编辑</a>
                                                @if( $data->username != 'admin' )
                                                <button type="submit" id="{{ $data->uid }}" name="{{ $data->uid }}" class="btn btn-danger btn-sm">删除</button>
                                                @endif
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