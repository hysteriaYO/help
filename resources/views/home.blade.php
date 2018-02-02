{{--唐利华--}}

<style>
    .home-content {
        margin-top: 70px;
        display: flex;
        justify-content: flex-start;
        flex-wrap: wrap;
    }

    .home-content .box {
        margin: 10px 10px;
        display: flex;
        flex-direction: column;
        /*align-items: center;*/

    }

    .home-content .box img {
        height: 300px;
        width: 200px;
    }

    .btn-list {
        display: flex;
        justify-content: center;
    }
    h1{
        color: #ff0000;
        text-align: center;
    }
</style>

{{--@extends('base')--}}
@extends('layouts.basic')

@include('layouts.header')


@section('content')
    <div class="content">
    <div class="home-box">
        <div class="container home-content">
            @foreach($projects as $project)
                <div class="box">
                    <div class="img">
                        <a href="myDoc?project_name={{$project->project_name}}"><img src="" alt="封面"></a>
                    </div>
                    <div class="title">
                        标题：{{$project->project_name}}
                    </div>
                    <div class="author">
                        作者：{{$project->username}}
                    </div>
                </div>
            @endforeach

        </div>
        <div class="container btn-list">
            {{$projects->links()}}
        </div>
    </div>


@endsection


@section('footer')
    @parent
    {{--获取项目和搜索--}}
    <script>
        $(document).ready(function () {
            $('.keyword').on('keypress', function (e) {
                if (e.keyCode == 13) {
                    $keyword = $('.keyword').val();
//                    $num = 10 ;
                    // alert($keyword);
                    $.ajax({
                        url: 'homeSearch',
                        type: 'get',
                        data: {'keyword': $keyword},
                        success: function (data) {
//                            console.log(data);
                            $html = '';
                            $('.btn-list').html($html);
                            $('.home-content').html($html);
                            $.each(data, function (k, v) {
                                $html += `
                                <div class="box">
                                    <div class="img">
                                        <a href="myDoc?project_name=${v.project_name}"><img src="" alt="封面"></a>
                                    </div>
                                    <div class="title">
                                        标题：${v.project_name}
                                    </div>
                                     <div class="author">
                                        作者：${v.username}
                                    </div>
                                </div>
                                `
                            });
                            if($html != ''){
                                $('.home-content').html($html);
                            }
                            else{
                                $('.home-content').html("<h1 style='color: #ff6699;margin: 0 auto;'>无相关项目^_^请重新输入。。。</h1>");
                            }

                        }

                    });
                }
            });
        });
    </script>

@endsection
