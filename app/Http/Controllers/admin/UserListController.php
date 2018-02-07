<?php

namespace App\Http\Controllers\admin;

use App\model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserListController
 * @package App\Http\Controllers\admin
 * 郭俊秀
 * UserListController用来进行对用户的相关操作，操作：上传、修改、删除
 */
class UserListController extends Controller
{
    //admin修改用户信息
    public function adminEdit($id,Request $request)
    {
        //字段范围检测，不能有空字段，不在范围的字段
        $credentials = $this->validate($request,[
            'password' => 'bail|nullable|confirmed|min:6|max:40',
            'email' => 'bail|required|email',
            'phone' => 'bail|nullable|size:11', //numeric
            'description' => 'bail|nullable|max:255',
        ]);

        $datas = User::find($id);
        $change = 0;
        if (Hash::check($request->get('password'),$datas->password))
        {
            //密码相同
        }
        else
        {
            $datas->password = bcrypt($request->get('password'));
            $change = 1;
        }

        if ($request->get('email') == $datas->email)
        {
            //email相同
        }
        else
        {
            $datas->email = $request->get('email');
            $change = 1;
        }

        if ($request->get('phone') == $datas->phone)
        {
            //phone相同
        }
        else
        {
            $datas->phone = $request->get('phone');
            $change = 1;
        }

        if ($request->get('description') == $datas->description)
        {
            //description相同
        }
        else
        {
            $datas->description = $request->get('description');
            $change = 1;
        }

        if ($change)
        {
            //发生了变化
            $bool = $datas->save();
            if ($bool)
            {
                $request->session()->flash('success','修改成功！');
            }
            else
            {
                $request->session()->flash('warning','修改失败！');
            }
        }
        else
        {
            $request->session()->flash('warning','没有修改信息！');
        }

        return redirect()->back();
    }

    //admin删除用户
    public function adminDelete($id,Request $request)
    {
        $datas = User::find($id);
        if ($datas->username == 'admin')
        {
            $request->session()->flash('warning','admin不可删除！');
        }
        else
        {
            $bool = $datas->delete();
            if ($bool)
            {
                $request->session()->flash('success','修改成功！');
            }
            else
            {
                $request->session()->flash('warning','修改失败！');
            }
        }

        return redirect()->back();
    }

    //admin创建用户
    public function adminCreate(Request $request)
    {
        //字段范围检测，不能有空字段，不在范围的字段
        $this->validate($request,[
            'username' => 'required|unique:users|min:6|max:40',
            'password' => 'required|confirmed|min:6|max:40|alpha_num',
            'email' => 'required|email|max:40',
            'phone' => 'nullable|numeric|max:40',
            'description' => 'nullable|max:255',
        ]);

        $datas = User::create([
            'username' => $_POST['username'],
            'password' => bcrypt($_POST['password']),
            'email' => $_POST['email'],
        ]);

        if ($request->has('phone'))
        {
            $datas->phone = $request->get('phone');
        }
        if ($request->has('description'))
        {
            $datas->description = $request->get('description');
        }
        $datas->save();
        $request->session()->flash('success','创建成功！');
        return redirect()->back();
    }
}
