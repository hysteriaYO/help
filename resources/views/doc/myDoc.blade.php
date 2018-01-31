{{--唐利华--}}
        <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyDocument</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style type="text/css">
        @media screen and (max-width: 1000px) {
            .doc-content {
                display: flex;
                flex-direction: column !important;
            }

            .doc-content .content-left {
                width: 100% !important;
            }

            .doc-content .content-right {
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
            width: 25%;
            border-right: 1px solid #dddddd;
            display: flex;
            flex-direction: column;
            padding: 10px;
        }

        .doc-content .content-left .title-box {
            display: flex;
            justify-content: space-around;
            /*border-bottom: 1px solid #dddddd;*/
        }

        .doc-content .content-left .title-box .title-1 {
            padding: 5px;
            font-size: 18px;
        }

        .doc-content .content-left .doc-list {
            margin-top: 10px;
            padding: 10px 0;
            padding-left: 20px;
            border-top: 1px solid #dddddd;
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
    </style>
</head>
<body>
{{--唐利华--}}
<div class="doc-head">
    <div class="head-left">
        <a href="{{ Route('home') }}">首页</a>
    </div>
    <div class="head-right">
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown ">
                <a href="#" class="" data-toggle="dropdown" role="button" aria-expanded="true">&nbsp;&nbsp;admin&nbsp;&nbsp;<span
                            class="caret"></span></a>
                <ul class="dropdown-menu" style="min-width: 120px;">
                    <li><a href="{{ Route('users.person') }}">个人中心</a></li>
                    <li><a href="myProject?username={{ Cookie::get('username') }}">我的项目</a></li>
                    <li><a href="#">管理后台</a></li>
                    <li><a href="{{ Route('users.logOut') }}">退出登录</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<div class="doc-content">
    <div class="content-left">
        <div class="title-box">
            <div class="list-title title-1">目录</div>
            <input type="text" class="search-in title-1" placeholder="请输入搜索内容">
            <button class="btn btn-success btn-search">搜索</button>
        </div>
        <div class="doc-list">
            @if($docs == null)
                @foreach($docs as $doc)
                    <p class="doc-item"><span id="{{$doc->doid}}">{{$doc->title}}</span></p>
                @endforeach
            @else
                <p>无内容</p>
            @endif
        </div>
    </div>
    <div class="content-right">
        <div class="abstract">
            <span>摘要</span>
        </div>
        <div class="middle-content">
        </div>

    </div>

</div>


<script>
    $(document).ready(function () {
        //摘要
        var doid = ($('.doc-item').eq(0).find('span').attr("id"));
        $.ajax({
            url: 'seeDoc',
            data: 'doid=' + doid,
            type: 'get',
            success: function ($data) {
                if ($data) {
                    var $html = '';
                    $('.middle-content').html($html);
                    $html += $data.doc_url;
                    $('.middle-content').html($html);
                } else {
                    var $html = '无相关内容';
                    $('.middle-content').html($html);
                }
            }
        });

        $('.doc-item').map(function (i) {
            $('.doc-item').eq(i).on('click', function () {
                var doid = $('.doc-item').eq(i).find('span').attr("id");
                $.ajax({
                    url: 'seeDoc',
                    data: 'doid=' + doid,
                    type: 'get',
                    success: function ($data) {
                        var $html = '';
                        $('.middle-content').html($html);
                        $html += $data.doc_url;
                        $('.middle-content').html($html);
                    }
                });
            });
        })

        $('.btn-search').on('click', function () {
            $key = $('.search-in').val();
            $.ajax({
                url: 'searchDoc',
                type: 'get',
                data: {'key': $key},
                success: function (data) {
                    alert(data);
                }
            });
        });

    });
</script>

</body>
</html>