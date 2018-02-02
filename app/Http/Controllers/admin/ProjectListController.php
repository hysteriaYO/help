<?php

namespace App\Http\Controllers\admin;

use App\model\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $datas->project_name = $request->get('projectName');
        $datas->company_name = $request->get('companyName');
        $datas->company_phone = $request->get('companyPhone');
        $datas->company_email = $request->get('companyEmail');
        if ($request->has('description'))
        {
            $datas->description = $request->get('description');
        }
        $datas->save();

        $request->session()->flash('success','修改成功！');
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
        }else
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
