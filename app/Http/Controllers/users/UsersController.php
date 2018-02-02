<?php

namespace App\Http\Controllers\users;

use App\model\User;
use App\model\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class UsersController
 * @package App\Http\Controllers\users
 * 郭俊秀
 * UsersController管理用户的操作
 */

class UsersController extends Controller
{
    //用户登录
    public function login(Request $request)
    {
        //字段范围检测，不能有空字段，不在范围的字段
        $credentials = $this->validate($request,[
            'username' => 'required|max:40',
            'password' => 'required',
        ]);

        //用户名、密码匹配
        $login_user = User::where('username',$request->get('username'))->first();
        if ($login_user == null)
        {
            return redirect()->back();
        }
        if (Hash::check($request->get('password'),$login_user->password))
        {
            //记住我
            if ($request->get('remember'))
            {
                echo $request->get('_token');
                $login_user->remember_token = $request->get('_token');
                $login_user->save();
            }
            Cookie::queue('username',$request->get('username'));
            return redirect()->route('home');
        }else
        {
            return redirect()->back();
        }
    }

    //用户退出
    public function logout()
    {
        Cookie::queue('username','guest');
        return redirect()->route('login');
    }

    //用户注册
    public function create(Request $request)
    {
        //字段范围检测，不能有空字段，不在范围的字段
        $this->validate($request,[
            'username' => 'required|unique:users|max:40',
            'password' => 'required|confirmed|min:6|max:40',
            'email' => 'required|email|max:40'
        ]);

        //开始注册
        $user = User::create([
                'username' => $_POST['username'],
                'password' => bcrypt($_POST['password']),
                'email' => $_POST['email']
            ]);

        //echo '注册成功';
//        Cookie::queue('username',$_POST['username']);
//        return redirect()->route('home');
        //返回登录页面
        $request->session()->flash('success','注册成功！请登录');
        return redirect()->route('login');
    }

    //编辑用户信息
    public function edit(Request $request)
    {
        //字段范围检测，不能有空字段，不在范围的字段
        $credentials = $this->validate($request,[
            'email' => 'required|email',
            'phone' => 'nullable|numeric|max:40',
            'description' => 'nullable|max:255',
        ]);

        //符合要求的数据存入数据库
        $datas = User::where('username',Cookie::get('username'))->first();
        $datas->email = $request->get('email');
        if ($request->get('phone'))
        {
            $datas->phone = $request->get('phone');
        }
        if ($request->get('description'))
        {
            $datas->description = $request->get('description');
        }
        $datas->save();

        return view('users.person',['datas'=>$datas]);
    }

    //用户更新密码
    public function update(Request $request)
    {
        //字段范围检测，不能有空字段，不在范围的字段
        $credentials = $this->validate($request,[
            'oldpassword' => 'required|min:6|max:40',
            'password' => 'required|confirmed|min:6|max:40'
        ]);

        //用户名、密码匹配
        $datas = User::where('username',Cookie::get('username'))->first();
        if ($datas == null)
        {
            //不可能出现
            return redirect()->back();
        }
        if (Hash::check($request->get('oldpassword'),$datas->password))
        {
            $datas->password = bcrypt($request->get('password'));
            $datas->save();
            $request->session()->flash('success','修改密码成功！');
        }else
        {
            $request->session()->flash('warning','密码错误，请重新输入！');
        }
        return redirect()->back();
    }

}
