<?php

namespace App\Http\Controllers\admin;

use App\model\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            //var_dump($_FILES);
            $photo = $request->file('photo');

            if ($photo->isValid())
            {
                $ext = $photo->getClientOriginalExtension();
                $type = $photo->getClientMimeType();
                $realPath = $photo->getRealPath();
                echo $type;
                if ($ext =='jpg'|| $ext =='png'||$ext =='jpeg')
                {
                    $filename = uniqid().'.'.$ext;
                    $bool = Storage::disk('uploads')->put($filename,file_get_contents($realPath));
                    //图片上传成功
                    var_dump($bool);
                    exit;
                    Photo::create(
                        ['photo_name'=>$filename]
                    );
                }else
                {
                    echo '只允许上传jpg/png/jpeg格式的图片';
                }
            }
        }
    }

    public function delete(Request $request)
    {
        if ($request->isMethod('POST'))
        {
            $photoId = $request->get('pid');

        }
    }
}
