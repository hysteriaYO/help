
@extends('layouts.basic')

@section('title','home')

@section('header')
    @parent
@endsection

@section('content')
    <div>这是附件列表</div>
    @forelse($datas as $data)
        <li> id:{{ $data->pid }} </li>
        <li> 附件名字：{{ $data->photo_name }} </li>
        <li> 项目名字：{{ $data->project_name }} </li>
        <li> 创建时间：{{ $data->created_at }} </li>
        <li> 更新时间：{{ $data->updated_at }} </li>
        <li> <a pid="" name="deletePhoto" href="{{ Route('') }}">删除</a></li>
    @empty
        <span>Nothing.</span>
    @endforelse
@endsection

@section('footer')
    @parent
@endsection