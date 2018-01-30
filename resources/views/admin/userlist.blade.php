
@extends('layouts.basic')

@section('title','home')

@section('header')
    @parent
@endsection

@section('content')
    {{--后台管理-中间内容区域--}}
    <div class="container">
        <div class="row">

            {{--左侧菜单区域--}}
            <div class="col-md-3">
                <div class="list-group">
                    <a href="{{ route('dashboard') }}">查看仪表盘</a>
                    <a href="{{ route('photo') }}">附件管理</a>
                    <a href="{{ route('userlist') }}">用户管理</a>
                    <a href="{{ route('projectlist') }}">项目管理</a>
                </div>
            </div>

            {{--右侧自定义内容区域--}}
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">这是用户列表</div>
                    <div class="panel-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">id</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>这是用户列表</div>

    @forelse($users as $user)
        <ul>
            <li> id:{{ $user->uid }} </li>
            <li> 用户名字：{{ $user->username }} </li>
            <li> 用户邮箱：{{ $user->email }} </li>
            <li> 创建时间：{{ $user->created_at }} </li>
            <li> 更新时间：{{ $user->updated_at }} </li>
            <li> <a href="">删除</a> </li>
        </ul>
    @empty
        <span>Nothing.</span>
    @endforelse
@endsection

@section('footer')
    @parent
@endsection