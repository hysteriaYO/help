<?php
/**   唐利华
 * Created by PhpStorm.
 * User: CoooooL
 * Date: 2018/1/24
 * Time: 17:29
 */

namespace App\Http\Controllers\document;

use App\Http\Controllers\Controller;
use App\model\Doc;
use Illuminate\Http\Request;
use App\model\Project;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{



    /**主页的搜索
     * @param Request $request
     * @return mixed
     */
    public function homeSearch(Request $request)
    {
        $keyword = $request->keyword;
        if($keyword != null)
        {

            $projects = Project::where('project_name', 'like', '%' . $keyword . '%')
                ->get()
//                ->paginate(10)
            ;

        }
        else
        {
            $projects = Project::offset(0)->paginate(10)->all();
        }

        return $projects;
    }

    /**我的项目  展示我的所有项目列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myProject(Request $request)
    {
        $username = $request->username;
        $projects = Project::where('username', '=', $username)
            ->orderBy('updated_at', 'desc')
            ->offset(0)
            ->paginate(10)
        ;

            return view('doc.myProject', ['projects' => $projects]);
    }

    /**验证项目名的唯一性
     * @param Request $request
     * @return mixed
     */
    public function verifyProjectName(Request $request)
    {
        $project_name = $request->project_name;
        $num = Project::where('project_name','=',$project_name)->count();
        return $num;
    }

    /**保存项目
     * @return string
     */
    public function saveProject(Request $request)
    {
        //验证字段
        $credentials = $this->validate($request,[
            'project_name' => 'required|unique:projects|max:50',
            'email' => 'required|email|max:20',
            'phone' => 'nullable|numeric|max:13',
            'company' => 'nullable|numeric|max:50',
            'copyright' => 'nullable|numeric|max:30',
            'description' => 'nullable|max:255',
        ]);

        $username = Cookie::get('username');
        $project_name = $_POST['project_name'];
        $num = Project::where('project_name', '=', $project_name)->count();
        $num = $num ? $num : 0 ;
//        return $project;
        if ($num == 0) {
            $sign = $_POST['sign'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $company = $_POST['company'];
            $copyright = $_POST['copyright'];
            $description = $_POST['description'];
            $project = Project::create(
                [
                    'project_name' => $project_name,
                    'company_email' => $email,
                    'company_name' => $company,
                    'company_phone' => $phone,
                    'copyright' => $copyright,
                    'description' => $description,
                    'doc_num' => $num,
                    'username' => $username,
                    'sign' => $sign
                ]
            );
            $projects = Project::where('username', '=', $username)
                ->orderBy('updated_at', 'desc')
                ->get()
            ;

            //上传封面
            $file = $request->file('upload');
            echo "fengmian ";
            dd($file);
            exit;
            $fileSize = $file->getSize();
            if ($fileSize)
            {
                if ($file->isValid())
                {
                    $fileName = $file->getClientOriginalName();
                    $ext = $file->getClientOriginalExtension();
                    $imageArray = ['png','jpg','jpeg'];

                    if (in_array("$ext",$imageArray))
                    {
                        //如果为图片，则放到images文件夹
                        $filePath = $file->store('/public/public/images');
                    }
                    else
                    {
                        $request->session()->flash('warning','文件格式不正确！');
                        return redirect()->back();
                    }

                    $fileURL =  asset('storage/'.substr($filePath,7));

                    $fileURL = 'http'.substr($fileURL,5);

                    $datas = File::create([
                        'local_path' => $filePath,
                        'file_name' => $fileName,
                        'file_size' => $fileSize,
                        'file_type' => 0,
                        'username' => Cookie::get('username'),
                        'file_url'=> $fileURL,
                    ]);

                    if ($request->has('project_name'))
                    {
                        $datas->prject_name = $request->get('project_name');
                        $datas->save();
                    }
                    $request->session()->flash('success','上传成功！');
                }
                return redirect()->back();
            }

            return $projects;
        }
        else
        {
            return 'false';
        }


    }

    //项目展示
    public function seeProject(Request $request)
    {
        $project_name = $request->project_name;
        $project_num = Doc::where('project_name','=',$project_name)->count();
        Project::where('project_name','=',$project_name)
            ->update([
                'doc_num' => $project_num
            ]);
        $project = Project::where('project_name', '=', $project_name)->get();
        return view('doc.seeProject', ['project' => $project]);
    }

    //编辑项目
    public function editProject(Request $request)
    {
        $id = $request->id;
        $project = Project::where('id','=',$id)
            ->get();
        return $project;
    }

    //编辑项目后保存
    public function editProjectSave(Request $request)
    {
        //验证字段
        $credentials = $this->validate($request,[
            'project_name' => 'required|unique:projects|max:50',
            'email' => 'required|email|max:20',
            'phone' => 'nullable|numeric|max:13',
            'company' => 'nullable|numeric|max:50',
            'copyright' => 'nullable|numeric|max:30',
            'project_description' => 'nullable|max:255',
        ]);

        $id = $request->id;
        $email = $request->email;
        $company = $request->company;
        $phone = $request->phone;
        $copyright = $request->copyright;
        $project_name = $request->project_name;
        $project_description = $request->project_description;
        $radio = $request->radio;
        $num = Project::where('id','=',$id)
            ->update([
                'project_name' => $project_name,
                'company_email' => $email,
                'company_name' => $company,
                'company_phone' => $phone,
                'copyright' => $copyright,
                'description' => $project_description,
                'sign' => $radio
            ]);
        return $num;
    }

    //删除项目
    public function dropProject(Request $request)
    {
        $id = $request->id;
        $project = Project::where('id','=',$id)->first();
        $projectName = $project->project_name;


        $docs = Doc::where('project_name','=',$projectName)->get();

        $count = Doc::where('project_name','=',$projectName)->count();
        for ($i=0;$i<$count;$i++)
        {
            $doc = $docs[$i];
            $path = $doc->doc_url;
            $sign = $doc->sign;
            if ($sign)
            {
                $path = strstr($path,'private');
            }
            else
            {
                $path = strstr($path,'public');
            }
            $path = 'public/'.$path;
            $doc->delete();
            Storage::delete($path);
        }
        $project->delete();
    }

}