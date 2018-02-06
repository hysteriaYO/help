{{--唐利华--}}
<style >
    @media screen and (max-width: 1000px) {

        .content-project .left-content{
            display: none;
        }
        .content-project .right-content{
            font-size: 12px !important;
            margin-left: 0 !important;
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
        position: fixed;
        top: 50px;
        bottom: 0;
        font-size: 20px;
        width: 200px;
        /*height:100%;*/
        margin-right: 10px;
        border-right: 2px solid #dddddd;
        overflow: auto;
        z-index: 100;
        background-color: #f5f5f5;
        padding: 10px;
        /*border-right: 1px solid #eaeaea;*/
    }


    .content-project .right-content{
        margin-left: 210px;
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
        border-bottom: 2px ;
    }
    .content-project .right-content .head-box .addProject{
        /*color: #009a61;*/
        color: #ffffff;
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
    <div class="container content-project">
        <div class="left-content">
            我的项目
        </div>
        <div class="right-content">
            <div class="head-box">
                <div class="left">项目列表</div>
                <button class="btn btn-success" data-toggle="modal" data-target="#myModal">添加项目</button>
            </div>
            <div class="project-list">
                @if($projects)
                    @foreach($projects as $project)

                    <div class="project-unit">
                        <div class="project-top">
                            <div class="abstract">
                                <a href="seeProject?project_name={{$project->project_name}}" title="项目名">{{$project->project_name}}</a>
                            </div>
                            <div class="see-box">
                                {{--<a href="{{url('myDoc',['username'=>$project->username])}}">查看文档</a>&nbsp;&nbsp;--}}
                                <a href="myDoc?project_name={{$project->project_name}}" title="项目下的文档">查看文档</a>&nbsp;&nbsp;
                                <a href="javascript:void(0)" title="编辑当前项目">编辑文档</a>
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
                @else
                    <div class="">无相关内容</div>
                @endif
            </div>

            {{--分页--}}


        </div>






    </div>

    {{--模态框--}}
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form  id="addBookDialogForm">
                    <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myModalLabel">添加项目</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
{{--                                    <input type="hidden" class="form-control" placeholder="标题(不超过100字)" name="username" value="{{Cookie::get('username')}}" id="flag">--}}
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="标题(不超过100字)" name="project_name" id="bookName">
                                </div>
                                <div class="form-group">
                                    <div class="pull-left" style="padding: 7px 5px 6px 0">
                                        http://doc.iminho.me/docs/
                                    </div>
                                    <input type="text" class="form-control pull-left" style="width: 220px;vertical-align: middle" placeholder="项目唯一标识(不能超过50字)" name="identify" id="identify">
                                    <div class="clearfix"></div>
                                    <p class="text" style="font-size: 12px;color: #999;margin-top: 6px;">文档标识只能包含小写字母、数字，以及“-”和“_”符号,并且只能小写字母开头</p>

                                </div>
                                <div class="form-group">
                                    <textarea name="description" id="description" class="form-control" placeholder="描述信息不超过500个字符" style="height: 90px;"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label>
                                            <input type="radio" name="privately_owned" value="0" checked=""> 公开<span class="text">(任何人都可以访问)</span>
                                        </label>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>
                                            <input type="radio" name="privately_owned" value="1"> 私有<span class="text">(只要参与者或使用令牌才能访问)</span>
                                        </label>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="clearfix"></div>
                            </div>
                            <div class="modal-footer">
                                <span id="form-error-message"></span>
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                <button type="button" class="btn btn-success" id="btnSaveDocument" data-dismiss="modal" data-loading-text="保存中...">保存</button>
                            </div>
                    </div>
                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


@endsection

@section('footer')
    @parent
    <script>
        $('#btnSaveDocument').on('click',function () {
            $.ajax({
                url: 'saveProject',
                type: 'get',
                data: $('#addBookDialogForm').serialize() ,
                success:function (data) {
//                    console.log(data);
                    $html='';
                    $('.project-list').html($html);
                    $.each(data,function (k,v) {
                        $html +=`
                            <div class="project-unit">
                                <div class="project-top">
                                    <div class="abstract">
                                        <a href="seeProject?project_name=${v.project_name}" title="项目名">${v.project_name}</a>
                                    </div>
                                 <div class="see-box">
                                {{--<a href="{{url('myDoc',['username'=>${v.username}])}}">查看文档</a>&nbsp;&nbsp;--}}
                                     <a href="myDoc?project_name=${v.project_name}" title="项目下的文档">查看文档</a>&nbsp;&nbsp;
                                     <a href="javascript:void(0)" title="编辑当前项目">编辑文档</a>
                                 </div>
                                 </div>
                        <div class="project-middle" title="摘要">
                            {{--@if($project->abstract)
                                {{$project->abstract}}
                                @else--}}
                            ${v.abstract}
                            &nbsp;
{{--@endif--}}
                            </div>
                            <div class="project-bottom">
                                <span title="创建时间">${v.created_at}</span>&nbsp;&nbsp;
                            <span title="文档数量">${v.doc_num}</span>&nbsp;&nbsp;
                            <span title="作者">${v.username}</span>
                        </div>
                    </div>
                {{--@endforeach--}}
                        `
                    });
                    $('.project-list').html($html);
                }
            })
        })
    </script>
@endsection


