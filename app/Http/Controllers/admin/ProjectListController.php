<?php

namespace App\Http\Controllers\admin;

use App\model\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class ProjectListController
 * @package App\Http\Controllers\admin
 * 郭俊秀
 * ProjectListController用来进行对项目的相关操作，操作：创建、修改、删除
 */
class ProjectListController extends Controller
{
    //admin修改项目信息
    public function adminEdit($id,Request $request)
    {
        //字段范围检测，不能有空字段，不在范围的字段
        $this->validate($request,[
            'projectName' => 'required',
            'companyName' => 'required',
            'companyPhone' => 'required|nullable|numeric',
            'companyEmail' => 'required|email|max:40',
            'description' => 'nullable|max:255',
        ]);

        $datas = Project::find($id);
        $change = 0;
        if ($request->get('projectName') == $datas->project_name)
        {
            //project_name没有变化
        }
        else
        {
            $datas->project_name = $request->get('projectName');
            $change = 1;
        }

        if ($request->get('companyName') == $datas->company_name)
        {
            //company_name没有变化
        }
        else
        {
            $datas->company_name = $request->get('companyName');
            $change = 1;
        }

        if ($request->get('companyPhone') == $datas->company_phone)
        {
            //company_phone没有变化
        }
        else
        {
            $datas->company_phone = $request->get('companyPhone');
            $change = 1;
        }

        if ($request->get('companyEmail') == $datas->company_email)
        {
            //company_email没有变化
        }
        else
        {
            $datas->company_email = $request->get('companyEmail');
            $change = 1;
        }

        if ($request->get('description') == $datas->description)
        {
            //description没有变化
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

    //admin删除项目
    public function adminDelete($id,Request $request)
    {
        $datas = Project::find($id);
        $bool = $datas->delete();
        if ($bool)
        {
            $request->session()->flash('success','修改成功！');
        }
        else
        {
            $request->session()->flash('warning','修改失败！');
        }

        return redirect()->back();
    }

    //admin创建项目
    public function adminCreate(Request $request)
    {
        //字段范围检测，不能有空字段，不在范围的字段
        $this->validate($request,[
            'username' => 'required',
            'projectName' => 'required',
            'companyName' => 'required',
            'companyPhone' => 'required|nullable|numeric',
            'companyEmail' => 'required|email|max:40',
            'description' => 'nullable|max:255',
        ]);

        $datas = Project::create([
            'username' => $request->get('username'),
            'project_name' => $request->get('projectName'),
            'company_name' => $request->get('companyName'),
            'company_phone' => $request->get('companyPhone'),
            'company_email' => $request->get('companyEmail'),
        ]);

        if ($request->has('description'))
        {
            $datas->description = $request->get('description');
        }
        $datas->save();
        $request->session()->flash('success','创建成功！');
        return redirect()->back();
    }
}
