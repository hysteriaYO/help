
{{--唐利华--}}

{{--@extends('base')--}}
@extends('basic')

@section('title','home')

@section('header')
    @parent
@endsection

@section('log-header')

    @endsection

@section('content')
    <div class="container" style="margin-top: 60px">
        <div class="row">
            @foreach ($projects as $project)

            <div class="col-sm-4 col-md-2">
                <div class="thumbnail">
                    <img class="img-responsive" src="..." alt="..." style="height: 250px;">


                </div>
                <p>标题：{{$project->project_name}}</p>
                <p>作者：{{$project->username}}</p>
            </div>
            @endforeach
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