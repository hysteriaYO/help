<?php

namespace App\Http\Controllers;

use App\model\Doc;
use App\model\File;
use App\model\Project;
use App\model\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

/**
 * Class HomeController
 * @package App\Http\Controllers
 * 郭俊秀
 * HomeController用来导航
 */

class HomeController extends Controller
{
    //显示主页
    public function index()
    {
        $projects = Project::offset(0)->paginate(10);
        return view('home', ['projects' => $projects]);
    }

    //显示登录界面
    public function showLoginForm(Request $request)
    {
        return view('users.login');
    }

    //显示注册界面
    public function showCreateForm()
    {
        return view('users.create');
    }

    //显示忘记密码界面
    public function showForgetForm()
    {
        return view('users.forget');
    }

    //显示个人中心
    public function showPersonSpace()
    {
        //阻止非登录用户操作
        if (Cookie::has('username'))
        {
            if (Cookie::get('username') == 'guest')
            {
                return redirect()->route('login');
            }
        }
        else
        {
            return redirect()->route('login');
        }

        $datas = User::all()->where('username',Cookie::get('username'))->first();
        return view('users.person',['datas'=>$datas]);
    }

    //显示修改密码界面
    public function showUpdatePassword()
    {
        //阻止非登录用户操作
        if (Cookie::has('username'))
        {
            if (Cookie::get('username') == 'guest')
            {
                return redirect()->route('login');
            }
        }
        else
        {
            return redirect()->route('login');
        }

        return view('users.updatePassword');
    }

    //显示我的项目
    public function showMyProject()
    {
        //阻止非登录用户操作
        if (Cookie::has('username'))
        {
            if (Cookie::get('username') == 'guest')
            {
                return redirect()->route('login');
            }
        }
        else
        {
            return redirect()->route('login');
        }

        $projects = Project::all()->where('username',Cookie::get('username'));
        return view('users.myProject',['projects'=>$projects]);
    }

    //显示仪表盘
    public function showBoardForm()
    {
        //阻止非登录用户操作
        if (Cookie::has('username'))
        {
            if (Cookie::get('username') == 'guest')
            {
                return redirect()->route('login');
            }
        }
        else
        {
            return redirect()->route('login');
        }

        $userNum = User::count();
        $projectNum = Project::count();
        $docNum = Doc::count();
        $photoNum = File::count();
        $data=[];
        $data['userNum']=$userNum;
        $data['projectNum']=$projectNum;
        $data['docNum']=$docNum;
        $data['photoNum']=$photoNum;

        return view('admin.dashboard',['data'=>$data]);
    }

    //显示附件管理
    public function showPhotoForm()
    {
        //阻止非登录用户操作
        if (Cookie::has('username'))
        {
            if (Cookie::get('username') == 'guest')
            {
                return redirect()->route('login');
            }
        }
        else
        {
            return redirect()->route('login');
        }

        $datas = File::all();
        return view('admin.fileList',['datas'=>$datas]);
    }

    //显示用户列表
    public function showUserList()
    {
        //阻止非登录用户操作
        if (Cookie::has('username'))
        {
            if (Cookie::get('username') == 'guest')
            {
                return redirect()->route('login');
            }
        }
        else
        {
            return redirect()->route('login');
        }

        $datas = User::all();
        return view('admin.userList',['datas'=>$datas]);
    }

    //显示项目列表
    public function showProjectList()
    {
        //阻止非登录用户操作
        if (Cookie::has('username'))
        {
            if (Cookie::get('username') == 'guest')
            {
                return redirect()->route('login');
            }
        }
        else
        {
            return redirect()->route('login');
        }

        $datas = Project::all();
        return view('admin.projectList',['datas'=>$datas]);
    }

    //显示admin修改用户界面
    public function showUserEdit($id)
    {
        //阻止非登录用户操作
        if (Cookie::has('username'))
        {
            if (Cookie::get('username') == 'guest')
            {
                return redirect()->route('login');
            }
        }
        else
        {
            return redirect()->route('login');
        }

        $datas = User::find($id);
        return view('admin.userEdit',['datas'=>$datas]);
    }

    //显示admin修改项目界面
    public function showProjectEdit($id)
    {
        //阻止非登录用户操作
        if (Cookie::has('username'))
        {
            if (Cookie::get('username') == 'guest')
            {
                return redirect()->route('login');
            }
        }
        else
        {
            return redirect()->route('login');
        }


        $datas = Project::find($id);
        return view('admin.projectEdit',['datas'=>$datas]);
    }

    //显示admin创建用户界面
    public function showUserCreate(Request $request)
    {
        //阻止非登录用户操作
        if (Cookie::has('username'))
        {
            if (Cookie::get('username') == 'guest')
            {
                return redirect()->route('login');
            }
        }
        else
        {
            return redirect()->route('login');
        }

        return view('admin.userCreate');
    }

    //显示admin创建项目界面
    public function showProjectCreate()
    {
        //阻止非登录用户操作
        if (Cookie::has('username'))
        {
            if (Cookie::get('username') == 'guest')
            {
                return redirect()->route('login');
            }
        }
        else
        {
            return redirect()->route('login');
        }

        return view('admin.projectCreate');
    }

    //显示admin显示附件详情界面
    public function showFileEdit($id)
    {
        //阻止非登录用户操作
        if (Cookie::has('username'))
        {
            if (Cookie::get('username') == 'guest')
            {
                return redirect()->route('login');
            }
        }
        else
        {
            return redirect()->route('login');
        }

        $datas = File::find($id);
        return view('admin.fileEdit',['datas'=>$datas]);
    }

    //显示admin上传附件界面
    public function showFileUpload()
    {
        //阻止非登录用户操作
        if (Cookie::has('username'))
        {
            if (Cookie::get('username') == 'guest')
            {
                return redirect()->route('login');
            }
        }
        else
        {
            return redirect()->route('login');
        }

        return view('admin.fileUpload');
    }
}
