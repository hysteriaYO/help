<?php

namespace App\Http\Controllers\admin;

use App\model\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectListController extends Controller
{
    //admin修改项目信息
    public function adminEdit()
    {

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
}
