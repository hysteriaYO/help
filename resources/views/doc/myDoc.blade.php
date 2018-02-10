<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>myDoc</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/editormd.css">

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/editormd.js"></script>

    <style type="text/css">
        @media screen and (max-width: 1000px) {
            .doc-content {
                display: flex;
                flex-direction: column !important;
            }

            .doc-content .content-left {
                width: 100% !important;
                height: auto;
            }

            .doc-content .content-right {
                display: none;
                /*height:80% !important;*/
                width: 100% !important;
            }
        }

        body {
            background-color: #eeeeee;
            display: flex;
            flex-direction: column;
        }

        .doc-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            border-bottom: 1px solid #dddddd;
        }

        .doc-content {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            height: 100%;
        }

        .doc-content .content-left {
            width: 20%;
            border-right: 1px solid #dddddd;
            display: flex;
            flex-direction: column;
            padding: 10px;
        }

        .doc-content .content-left .title-box {
            display: flex;
            justify-content: space-around;
            height: 50px;
            /*border-bottom: 1px solid #dddddd;*/
        }

        .doc-content .content-left .title-box .title-1 {
            /*padding: 5px;*/
            /*font-size: 16px;*/
            line-height: 200%;
        }

        .doc-content .content-left .doc-list {
            margin-top: 10px;
            padding: 10px 0;
            padding-left: 20px;
            border-top: 1px solid #dddddd;
            overflow: scroll;
        }

        .doc-content .content-right {
            /*position: absolute;*/
            /*top: 60px;*/
            /*bottom:0;*/
            padding: 10px 20px;
            width: 100%;
            background-color: #FFFFFF;
        }

        .doc-content .content-right .abstract {
            display: flex;
            justify-content: center;
            font-size: 20px;
            font-weight: 500;
        }

        .doc-content .content-right .middle-content {
            margin-top: 5px;
        }
        .doc-item{
            display: flex;
            justify-content:space-between;
            margin: 5px;
        }
        .docTitle{
            overflow: hidden;
            text-overflow:ellipsis;
            white-space: nowrap;
            width: 150px;
            cursor: pointer;
        }
        .message {
            color: #00ff00;
        }

        .addActive {
            color: red;
        }
    </style>
</head>
<body>
{{--唐利华--}}
<div class="doc-head">
    <div class="head-left">
        <a href="{{ Route('home') }}">首页</a>&nbsp;&nbsp;
        {{--<a href="addDoc">添加文档</a>--}}
        当前项目：<span class="projectName" title="项目名">{{$project->project_name}}</span>&nbsp;&nbsp;
        @if(Cookie::has('username'))
            @if((Cookie::get('username')) == $project->username)
        <button href="javascript:void(0)" class="btn  btn-addDoc">添加文档</button>
            @endif
        @endif
        {{--<button class="btn btn-success">保存</button>--}}
    </div>
    <div class="head-right" style="margin-right: 55px">
        @if(Cookie::has('username'))
            @if((Cookie::get('username')) == 'guest')

                <ul class="nav-login-lo">
                    <li><a href="{{route('login')}}">登录</a></li>
                </ul>
            @else
                <ul class="nav-login-lo">
                    <li class="dropdown ">
                        <a href="#" class="" data-toggle="dropdown" role="button"  aria-expanded="true">&nbsp;&nbsp;{{ Cookie::get('username') }}&nbsp;&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ Route('user.show') }}"><span class="glyphicon glyphicon-user"></span>个人信息</a></li>
                            <li><a href="myProject?username={{Cookie::get('username')}}"><span class="glyphicon glyphicon-list"></span>我的项目</a></li>
                            @if((Cookie::get('username')) == 'admin')
                                <li><a href="{{ Route('dashboard') }}"><span class="glyphicon glyphicon-home"></span>管理后台</a></li>
                            @endif
                            <li><a href="{{ Route('user.logOut') }}"><span class="glyphicon glyphicon-log-out"></span>退出登录</a></li>
                        </ul>
                    </li>
                </ul>
            @endif
        @else
            <ul class="nav-login-lo">
                <li><a href="{{route('login')}}">登录</a></li>
            </ul>
        @endif
    </div>
</div>

