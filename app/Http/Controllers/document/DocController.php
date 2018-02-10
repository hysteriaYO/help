<?php
/**    唐利华
 * Created by PhpStorm.
 * User: CoooooL
 * Date: 2018/1/23
 * Time: 9:17
 */

namespace App\Http\Controllers\document;

use App\model\Doc;
use App\Http\Controllers\Controller;
use App\model\Project;
use Faker\Provider\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use League\HTMLToMarkdown\HtmlConverter;

class DocController extends Controller
{
    //单个项目的所有文档
    public function myDoc(Request $request)
    {
        $project_name = $request->project_name;
        $project = Project::where('project_name','=',$project_name)->first();

        $sign = $project->sign;
        $docs = Doc::where('project_name', '=', $project_name)->get();

        if ($sign)
        {
            return redirect()->route('myPrivateDoc',['project_name'=>$project_name]);
        }
        else
        {
            return view('doc.myDoc', ['docs' => $docs,'project' => $project]);
        }

    }

    public function myPrivateDoc($project_name,Request $request)
    {
        $project_name = $request->project_name;
        $project = Project::where('project_name','=',$project_name)->first();
        $docs = Doc::where('project_name', '=', $project_name)->get();
        return view('doc.myDoc', ['docs' => $docs,'project' => $project]);
    }

    //验证文档名是否唯一
    public function verifyDocName(Request $request)
    {
        $title = $request->title;
        $num = Doc::where('title','=',$title)->count();
        return $num;
    }


    //保存文档的基本信息
    public function addDocInfo(Request $request)
    {
        $title = $request->title;
        if(!$title)
        {
            return false;
        }
        $num = Doc::where('title','=',$title)->count();
        if( $num > 0 )
        {
            return 'false';
        }
        else
        {   $radio = $request->radio;

            if($radio == 0)
            {
                //public
                $fileName = uniqid();
                $fileName = hash('sha256',$fileName);
                $fileName = substr($fileName,10,40);
                $file = fopen("storage/public/doc/$fileName","w");
                $txt = "创建文件时的默认文本";
                fwrite($file,$txt);
                fclose($file);

                $fileURL =  asset("storage/public/doc/$fileName");
            }

            else
            {
                //私有文件
                $fileName = uniqid();
                $fileName = hash('sha256',$fileName);
                $fileName = substr($fileName,10,40);
                $file = fopen("storage/private/doc/$fileName","w");
                $txt = "创建文件时的默认文本";
                fwrite($file,$txt);
                fclose($file);

                $fileURL =  asset("storage/private/doc/$fileName");
//                $path = Storage::disk('private')->put($title,'');

            }

            $project_name = $request->project_name;
            $doc = Doc::create([
                'title' => $title,
                'project_name' => $project_name,
                'sign' => $radio,
                'doc_url' => $fileURL,
            ]);
            return $doc;
        }
    }

    /**保存文档内容
     * @param Request $request
     */
    public function addDocSave(Request $request)
    {
        $radio = $request->radio;
        $title = $request->title;
        $content = $request->content;
        if($radio == 0)
        {
            //保存到共有文档
//            fclose($myfile);
//            $file = $request->file($title);
//            $file->fwrite($title,$content);
            $myfile = fopen($title, "w") or die("Unable to open file!");
            fwrite($myfile,' ');                                      //清空文档内容
            Storage::disk('public')->put($title,$content);                //重写文档内容
            $path = str_replace('\\','/',storage_path('app\public\public\\'.$title));
            $num = Doc::where('title','=',$title)
                ->update([
                    'doc_url' => $path ,
                    'sign' => 0
                ])
            ;
//            echo $path;
        }
        else
        {
            //保存到私有文档
            $myfile = fopen($title, "w") or die("Unable to open file!");
            fwrite($myfile,' ');
            Storage::disk('private')->put($title,$content);
            $path = str_replace('\\','/',storage_path('app\public\private\\'.$title));
            $num = Doc::where('title','=',$title)
                ->update([
                    'doc_url' => $path,
                    'sign' => 1
                ])
            ;
//            echo $num;
        }
//        return $title;
    }

    //编辑文档   通过路径获取数据展示到页面
    public function editDoc(Request $request)
    {
        $converter = new HtmlConverter();

        $title = $request->title;
        $file = Doc::where('title','=',$title)->first();
        $path = $file->doc_url;
        $sign = $file->sign;
        if($sign)
        {
            $localPath = strstr($path,'private');
        }
        else{
            $localPath = strstr($path,'public');

        }

        $file = fopen("storage/$localPath",'r');
        $fileContent = fread($file,filesize("storage/$localPath"));


//        dd($title);
//        exit;
        //$content = file_get_contents(str_replace('\\','',$path[0]));
        $content = $converter->convert($fileContent);
//        $content = file_get_contents(str_replace('\\','/',storage_path('app\private\document\\'.$title)));
//        dd($content);
//        exit;
        return $content;
    }

    //编辑文档后重新保存
    public function docEditSave(Request $request)
    {

        $title = $request->title;
        $content = $request->content;
        $doc = Doc::where('title','=',$title)
            ->first();
        $sign = $doc->sign;
        $path = $doc->doc_url;
        if($sign)
        {
            $path = strstr($path,'private');
//            $path = str_replace('/','\\',$path);
        }
        else
        {
            $path = strstr($path,'public');
//            $path = str_replace('/','\\',$path);
        }
        $file = fopen("storage/$path",'w');
//        var_dump($path);
//        exit;
        fwrite($file,$content);
        fclose($file);

//        $bool = stripos($path,'public');
//        if($bool)
//        {
//            $myfile = fopen($title, "w") or die("Unable to open file!");
//            fwrite($myfile,' ');
//
//            $txt = "创建文件时的默认文本";
//            fwrite($file,$txt);
//            fclose($file);
//
//            Storage::disk('public')->put($title,$content);
//        }
//        else
//        {
//            $myfile = fopen($title, "w") or die("Unable to open file!");
//            fwrite($myfile,' ');
//            Storage::disk('private')->put($title,$content);
//        }



    }

    //删除文档
    public function dropDoc(Request $request)
    {
        $title = $request->title;
        $doc = Doc::where('title','=',$title)->first();
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


    //查看文档
    public function seeDoc(Request $request)
    {
        $doid = $request->doid;
        $doc = Doc::where('doid', '=', $doid)->first();
        $path = $doc->doc_url;
        $localPath = strstr($path,'public');
        $file = fopen("storage/$localPath",'r');
        $fileContent = fread($file,filesize("storage/$localPath"));
        return view('doc.seeDoc',[
            'doc' => $doc,
            'content' => $fileContent
        ]);
    }

    //搜索文档
    public function searchDoc(Request $request)
    {
        $project_name = $request->project_name;
        $key = $request->key;
        $docs = Doc::where('project_name','=',$project_name)
            ->where('title', 'like', '%' . $key . '%')
            ->get();
        $docs = $docs ? $docs : '';
        return $docs;
    }

    //添加文档名在左边列表显示
    public function addDocName(Request $request)
    {
        $project_name = $request->project_name;
        $docs = Doc::where('project_name','=',$project_name)
            ->get();
        return $docs;
    }



}

