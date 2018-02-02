<?php

namespace App\Http\Controllers\admin;

use App\model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        if ($request->get('password'))
        {
            $datas->password = bcrypt($request->get('password'));
        }
        if ($request->get('email'))
        {
            $datas->email = $request->get('email');
        }
        if ($request->get('phone'))
        {
            $datas->phone = $request->get('phone');
        }
        if ($request->get('description'))
        {
            $datas->description = $request->get('description');
        }
        $bool = $datas->save();
        if ($bool)
        {
            $request->session()->flash('success','修改成功！');
        }else
        {
            $request->session()->flash('warning','修改失败！');
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
            }else
            {
                $request->session()->flash('warning','修改失败！');
            }
        }
        return redirect()->back();
    }
}
