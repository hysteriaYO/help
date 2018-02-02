<?php

namespace App\Http\Controllers;

use App\model\Doc;
use App\model\Photo;
use App\model\Project;
use App\model\User;
use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Cookie;

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
        if (Cookie::has('username')) {
            //如果已经存在username
            //$var = Cookie::get('username');
            return view('home', ['projects' => $projects]);
        } else {
            //设置游客身份
            Cookie::queue('username', 'guest');
            //$var = Cookie::get('username');
            return view('home', ['projects' => $projects]);
        }
    }

    //显示登录界面
    public function showLoginForm()
    {
        return view('users.login');
    }

    //显示注册界面
    public function showCreateForm()
    {
        return view('users.create');
    }

    //显示个人中心
    public function showPersonSpace()
    {
        $datas = User::all()->where('username',Cookie::get('username'))->first();
        return view('users.person',['datas'=>$datas]);
    }

    //显示修改密码界面
    public function showUpdatePassword()
    {
        return view('users.updatePassword');
    }

    //显示我的项目
    public function showMyProject()
    {
        $projects = Project::all()->where('username',Cookie::get('username'));
        return view('users.myProject',['projects'=>$projects]);
    }

    //显示仪表盘
    public function showBoardForm()
    {
        $userNum = User::count();
        $projectNum = Project::count();
        $docNum = Doc::count();
        $photoNum = Photo::count();
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
        $datas = Photo::all();
        return view('admin.photo',['datas'=>$datas]);
    }

    //显示用户列表
    public function showUserList()
    {
        $datas = User::all();
        return view('admin.userlist',['datas'=>$datas]);
    }

    //显示项目列表
    public function showProjectList()
    {
        $datas = Project::all();
        return view('admin.projectlist',['datas'=>$datas]);
    }

    //显示admin修改用户界面
    public function showUserEdit($id)
    {
        $datas = User::find($id);
        return view('admin.userEdit',['datas'=>$datas]);
    }

    //显示admin修改项目界面
    public function showProjectEdit($id)
    {
        $datas = Project::find($id);
        return view('admin.projectEdit',['datas'=>$datas]);
    }
}
