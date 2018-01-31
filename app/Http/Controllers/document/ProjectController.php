<?php
/**
 * Created by PhpStorm.
 * User: CoooooL
 * Date: 2018/1/24
 * Time: 17:29
 */

namespace App\Http\Controllers\document;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\Project;
use Illuminate\Support\Facades\Cookie;

class ProjectController extends Controller
{
    public function insertToProject()
    {
        $data =Project::create([
         'project_name'=>'文件','abstract' => 'text','doc_num' => '10','username' => 'lisi'
        ]);

        dd($data);
    }

    public function home()
    {
        $projects = Project::all();
        return view('doc.home',['projects' => $projects]);
    }

    //主页的搜索
    public function homeSearch(Request $request)
    {
        $keyword = $request->keyword;
        $projects = Project::where('project_name','like','%'.$keyword.'%')->get();

        return $projects;
    }



    public function myProject(Request $request)
    {
        $username = $request->username;
        $projects = Project::where('username','=',$username)
            ->orderBy('updated_at','desc')
            ->get();
        return view('doc.myProject',['projects' => $projects]);
    }

    public function saveProject()
    {
        $username = Cookie::get('username');
        $project_name = $_GET['project_name'];
        $tag = $_GET['identify'];
        $abstract = $_GET['description'];
        Project::create(
            ['project_name'=> $project_name,
                'abstract' => $abstract,
                'username' => $username
            ]
        );
        $projects = Project::where('username','=',$username)
            ->orderBy('updated_at','desc')
            ->get();
//            ->paginate(5);
        return $projects;

    }
    public function seeProject(Request $request)
    {
        $project_name = $request->project_name;
        $project = Project::where('project_name','=',$project_name)->get();
        return view('doc.seeProject',['project'=>$project]);
    }



}