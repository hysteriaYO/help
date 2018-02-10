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
        .footer{
            margin:0 !important;
        }

    }

    body{
        /*display: flex;*/
        /*flex-direction: column;*/
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
        height:80%;
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
    .message{
        font-size: 16px;
        font-weight: 500;
        color: green;
    }
    .active{
        color: red;
    }
    .footer{
        display: none;
        /*display: flex;*/
        /*align-self: flex-end;*/
        /*margin-left: 210px;*/
    }

</style>
@extends('layouts.basic')


@section('title','myProject')

@section('header')
    @include('layouts.header')
@endsection

@section('log-header')

@endsection

@section('content')
    <div class="container content-project">
        <div class="left-content">
            我的项目
        </div>
        <div class="right-content">
            <div class="head-box">
                <div class="left">项目列表</div>
                <button class="btn btn-success btn-add">添加项目</button>
            </div>
            {{--提示框--}}
            @include('layouts.message')
            <div class="project-list">
                @if( $projects->count())
                    @foreach($projects as $project)

                    <div class="project-unit">
                        <div class="project-top">
                            <div class="abstract">
                                @if($project -> sign)
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                @else
                                    <i aria-hidden="true" class="fa fa-unlock"></i>
                                @endif
                                <a href="seeProject?project_name={{$project->project_name}}" title="项目名">{{$project->project_name}}</a>
                            </div>
                            <div class="see-box">

                                <a href="myDoc?project_name={{$project->project_name}}" title="项目下的文档" class="btn btn-default btn-sm pull-right" target="_blank"><i class="fa fa-edit" aria-hidden="true"></i> 查看文档</a>
                                <button href=""  class="btn btn-default btn-sm pull-right btn-edit" style="margin-right: 5px;"><span id="{{$project->id}}" class="fa fa-eye"></span> 编辑项目</button>
                                <button href="" class="btn btn-default btn-sm pull-right btn-drop" style="margin-right: 5px;" id="btnRelease"><i id="{{$project->id}}"  class="fa fa-upload" aria-hidden="true"></i> 删除项目</button>
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
                            <i class="fa fa-clock-o"></i>
                            <span title="创建时间">{{$project->created_at}}</span>&nbsp;&nbsp;
                            <i class="fa fa-pie-chart"></i>
                            <span title="文档数量">
                                @if($project->doc_num != null)
                                    {{$project->doc_num}}
                                @else
                                    0
                                @endif
                            </span>&nbsp;&nbsp;
                            <i class="fa fa-user"></i>
                            <span title="作者">{{$project->username}}</span>
                        </div>
                    </div>



                @endforeach
                @else
                    {!! "<div>无相关内容</div>" !!}

                     {{--<div class="">无相关内容</div>--}}
                @endif
                    {{--分页--}}
                    @if( $projects->count())
                    {{ $projects->appends(['username' => $project->username])->links() }}
                    @endif
            </div>



        </div>






    </div>

    {{--添加项目的模态框 start--}}
    <div>
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form  id="addBookDialogForm" enctype="multipart/form-data" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">添加项目</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                            </div>
                            <div class="form-group">
                                <div class="message"></div>
                                <input type="text" class="form-control project_name" placeholder="标题(不超过30字)" name="project_name" id="bookName">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control email" placeholder="邮箱(不超过20字)" name="email" id="email">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control phone" placeholder="电话(不超过11字)" name="phone" id="phone">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control company" placeholder="公司(不超过30字)" name="company" id="company">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control copyright" placeholder="版权(不超过30字)" name="copyright" id="copyright">
                            </div>
                            <div class="form-group">
                                <textarea name="description" id="description" class="form-control" placeholder="描述信息不超过500个字符" style="height: 90px;"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <label>
                                        <input type="radio"  name="sign" value="0" checked=""> 公开<span class="text">(任何人都可以访问)</span>
                                    </label>
                                </div>
                                <div class="col-lg-6">
                                    <label>
                                        <input type="radio"  name="sign" value="1"> 私有<span class="text">(只要参与者或使用令牌才能访问)</span>
                                    </label>
                                </div>

                                <div class="clearfix"></div>
                            </div>

                        </div>
                        <div class="form-group">
                            <span>请上传封面(未实现)</span>
                            <input type="file"  id="upload" class="form-control"  name="upload" style="border: none;box-shadow: none">
                            {{--<input type="button" name="confirmUpload" value="确认上传"/>--}}

                        </div>
                        <div class="clearfix"></div>
                        <div class="modal-footer">
                            <span class=""></span>
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="button" class="btn btn-success" id="btnSaveDocument" data-dismiss="modal" data-loading-text="保存中...">保存</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>

    </div>
    {{--添加项目的模态框 end--}}

    {{--编辑项目的模态框 start--}}
    <div class="edit-project-box">
        <div class="modal fade edit-project" id="editProject" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form  id="addBookDialogFormEdit">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">编辑项目</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                            </div>
                            <div class="form-group">
                                <span class="message"></span>
                                <input type="text" class="form-control project_name" placeholder="标题(不超过30字)" name="project_name" id="editName">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control email" placeholder="邮箱(不超过20字)" name="email" id="editEmail">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control phone" placeholder="电话(不超过11字)" name="phone" id="editPhone">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control company" placeholder="公司(不超过30字)" name="company" id="editCompany">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control copyright" placeholder="版权(不超过30字)" name="copyright" id="editCopyright">
                            </div>
                            <div class="form-group">
                                <textarea name="description" id="editDescription" class="form-control" placeholder="描述信息不超过500个字符" style="height: 90px;"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="file">选择文件</label>
                                <input type="file" class="form-control upload"  name="upload" id="upload">
                            </div>
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <label>
                                        <input type="radio" id="public" name="sign-edit" value="0"> 公开<span class="text">(任何人都可以访问)</span>
                                    </label>
                                </div>
                                <div class="col-lg-6">
                                    <label>
                                        <input type="radio" id="private" name="sign-edit" value="1"> 私有<span class="text">(只要参与者或使用令牌才能访问)</span>
                                    </label>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="button" class="btn btn-success" id="btn-save" data-dismiss="modal" data-loading-text="保存中...">保存</button>
                        </div>
                    </form>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->

        </div><!-- /.modal -->

    </div>
    {{--编辑项目的模态框 end--}}

    {{--删除项目的模态框  start--}}
    <div class="modal fade" id="dropProject" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">删除项目（慎重）</h4>
                </div>
                <div class="modal-body">
                    <p>此操作会删除项目及项目包含的所有文档</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-danger " id="btn-drop-confirm" data-dismiss="modal">确认</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    {{--删除项目的模态框  start--}}

@endsection

@section('footer')
    @parent
        <script src="js/jquery.min.js"></script>
    <script>


    $(document).ready(function () {
        //添加项目的模态框
            $('.btn-add').on('click',function () {
                $('#myModal').modal('show');
                $('#myModal').on('shown.bs.modal', function (e) {
                     // console.log('upload');
                    $('#btnSaveDocument').on('click',function () {
                        //$upload = ($('#upload').val());
                       // var file = new FormData();
                       // file.append("file",$upload);
                      //  $form = $('#addBookDialogForm').serialize() +'&upload=' +$upload;
                      //  console.log($form);
                        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                        $.ajax({
                            url: 'saveProject',
                            type: 'post',
                            data: $('#addBookDialogForm').serialize() ,
                            processData : false,
                            success:function (data) {
                                window.location.reload();
                            }
                        })
                    });
                })
            });

        //添加项目


        //验证项目标题是否唯一
        $('.project_name').on('blur',function () {
            $project_name = $(this).val();
            if(!$project_name)
            {
                $('.message').addClass('active');
                $('.message').html("项目名不能为空");
            }
            else
            {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    url:'verifyProjectName',
                    type:'post',
                    data:{'project_name':$project_name},
                    success:function (data) {
                        if( data>0 )
                        {
                            $('.message').addClass('active');
                            $('.message').html("项目名已存在");
                        }
                        else
                        {
                            $('.message').removeClass('active');
                            $('.message').html("项目名可以使用");
                        }
                    }
                });
            }
        });

//            编辑项目的模态框
            $('.btn-edit').map(function (i) {
               $('.btn-edit').eq(i).on('click',function () {
                   $('#editProject').modal('show');//调用模态框
                   var $id = ($('.btn-edit').eq(i).find('span').attr('id'));
                   $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                   $.ajax({
                       url:'editProject',
                       type:'post',
                       data:{'id':$id},
                       success:function (data) {
                           $.each(data,function (k,v) {
                               $('#editName').val(v.project_name);
                               $('#editEmail').val(v.company_email);
                               $('#editPhone').val(v.company_phone);
                               $('#editCompany').val(v.company_name);
                               $('#editCopyright').val(v.copyright);
                               $('#editDescription').val(v.description);
                               if(v.sign)
                               {
                                    $("input:radio[value='1']").attr('checked','true')
                               }
                               else
                               {
                                   $("input:radio[value='0']").attr('checked','true')
                               }
                           });
                       }
                   });

                   //编辑后保存
                   $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                   $('#btn-save').on('click',function () {
                       $project_name = $('#editName').val();
                       $email = $('#editEmail').val();
                       $phone = $('#editPhone').val();
                       $company = $('#editCompany').val();
                       $copyright = $('#editCopyright').val();
                       $project_description = $('#editDescription').val();
                       $radio = $("input:radio[name='sign-edit']:checked").val();
                       $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                       $.ajax({
                           url:'editProjectSave',
                           data:{
                               'id' : $id,
                               'project_name' : $project_name,
                               'email' : $email,
                               'phone' : $phone,
                               'company' : $company,
                               'copyright' : $copyright,
                               'project_description' : $project_description,
                               'radio' : $radio
                           },
                           type:'post',
                           success:function (data) {
//                                alert(data);
                               window.location.reload();
                           }
                       });
                   });


               });
            });


            //执行删除项目
        $('.btn-drop').map(function (i) {
            $('.btn-drop').eq(i).on('click',function () {
                $('#dropProject').modal('show');//调用模态框
                var $id = ($('.btn-edit').eq(i).find('span').attr('id'));
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $('#btn-drop-confirm').on('click',function () {
                    $.ajax({
                        url:'dropProject',
                        data:{'id':$id},
                        type:'post',
                        success:function (data) {
//                            alert('删除成功');
                            window.location.reload();

                        }
                    });
                });

            });
        });



        //搜索项目
        $('.keyword').on('keypress',function (e) {
            if(e.keyCode == 13)
            {
                $keyword = $('.keyword').val();
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    url: 'homeSearch?pag',
                    type: 'post',
                    data: {'keyword': $keyword},
                    success: function (data) {
                        $html = '';
                        $('.project-list').html($html);
                        $.each(data, function (k, v) {
                            $html += `
                                <div class="project-unit">
                                    <div class="project-top">
                                        <div class="abstract">
                                            <i aria-hidden="true" class="fa fa-unlock"></i>
                                            <a href="seeProject?project_name=${v.project_name}" title="项目名">${v.project_name}</a>
                                        </div>
                                        <div class="see-box">

                                            <a href="myDoc?project_name=${v.project_name}" title="项目下的文档" class="btn btn-default btn-sm pull-right" target="_blank"><i class="fa fa-edit" aria-hidden="true"></i> 查看文档</a>
                                            <a href="{{url('myDoc')}}" class="btn btn-default btn-sm pull-right" style="margin-right: 5px;" target="_blank"><i class="fa fa-eye"></i> 编辑项目</a>
                                            <button class="btn btn-default btn-sm pull-right" style="margin-right: 5px;" id="btnRelease"><i class="fa fa-upload" aria-hidden="true"></i> 删除项目</button>
                                        </div>
                                    </div>
                                    <div class="project-middle" title="摘要">
                                         ${v.abstract}
                                            </div>
                                            <div class="project-bottom">
                                                <i class="fa fa-clock-o"></i>
                                                <span title="创建时间">${v.created_at}}</span>&nbsp;&nbsp;
                                        <i class="fa fa-pie-chart"></i>
                                        <span title="文档数量"></span>
                                                ${v.doc_num}
                                            <i class="fa fa-user"></i>
                                            <span title="作者">${v.username}</span>
                                    </div>
                                </div>

                                `
                        });
                        if($html !== ''){
                            {{--$html+=`--}}
                                    {{--<div class="container btn-list">--}}
                                        {{--{{$projects}}--}}
                                {{--</div>--}}
{{--`--}}
                            $('.project-list').html($html);
                        }
                        else{
                            $('.project-list').html("<h1 style='color: #ff6699;margin: 0 auto;'>无相关项目^_^请重新输入。。。</h1>");
                        }

                    }

                });

            }
        })
    });
    </script>
@endsection


