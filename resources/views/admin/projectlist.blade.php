
@extends('layouts.basic')

@section('title','home')

@section('header')
    @parent
@endsection

@section('content')
    <div>这是项目列表</div>

    @forelse($projects as $project)
        <li> id:{{ $project->id }} </li>
        <li> 项目名称：{{ $project->project_name }} </li>
        <li> 文档数量：{{ $project->doc_num }} </li>
        <li> 创建时间：{{ $project->created_at }} </li>
        <li> 更新时间：{{ $project->updated_at }} </li>
        <li> <a href="">删除</a> </li>
    @empty
        <span>Nothing.</span>
    @endforelse
@endsection

@section('footer')
    @parent
@endsection