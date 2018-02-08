<?php

namespace App\Http\Controllers\users;

use App\model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
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
            'vericode' => 'required|confirmed'
        ]);

        //用户名、密码匹配
        $loginUser = User::where('username',$request->get('username'))->first();
        if ($loginUser == null)
        {
            $request->session()->flash('danger','用户名或密码错误');
            return redirect()->back();
        }
        if (Hash::check($request->get('password'),$loginUser->password))
        {
            //记住我
            if ($request->get('remember'))
            {
                echo $request->get('_token');
                $loginUser->remember_token = $request->get('_token');
                $loginUser->save();
            }
//            Cookie::queue('username',$request->get('username'));
            return redirect()->route('home')->cookie('username',"$loginUser->username");     //cookie有效一周,604800

        }
        else
        {
            $request->session()->flash('danger','用户名或密码错误');
            return redirect()->back();
        }
    }

    //用户退出
    public function logout(Request $request)
    {
        return redirect()->route('login')->cookie('username','guest',-1);
    }

    //用户注册
    public function create(Request $request)
    {
        //字段范围检测，不能有空字段，不在范围的字段
        $this->validate($request,[
            'username' => 'required|unique:users|max:40',
            'password' => 'required|confirmed|min:6|max:40|alpha_num',
            'email' => 'required|email|max:40'
        ]);

        //开始注册
        $user = User::create([
                'username' => $_POST['username'],
                'password' => bcrypt($_POST['password']),
                'email' => $_POST['email']
            ]);

        $request->session()->flash('success','注册成功！请登录');
        return redirect()->route('login');
    }

    //找回密码
    public function forget(Request $request)
    {
        //字段范围检测，不能有空字段，不在范围的字段
        $this->validate($request,[
            'username' => 'required|max:40',
            'password' => 'required|confirmed|min:6|max:40|alpha_num',
            'email' => 'required|email|max:40'
        ]);

        $forgetUser = User::where('username',$request->get('username'))->first();

        if ($forgetUser == null)
        {
            $request->session()->flash('danger','用户名不存在');
            return redirect()->back();
        }

        if ($forgetUser->email == $request->get('email'))
        {
            //邮箱正确，找回密码
            $forgetUser->password = bcrypt($request->get('password'));
            $request->session()->flash('success','已经找回密码！');
            return redirect()->back();
        }
        else
        {
            $request->session()->flash('danger','邮箱错误');
            return redirect()->back();
        }
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
        $change = 0;
        if ($request->get('phone') == $datas->phone)
        {
            //phone没变
        }
        else
        {
            $datas->phone = $request->get('phone');
            $change = 1;
        }
        if ($request->get('description') == $datas->description)
        {
            //description没变
        }
        else
        {
            $datas->description = $request->get('description');
            $change = 1;
        }
        $datas->save();
        if ($change)
        {
            //datas发生了变化
            $request->session()->flash('info','修改成功！');
        }
        else
        {
            $request->session()->flash('warning','用户信息没有发生变化！');
        }

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

        //旧密码不可以与新密码相同
        if ($request->get('oldpassword') == $request->get('password'))
        {
            $request->session()->flash('warning','新旧密码不可以相同！');
            return redirect()->back();
        }

        //用户名、密码匹配
        $datas = User::where('username',Cookie::get('username'))->first();
        if ($datas == null)
        {
            //不可能出现
            return redirect()->Route('home');
        }

        if (Hash::check($request->get('oldpassword'),$datas->password))
        {
            $datas->password = bcrypt($request->get('password'));
            $datas->save();
            $request->session()->flash('success','修改密码成功！');
        }
        else
        {
            $request->session()->flash('warning','密码错误，请重新输入！');
        }

        return redirect()->back();
    }
}