<div class="doc-content">
    <div class="content-left">
        <div class="title-box">
            <button class="btn list-title title-1">目录</button>
            <input type="text" class="search-in title-1" placeholder="请输入搜索内容">
            <button class="btn btn-success btn-search">搜索</button>
        </div>
        <div class="doc-list">
            @if($docs->count())
                @foreach($docs as $doc)
                    <div class="doc-item">
                        <a href="seeDoc?doid={{$doc->doid}}" target="_blank">
                            @if( $doc -> sign )
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-unlock" aria-hidden="true"></i>
                            @endif
                            <span id="{{$doc->doid}}" class="docTitle">{{$doc->title}}
                        </span></a>
                        <div>
                            @if(Cookie::has('username'))
                                    @if((Cookie::get('username')) != 'guest')
                                        <button class="btn editDoc">编辑</button>
                                        <button class="btn dropDoc">删除</button>
                                    @endif
                            @endif
                        </div>
                    </div>

                @endforeach
            @else
                <p>空文档</p>
            @endif

        </div>
    </div>
    <div class="content-right">
        <div class="abstract">
            @foreach($docs as $doc)
            标题：<span class="doc-title">{{$doc -> title}}</span>
                @break;
                @endforeach
        </div>
        <div class="middle-content">
            {{--<div id="layout">--}}
            {{--<div class="add-doc-header" style="padding: 0px 10px;margin-top: 5px;display: flex;justify-content: space-between">--}}
            {{--<h3 style="margin-left: 5%">添加文档</h3>--}}
            {{--<div class="doc-header-right" style="margin-right: 5%">--}}
            {{--<a href="myProject?username={{ Cookie::get('username') }}"><button class="btn">我的项目</button></a>--}}
            {{--<button class="btn btn-success btn-save">保存</button>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div id="edit-content">--}}
            {{--<textarea style="display:none;">1321</textarea>--}}
            {{--</div>--}}
            {{--</div>--}}
        </div>

    </div>

</div>

{{--添加文档相关信息的模态框  start--}}
<div>
    <div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addBookDialogForm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">添加文档</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="text" class="col-sm-4 control-label">文档标题</label>
                                <div class="col-sm-6 message"></div>
                            </div>
                            <div class="col-sm-12">
                                <input type="text" name="title" class="form-control title" id="" placeholder="title">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-6">
                                <label>
                                    <input type="radio" name="radio" class="radio" value="0" checked id="radio0"> 公开<span class="text">(任何人都可以访问)</span>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label>
                                    <input type="radio" name="radio" class="radio" value="1" id="radio1"> 私有<span class="text">(仅限自己可以访问)</span>
                                </label>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer">
                        <span class=""></span>
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-success" id="btnSaveDocInfo" data-dismiss="modal"
                                data-loading-text="保存中...">保存
                        </button>
                    </div>
                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->

    </div><!-- /.modal -->

</div>
{{--添加文档相关信息的模态框  end--}}


{{--删除文档的模态框  start--}}
<div>
    <div id="dropDoc" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addBookDialogForm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">删除文档</h4>
                    </div>
                    <div class="modal-body" style="display: flex;justify-content: center">
                        此操作将删除文档
                    </div>
                    <div class="modal-footer">
                        <span class=""></span>
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-success" id="dropConfirm" data-dismiss="modal"
                                data-loading-text="保存中...">保存
                        </button>
                    </div>
                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->

    </div><!-- /.modal -->

</div>
{{--删除文档的模态框  end--}}

