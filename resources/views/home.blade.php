
{{--唐利华--}}

{{--@extends('base')--}}
@extends('layouts.basic')

@section('title','home')

@section('header')
    @parent
@endsection

@section('log-header')

@endsection

@section('content')
    <div class="container" style="margin-top: 20px">
        <div class="row">
            @if(count($projects) > 0)
                @foreach ($projects as $project)
                    <div class="col-sm-4 col-md-2">
                        <div class="thumbnail">
                            <img class="img-responsive" src="..." alt="..." style="height: 250px;">
                        </div>
                        <p>标题：{{$project->project_name}}</p>
                        <p>作者：{{$project->username}}</p>
                    </div>
                @endforeach
            @else
                <p>没有项目</p>
            @endif
        </div>
    </div>


    {{--<div class="bg-content">--}}
        {{--<ul class="content-list">--}}
            {{--<li class="content-unit"></li>--}}
            {{--<li class="content-unit"></li>--}}
            {{--<li class="content-unit"></li>--}}
            {{--<li class="content-unit"></li>--}}
            {{--<li class="content-unit"></li>--}}
            {{--<li class="content-unit"></li>--}}
            {{--<li class="content-unit"></li>--}}
            {{--<li class="content-unit"></li>--}}
            {{--<li class="content-unit"></li>--}}
            {{--<li class="content-unit"></li>--}}
        {{--</ul>--}}
    {{--</div>--}}

@endsection

@section('footer')
    @parent
@endsection

@section('log-footer')

    @endsection