<?php

namespace App\Http\Controllers\admin;

use App\model\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

/**
 * Class PhotoController
 * @package App\Http\Controllers\admin
 * 郭俊秀
 * PhotoController用来进行对附件的相关操作，操作：上传、查看、删除
 */
class PhotoController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->isMethod('POST'))
        {
//            var_dump($_FILES);
//            exit;
            $photo = $request->file('file');

            if ($photo->isValid())
            {
                $ext = $photo->getClientOriginalExtension();
                $type = $photo->getClientMimeType();
                $realPath = $photo->getRealPath();
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
                        Photo::create([
                            'photo_name'=>$filename,
                            'username_name'=>Cookie::get('username'),
                            'prject_name'=>$request->get('projectName')
                        ]);
                    }
                    else
                    {
                        Photo::create([
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

                    Photo::create([
                        'photo_name'=>$filename,
                        'username_name'=>Cookie::get('username'),
                        'prject_name'=>$request->get('projectName')
                    ]);
                }
            }
            return redirect()->back();
        }
        else
        {
            return view('upload');
        }
    }

    public function delete(Request $request)
    {
        echo 1;
        if ($request->isMethod('POST'))
        {
            $photoId = $request->get('pid');

        }
    }
}