<script>
    $(document).ready(function () {



        //通过关键字搜索展示
        $('.btn-search').on('click', function () {
            $project_name = $('.projectName').text();
            $key = $('.search-in').val();
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url: 'searchDoc',
                type: 'post',
                data: {
                    'key': $key,
                    'project_name' : $project_name
                },
                success: function (data) {
                    $html = '';
                    $('.doc-list').html($html);
                    var signtrue=`<i class="fa fa-lock" aria-hidden="true"></i>`
                    var signfalse=`<i class="fa fa-unlock" aria-hidden="true"></i>`
                    $.each(data,function (k,v) {
                        var res = v.sign?signtrue:signfalse;
                        $html+=`
                            <div class="doc-item">
                                <a href="seeDoc?doid=${v.doid}" target="_blank">
                               ` +res+
                              `
                                <span id="${v.doid}" class="docTitle">${v.title}
                                </span></a>

                                    @if(Cookie::has('username'))
                                      @if((Cookie::get('username')) != 'guest')
                                            <button class="btn editDoc">编辑</button>
                                            <button class="btn dropDoc">删除</button>
                                        @endif
                                      @endif
                                </div>

`
                    $('.doc-list').html($html);


                // 编辑 搜索出的文档
                        $('.doc-item').map(function (i) {
                            $('.editDoc').eq(i).on('click', function () {
                                $title = ($('.doc-item').eq(i).find('span').text());
                                $('.doc-title').html($title);
                                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                                $.ajax({
                                    url: 'editDoc',
                                    data: 'title=' + $title,
                                    type: 'post',
                                    success: function (data) {
                                      alert(1);
                                        $html = '';
                                        $('.middle-content').html($html);
                                        $html += `
                                             <div id="layout">
                                                <div class="add-doc-header" style="padding: 0px 10px;margin-top: 5px;display: flex;justify-content: space-between">
                                                    <button class="btn btn-success btnSaveDoc">保存</button>
                                                </div>
                                                <div id="edit-content">
                                                    <textarea style="display:none;">${data}</textarea>
                                                </div>
                                            </div>
                                        `

                                        $('.middle-content').html($html);

                                        //markdown调用
                                        var editor;
                                        $(function () {
                                            editor = editormd("edit-content", {
                                                width: "90%",
                                                height: 640,
                                                syncScrolling: "single",
                                                path: "./lib/",
                                                saveHTMLToTextarea: true
                                            });
                                        });

                                        //搜索内容编辑后u保存
                                        $('.btnSaveDoc').on('click',function () {
                                           $content = editor.getHTML();
//                                            $content = editor.getMarkdown();
                                            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                                            $.ajax({
                                                url:'docEditSave',
                                                type:'post',
                                                data:{
                                                    'title' : $title,
                                                    'content' : $content
                                                },
                                                success:function (data) {

                                                }
                                            });
                                        });
                                    }
                                });
                            });
                        })


                        //删除文档弹出 模态框
                        $('.dropDoc').on('click', function () {
                            $('#dropDoc').modal('show');
                        });


                         // 搜索出的文档进行  删除
                        $('.doc-item').map(function (i) {
                            $('.dropDoc').eq(i).on('click', function () {
                                $title = ($('.doc-item').eq(i).find('span').text());
                                $('#dropConfirm').on('click',function () {
                                    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                                    $.ajax({
                                        url:'dropDoc',
                                        type:'post',
                                        data:'title='+$title,
                                        success:function (data) {
                                            window.location.reload();
                                        }
                                    });
                                });

                            });
                        });
                    });
                }
            });

        });

        // 添加文档弹出的 模态框
        $('.btn-addDoc').on('click', function () {
            $('#addModal').modal('show');
        });

        //删除文档弹出 模态框
        $('.dropDoc').on('click', function () {
            $('#dropDoc').modal('show');
        });

        //模态框保存的文档相关信息并以用户输入的title新建一个 空文档
        $('#btnSaveDocInfo').on('click', function () {
            $project_name = $('.projectName').text();
            $company = $('.company').val();
            $phone = $('.phone').val();
            $email = $('.email').val();
            $copyright = $('.copyright').val();
            $title = $('.title').val();
            $radio = $('input:radio:checked').val();
//            console.log($project_name, $title, $company, $phone, $email, $copyright ,$radio);
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url: 'addDocInfo',
                type: 'post',
                data: {
                    'project_name': $project_name,
                    'company': $company,
                    'phone': $company,
                    'email': $email,
                    'copyright': $copyright,
                    'title': $title,
                    'radio': $radio
                },
                success: function (data) {
//                    console.log(data);
                    if( data !== 'false' )
                    {
                        $html = '';
                        $('.middle-content').html($html);
                        $html += `
                         <div id="layout">
                            <div class="add-doc-header" style="padding: 0px 10px;margin-top: 5px;display: flex;justify-content: flex-end;">
                                <!--<button class="btn btn-success btnRefresh">查看</button>-->
                                <button class="btn btn-success btnSaveDoc">保存</button>
                            </div>
                            <div id="edit-content">
                                <textarea style="display:none;"></textarea>
                            </div>
                        </div>
                    `
                        window.location.reload();
                        $('.middle-content').html($html);

                        //添加文档名到左边目录
                        $.ajaxSetup({headers: {'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content')}});
                        $.ajax({
                            url:'addDocName',
                            type:'post',
                            data:{
                                'project_name':$project_name,
                            },
                            success:function (data) {
                                $html = '';
                                $('.doc-list').html($html);
                                var signtrue=`<i class="fa fa-lock" aria-hidden="true"></i>`
                                var signfalse=`<i class="fa fa-unlock" aria-hidden="true"></i>`
                                $.each(data,function (k,v) {
                                    var res = v.sign?signtrue:signfalse;
                                    $html+=`
                                        <div class="doc-item">
                                            <a href="seeDoc?doid=${v.doid}" target="_blank">
                                   ` +res+
                                            `
                                            <span id="${v.doid}" class="docTitle">${v.title}
                                            </span></a>
                                                <div>
                                                    @if(Cookie::has('username'))
                                                    @if((Cookie::get('username')) != 'guest')
                                                       <button class="btn editDoc">编辑</button>
                                                     <button class="btn dropDoc">删除</button>
                                                    @endif
                                                    @endif
                                                </div>
                                         </div>
                                        `
                                    $('.doc-list').html($html);

                                });
                            }

                        });
                    }
                    else
                    {
                        $('.middle-content').html("文档名已存在");
                    }

                    //markdown调用
                    var editor;
                    $(function () {
                        editor = editormd("edit-content", {
                            width: "90%",
                            height: 640,
                            syncScrolling: "single",
                            path: "./lib/",
                            saveHTMLToTextarea: true
                        });
                    });


                    //获取markdown编辑的内容 保存
                    $('.btnSaveDoc').on('click',function () {
                        $content = editor.getHTML();
//                        $content = editor.getMarkdown();
                        $title = $('.title').val();
                        $radio = $('input:radio:checked').val();
                        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                        $.ajax({
                            url:'addDocSave',
                            type:'post',
                            data:{
                                'radio' : $radio,
                                'title' : $title,
                                'content' : $content
                            },
                            success:function (data) {
//                                console.log(data);
                            }
                        });
                    });
                }
            });
        });

