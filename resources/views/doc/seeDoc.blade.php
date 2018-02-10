<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>seeDoc</title>
    <style>
        @media screen and (max-width: 1000px)
        {
            .box{
                width:90% !important;
            }
            .info{
                display: flex;
                flex-direction: column;
            }
            .box{
                width:90% !important;

            }
        }
        body{
            background-color: #ebe5d8;
        }
        *{
            margin:0;
            padding:0;
        }
        .box{
            width:60%;
            margin:0 auto;
            display: flex;
            flex-direction: column;
        }

        .title{
            display: flex;
            justify-content: center;
            font-size: 24px;
            font-weight: 500;
            padding: 5px 0;
            background-color: #f6f1e7;

        }
        .content{
            display: flex;
            margin-top: 10px;
            padding: 5px 0;
            overflow: scroll;
            background-color: #f6f1e7;
        }
        .footer{
            margin-top: 10px;
            background-color: #f6f1e7;
            padding: 5px 0;

        }
        .info{
            display: flex;
            justify-content: center;
        }
        .info span{
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="box">
        <div class="title">{{ $doc->title }}</div>
        <div class="content">{!!$content!!}</div>
        <div class="footer">
                <div class="info">
                    邮箱:<span>{{ $doc->email }}</span>
                    公司:<span>{{ $doc->company }}</span>
                    版权:<span>{{ $doc->copyright }}</span>
                    创建时间:<span>{{ $doc->created_at }}</span>
                    更新时间:<span>{{ $doc->updated_at }}</span>
                </div>
        </div>
    </div>
</body>
</html>