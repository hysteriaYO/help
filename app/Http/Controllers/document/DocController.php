<?php
/**
 * Created by PhpStorm.
 * User: CoooooL
 * Date: 2018/1/23
 * Time: 9:17
 */
namespace App\Http\Controllers;

use App\Doc;
use App\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class DocController extends Controller
{
    public function test()
    {
//        $bool = DB::table('docs')->insert([
//            ['title' => '星期三日记1','project_name' => '日记1' , 'doc_url' => '1231','username'=>'zhangsan1','tag'=>'hack1'],
//            ['title' => '星期三日记2','project_name' => '日记2' , 'doc_url' => '1232','username'=>'zhangsan2','tag'=>'hack2'],
//            ['title' => '星期三日记3','project_name' => '日记3' , 'doc_url' => '1233','username'=>'zhangsan3','tag'=>'hack3'],
//            ['title' => '星期三日记3','project_name' => '日记4' , 'doc_url' => '1234','username'=>'zhangsan4','tag'=>'hack4'],
//            ['title' => '星期三日记4','project_name' => '日记5' , 'doc_url' => '1235','username'=>'zhangsan5','tag'=>'hack5'],
//        ]);
        $doc = Doc::create(array(
            'title' => '星期三日记1','project_name' => '日记1' , 'doc_url' => '1231','username'=>'','tag'=>'hack1'
        )
            );
        $doc = Doc::create([
                'title' => '星期三日记2','project_name' => '日记2' , 'doc_url' => '1232','username'=>'','tag'=>'hack2'
            ]
        );
        dd($doc);
    }

    public function base()
    {
        return view('base');
    }

    public function basic()
    {
        return view('basic');
    }

    public function home()
    {
        $posts = Doc::all();
//        dd($posts);
        return view('doc.home',['posts' => $posts]);
    }

    public function myDoc(Request $request)
    {
//        $username = $_GET("username");
//        $username = input::get('username');
        $username = $request->project_name;
//        $username = $request->URL('username');
        $docs = Doc::where('project_name','=',$username)->get();
        $docs = $docs ? $docs : '';
//        dd($docs);
//        dd($username);
        return view('doc.myDoc',['docs' => $docs]);
    }

    public function seeDoc(Request $request)
    {
//        $username = $_GET['username'];
        $doc = Doc::where('doid','=',$request->doid)->first();
        $doc = $doc ? $doc : '';
        return $doc;
    }

}

