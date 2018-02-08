<?php

namespace App\Http\Controllers\admin;

use App\model\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use function Symfony\Component\HttpKernel\Tests\controller_func;

/**
 * Class FileListController
 * @package App\Http\Controllers\admin
 * 郭俊秀
 * FileListController用来进行对附件的相关操作，操作：上传、修改、删除
 */
class FileListController extends Controller
{
    //删除附件
    public function adminDelete($id,Request $request)
    {
        $datas = File::find($id);
        $filePath = $datas->local_path;

        $bool = $datas->delete();
        Storage::delete($filePath);
        if ($bool)
        {
            $request->session()->flash('success','删除成功！');
        }
        else
        {
            $request->session()->flash('warning','删除失败！');
        }
        File::deleted($filePath);
        return redirect()->back();
    }

    //显示附件详情
    public function adminEdit($id,Request $request)
    {
        //字段范围检测，不能有不在范围的字段
        $this->validate($request,[
            'description' => 'nullable|max:255',
        ]);

        $datas = File::find($id);
        $datas->description = $request->get('description');
        $datas->save();

        $request->session()->flash('success','修改成功！');
        return redirect()->back();
    }


    //admin上传附件
    public function adminUpload(Request $request)
    {
        $file = $request->file('file');
        if ($file == null)
        {
            $request->session()->flash('warning','请选择附件！');
            return redirect()->back();
        }

        $size = $file->getSize();
        if ($size == null)
        {
            $request->session()->flash('warning','该文件为空文件,请重新选择！');
            return redirect()->back();
        }
        for ($sizeLength=0;$size>1024;$sizeLength++)
        {
            $size = $size/1024;
        }
        switch ($sizeLength)
        {
            case 0:
                $unit='B';
                break;
            case 1:
                $unit='KB';
                break;
            case 2:
                $unit='MB';
                break;
            default:
                $request->session()->flash('warning','文件太大！');
                return redirect()->back();
        }
        $size = round($size,2);     //保留两位小数点
        $fileSize = $size.$unit;

        if ($file->isValid())
        {
            $fileName = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            $imageArray = ['png','jpg','jpeg'];
            $textArray = ['html','docx'];

            $type = $request->get('type');
            $fileType = 1;
            if ($type == 'public')
            {
                $fileType = 1;
                if (in_array("$ext",$imageArray))
                {
                    //如果为图片，则放到images文件夹
                    $filePath = $file->store('/public/public/images');
                }
                elseif (in_array("$ext",$textArray))
                {
                    //如果为文档，则放到text文件夹
                    $filePath = $file->store('/public/public/text');
                }
                else
                {
                    $request->session()->flash('warning','文件格式不正确！');
                    return redirect()->back();
                }
            }
            elseif ($type == 'private')
            {
                $fileType = 0;
                if (in_array("$ext",$imageArray))
                {
                    $filePath = $file->store('/public/private/images');
                }
                elseif (in_array("$ext",$textArray))
                {
                    $filePath = $file->store('/public/private/text');
                }
                else
                {
                    $request->session()->flash('warning','文件格式不正确！');
                    return redirect()->back();
                }
            }

           $fileURL =  asset('storage/'.substr($filePath,7));

            $datas = File::create([
                'local_path' => $filePath,
                'file_name' => $fileName,
                'file_size' => $fileSize,
                'file_type' => $fileType,
                'username' => Cookie::get('username'),
            ]);

            if ($fileType == 1 )
            {
                //项目public，使用http协议
                $fileURL = 'http'.substr($fileURL,5);
            }

            $datas->file_url = $fileURL;
            $datas->save();

            if ($request->has('projectName'))
            {
                $datas->prject_name = $request->get('projectName');
                $datas->save();
            }
            $request->session()->flash('success','上传成功！');
        }
        return redirect()->back();
    }
}
