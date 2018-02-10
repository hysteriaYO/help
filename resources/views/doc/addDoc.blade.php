@extends('layouts.basic')

@section('header')

@endsection
@section('log-header')

@endsection
@section('content')
        <div id="layout">
            <div class="add-doc-header" style="padding: 0px 10px;margin-top: 5px;display: flex;justify-content: space-between">
                <h3 style="margin-left: 5%">添加文档</h3>
                <div class="doc-header-right" style="margin-right: 5%">
                    <a href="myProject?username={{ Cookie::get('username') }}"><button class="btn">我的项目</button></a>
                    <button class="btn btn-success btn-save">保存</button>
                </div>
            </div>
            <div id="content">
                <textarea style="display:none;">1321</textarea>
            </div>
        </div>
        <script type="text/javascript">

           $(document).ready(function () {
               var editor;
               $(function() {
                   editor = editormd("content", {
                       width   : "90%",
                       height  : 640,
                       syncScrolling : "single",
                       path    : "../lib/",
                       saveHTMLToTextarea :true
                   });
//                   setTimeout(function () {
//                       console.log(editor.getHTML());
//                   },500)// 获取 Textarea 保存的 HTML 源码
               });

               $('.btn-save').on('click',function () {
                   $html = editor.getHTML();
                   $.ajaxSetup({
                       headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }
                   });
                   $.ajax({
                       url:'addDocSave',
                       type:'post',
                       data:{'html':$html},
                       success:function(data){
                           console.log(data);
                       }
                   });
               });


           });
        </script>

@endsection

@section('footer')



    @endsection

