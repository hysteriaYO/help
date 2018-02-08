{{--后台管理侧边栏--}}
<div class="page-left">
    <ul class="menu">
        <li class="active">
            <a href="{{ route('dashboard') }}" class="item"><span class="glyphicon glyphicon-adjust" aria-hidden="true"></span>仪表盘</a>
        </li>
        <li>
            <a href="{{ route('userList') }}" class="item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 用户管理</a>
        </li>
        <li>
            <a href="{{ route('projectList') }}" class="item"><span class="glyphicon glyphicon-hdd" aria-hidden="true"></span> 项目管理</a>
        </li>
        <li>
            <a href="{{ route('fileList') }}" class="item"><span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span> 附件管理</a>
        </li>
    </ul>
</div>