//    编辑文档
        $('.doc-item').map(function (i) {
            $('.editDoc').eq(i).on('click', function () {
                $title = ($('.doc-item').eq(i).find('span').text());
                $('.doc-title').html($title);

                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    url: 'editDoc',
                    data: 'title=' + $title,
                    type: 'post',
                    success: function (data) {
                        $html = '';
                        $('.middle-content').html($html);
                        $html += `
                        <div id="layout">
                            <div class="add-doc-header" style="padding: 0px 10px;margin-top: 5px;display: flex;justify-content: flex-end">
                                <button class="btn btn-success btnSaveDoc">保存</button>
                            </div>
                            <div id="edit-content">
                                <textarea style="display:none;">${data}</textarea>
                            </div>
                        </div>
                    `

                        $('.middle-content').html($html);

                //markdown调用
                        var editor;
                        $(function () {
                            editor = editormd("edit-content", {
                                width: "90%",
                                height: 640,
                                syncScrolling: "single",
                                path: "./lib/",
                                saveHTMLToTextarea: true
                            });
                        });
                        $('.btnSaveDoc').on('click',function () {
                        $content = editor.getHTML();
//                            $content = editor.getMarkdown();
                            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                            $.ajax({
                                url:'docEditSave',
                                type:'post',
                                data:{
                                    'title' : $title,
                                    'content' : $content
                                },
                                success:function (data) {

                                }
                            });
                        });
                    }
                });
            });
        })

        //删除文档
        $('.doc-item').map(function (i) {
            $('.dropDoc').eq(i).on('click', function () {
                $title = ($('.doc-item').eq(i).find('span').text());
                $('#dropConfirm').on('click',function () {
                    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                    $.ajax({
                        url:'dropDoc',
                        type:'post',
                        data:'title='+$title,
                        success:function (data) {
                            window.location.reload();
                        }
                    });
                });

            });
        });


        //判断文档title的唯一性
        $('.title').on('blur', function () {
            $title = $(this).val();
            if (!$title) {
                $('.message').addClass('addActive');
                $('.message').html('文档名不能为空');
            }
            else {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    url: 'verifyDocName',
                    type: 'post',
                    data: {'title': $title},
                    success: function (data) {
//                        console.log(data)
                        if (data > 0) {
                            $('.message').addClass('addActive');
                            $('.message').html('文档名已存在');
                        }
                        else {
                            $('.message').removeClass('addActive');
                            $('.message').html('可以使用');
                        }
                    }
                });
            }
        });

    });
</script>

</body>
</html>