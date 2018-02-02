<?php

namespace App\Http\Controllers\admin;

use App\model\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

/**
 * Class FileListController
 * @package App\Http\Controllers\admin
 * 郭俊秀
 * PhotoController用来进行对附件的相关操作，操作：上传、查看、删除
 */
class FileListController extends Controller
{
    //删除附件
    public function adminDelete($id,Request $request)
    {
        $datas = File::find($id);
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

    //显示附件详情
    public function adminShow()
    {
        echo 'adminShow';
    }

    //admin上传附件
    public function adminUpload(Request $request)
    {
        $file = $request->file('file');

        if ($file->isValid())
        {
            $ext = $file->getClientOriginalExtension();
            $type = $file->getClientMimeType();
            $realPath = $file->getRealPath();
            //echo $type;
            //exit;
            $imageArray = ['png','jpg','jpeg'];
            $textArray = ['html','md'];

            if (in_array("$ext",$imageArray))
            {
                //如果为图片，则放到images文件夹
                $filename = uniqid().'.'.$ext;
                $bool = Storage::disk('images')->put($filename,file_get_contents($realPath));
                //图片上传成功
                //如果是项目封面
                if ($request->has('projectName'))
                {
                    File::create([
                        'photo_name'=>$filename,
                        'username_name'=>Cookie::get('username'),
                        'prject_name'=>$request->get('projectName')
                    ]);
                }
                else
                {
                    File::create([
                        'photo_name'=>$filename,
                        'username_name'=>Cookie::get('username')
                    ]);
                }
            }
            elseif (in_array("$ext",$textArray))
            {
                //如果为文档，则放到text文件夹
                $filename = uniqid().'.'.$ext;
                $bool = Storage::disk('texts')->put($filename,file_get_contents($realPath));

                File::create([
                    'photo_name'=>$filename,
                    'username_name'=>Cookie::get('username'),
                    'prject_name'=>$request->get('projectName')
                ]);
            }
        }
        return redirect()->back();
    }

//    public function upload(Request $request)
//    {
//        if ($request->isMethod('POST'))
//        {
////            var_dump($_FILES);
////            exit;
//            $file = $request->file('file');
//
//            if ($file->isValid())
//            {
//                $ext = $file->getClientOriginalExtension();
//                $type = $file->getClientMimeType();
//                $realPath = $file->getRealPath();
//                //echo $type;
//                //exit;
//                $imageArray = ['png','jpg','jpeg'];
//                $textArray = ['html','md'];
//
//                if (in_array("$ext",$imageArray))
//                {
//                    //如果为图片，则放到images文件夹
//                    $filename = uniqid().'.'.$ext;
//                    $bool = Storage::disk('images')->put($filename,file_get_contents($realPath));
//                    //图片上传成功
//                    //如果是项目封面
//                    if ($request->has('projectName'))
//                    {
//                        File::create([
//                            'photo_name'=>$filename,
//                            'username_name'=>Cookie::get('username'),
//                            'prject_name'=>$request->get('projectName')
//                        ]);
//                    }
//                    else
//                    {
//                        File::create([
//                            'photo_name'=>$filename,
//                            'username_name'=>Cookie::get('username')
//                        ]);
//                    }
//                }
//                elseif (in_array("$ext",$textArray))
//                {
//                    //如果为文档，则放到text文件夹
//                    $filename = uniqid().'.'.$ext;
//                    $bool = Storage::disk('texts')->put($filename,file_get_contents($realPath));
//
//                    File::create([
//                        'photo_name'=>$filename,
//                        'username_name'=>Cookie::get('username'),
//                        'prject_name'=>$request->get('projectName')
//                    ]);
//                }
//            }
//            return redirect()->back();
//        }
//        else
//        {
//            return view('upload');
//        }
//    }

}
