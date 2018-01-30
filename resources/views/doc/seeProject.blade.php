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
        margin-top: 55px;
        display: flex;
        flex-direction: row;
    }
    .content-project .left-content{
        /*position: fixed;*/
        /*top: 50px;*/
        /*bottom: 0;*/
        text-align: center;
        font-size: 20px;
        width: 200px;
        height:100%;
        margin-right: 10px;
        border-right: 2px solid #dddddd;
        overflow: auto;
        z-index: 100;
        background-color: #f5f5f5;
        /*border-right: 1px solid #eaeaea;*/
    }
    .content-project .left-content .left-title{
        margin-top: 10px;
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
        border-bottom: 2px solid #dddddd;
    }
    .content-project .right-content .head-box .line{
        border-bottom:3px solid #009a61;
    }

    .dashboard .list{
        zoom: 1;
        line-height: 35px;
    }
    .box-body{
        margin-top: 20px;
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
        <div class="left-content">
            <ul class="nav nav-pills">

                <li role="presentation"><a href="#"></a></li>
                <li role="presentation"><a href="#">Profile</a></li>
                <li role="presentation"><a href="#">Messages</a></li>
            </ul>

        </div>
        <div class="right-content">
            <div class="page-right">
                @foreach($project as $pro)
                    <div class="m-box">
                        <div class="head-box">
                            <div class="line">
                                <strong class="box-title">

                                    <i class="fa fa-unlock" aria-hidden="true" title="" data-toggle="tooltip" data-original-title="公开项目"></i>

                                    {{$pro -> project_name}}
                                </strong>
                            </div>
                            <div>
                                <a href="/api/yunwei/edit/" class="btn btn-default btn-sm pull-right" target="_blank"><i class="fa fa-edit" aria-hidden="true"></i> 编辑</a>
                                <a href="/docs/yunwei" class="btn btn-default btn-sm pull-right" style="margin-right: 5px;" target="_blank"><i class="fa fa-eye"></i> 阅读</a>
                                <button class="btn btn-default btn-sm pull-right" style="margin-right: 5px;" id="btnRelease"><i class="fa fa-upload" aria-hidden="true"></i> 发布</button>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="dashboard">

                            <div class="pull-left" style="width: 200px;margin-bottom: 15px;">
                                <div class="book-image">
                                    <img src=""  width="174" height="229" style="border: 1px solid #666">
                                </div>
                            </div>

                            <div class="list">
                                <span class="title">创建者：</span>
                                <span class="body">{{$pro->username}}</span>
                            </div>
                            <div class="list">
                                <span class="title">文档数量：</span>
                                <span class="body">{{$pro->doc_num}} 篇</span>
                            </div>
                            <div class="list">
                                <span class="title">创建时间：</span>
                                <span class="body"> {{$pro->created_at}} </span>
                            </div>
                            <div class="list">
                                <span class="title">修改时间：</span>
                                <span class="body"> {{$pro->updated_at}} </span>
                            </div>
                            <div class="list">
                                <span class="title">担任角色：</span>
                                <span class="body">创始人</span>
                            </div>

                            <div class="list">
                                <span class="title">文档标签：</span>
                                <span class="body">{{$pro->tag}}</span>
                            </div>
                            <div class="summary">{{$pro->abstract}} </div>
                        @endforeach
                    </div>
                </div>
            </div>


        </div>

    </div>



@endsection

@section('footer')
    @parent

@endsection


