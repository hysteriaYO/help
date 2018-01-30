{{--唐利华--}}
<style >
    @media screen and (max-width: 1000px) {

        .content-project .left-content{
            display: none;
        }
        .content-project .right-content{
            font-size: 12px !important;
        }


    }

    a{
        text-decoration: none;
        cursor: pointer;
    }
    a:hover{
        text-decoration: none;
    }
    .content-project{
        display: flex;
        flex-direction: row;
    }
    .content-project .left-content{
        opacity:1;
        font-size: 20px;
        width: 200px;
        margin-right: 10px;
        border-right: 2px solid #dddddd;
    }


    .content-project .right-content{
        font-size: 18px;

        width:100%;
    }
    .content-project .right-content .head-box{
        margin-top: 5px;
        font-weight: 700;
        display: flex;
        justify-content:space-between;

        font-size: 18px;
    }
    .content-project .right-content .head-box .left{
        border-bottom: 2px solid #009a61;
    }
    .content-project .right-content .head-box .addProject{
        color: #009a61;
    }
    .content-project .right-content .project-list{
        margin-top: 5px;
    }
    .content-project .right-content .project-list .project-unit{
        width: 100%;
        border-bottom: 1px solid #dddddd;
        padding: 15px 10px;
        display: flex;
        flex-direction: column;
        /*align-items: flex-start;*/
    }
    .content-project .right-content .project-list .project-unit:hover{
        background-color: #eaeaea;
    }
    .content-project .right-content .project-list .project-unit .project-top{
        display: flex;
        justify-content: space-between;
    }

    .content-project .right-content .project-list .project-unit .project-middle{
        margin: 5px;
    }

</style>
@extends('layouts.basic')

@section('title','myProject')

@section('header')
    @parent
@endsection

@section('log-header')

@endsection

@section('content')
    <div class="container content-project">
        <div class="left-content ">
            我的项目
        </div>
        <div class="right-content">
            <div class="head-box">
                <div class="left">项目列表</div>
                <a class="addProject" href="">添加项目</a>
            </div>
            <div class="project-list">
                @foreach($projects as $project)
                    <div class="project-unit">
                        <div class="project-top">
                            <div class="abstract">
                                <a href="javascript:void(0)" title="项目名">{{$project->project_name}}</a>
                            </div>
                            <div class="see-box">
                                {{--<a href="{{url('myDoc',['username'=>$project->username])}}">查看文档</a>&nbsp;&nbsp;--}}
                                <a href="myDoc?username={{$project->username}}">查看文档</a>&nbsp;&nbsp;
                                <a href="javascript:void(0)">编辑文档</a>
                            </div>
                        </div>
                        <div class="project-middle" title="摘要">
                            @if($project->abstract)
                                {{$project->abstract}}
                            @else
                                &nbsp;
                            @endif
                        </div>
                        <div class="project-bottom">
                            <span title="创建时间">{{$project->created_at}}</span>&nbsp;&nbsp;
                            <span title="文档数量">{{$project->doc_num}}</span>&nbsp;&nbsp;
                            <span title="作者">{{$project->username}}</span>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </div>

@endsection

@section('footer')
    @parent
@endsection

