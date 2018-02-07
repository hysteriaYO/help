<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['web']], function () {

    //主页
    Route::get('/', 'HomeController@index')->name('home');

    //下拉菜单
    Route::get('person', ['uses' => 'HomeController@showPersonSpace','https'])->name('user.show');  //显示用户空间
    Route::get('project', ['uses' => 'HomeController@showMyProject','https'])->name('users.project');  //显示用户项目
    Route::get('center',['uses' =>  'HomeController@showCenterForm','https'])->name('center');   //后台管理
    Route::get('home', ['uses' => 'users\UsersController@logout','https'])->name('user.logOut'); //用户退出

    //用户
    Route::get('login', ['uses' => 'HomeController@showLoginForm','https'])->name('login');  //用户登录
    Route::post('login', ['uses' => 'users\UsersController@login','https']);
    Route::get('create', ['uses' => 'HomeController@showCreateForm','https'])->name('create'); //用户注册
    Route::post('create', ['uses' => 'users\UsersController@create','https']);
    Route::get('forget', ['uses' => 'HomeController@showForgetForm','https'])->name('forget'); //用户忘记密码
    Route::post('forget', ['uses' => 'users\UsersController@forget','https']);
    Route::get('updatePassword', ['uses' => 'HomeController@showUpdatePassword','https'])->name('user.password');         //显示修改密码页
    Route::post('person', ['uses' => 'users\UsersController@edit','https']);         //编辑用户信息
    Route::post('updatePassword', ['uses' => 'users\UsersController@update','https']);          //修改密码

    //admin后台管理
    Route::get('dashboard', ['uses' => 'HomeController@showBoardForm','https'])->name('dashboard');  //仪表盘

    Route::get('fileList', ['uses' => 'HomeController@showPhotoForm','https'])->name('fileList');          //附件列表
    Route::get('fileId={id}',['uses' => 'HomeController@showFileEdit','https']);                        //admin查看附件详情
    Route::post('fileId={id}',['uses' => 'admin\fileListController@adminEdit','https']);
    Route::post('deleteFile={id}', ['uses' => 'admin\fileListController@adminDelete','https']);             //admin删除附件
    Route::get('uploadFile',['uses' => 'HomeController@showFileUpload','https']);                       //admin上传附件
    Route::post('uploadFile',['uses' => 'admin\fileListController@adminUpload','https']);

    Route::get('userList', ['uses' => 'HomeController@showUserList','https'])->name('userList');     //用户列表
    Route::get('userId={id}', ['uses' => 'HomeController@showUserEdit','https']);                     //admin修改用户信息页面
    Route::post('userId={id}', ['uses' => 'admin\UserListController@adminEdit','https']);
    Route::post('deleteUser={id}', ['uses' => 'admin\UserListController@adminDelete','https']);
    Route::get('createUser',['uses' => 'HomeController@showUserCreate','https']);                       //admin创建用户
    Route::post('createUser',['uses' => 'admin\UserListController@adminCreate','https']);

    Route::get('projectList', ['uses' => 'HomeController@showProjectList','https'])->name('projectList');    //项目列表
    Route::get('projectId={id}', ['uses' => 'HomeController@showProjectEdit','https']);                     //admin修改项目信息页面
    Route::post('projectId={id}', ['uses' => 'admin\ProjectListController@adminEdit','https']);
    Route::post('deleteProject={id}', ['uses' => 'admin\ProjectListController@adminDelete','https']);       //admin删除项目
    Route::get('createProject',['uses' => 'HomeController@showProjectCreate','https']);                     //admin创建项目
    Route::post('createProject',['uses' => 'admin\ProjectListController@adminCreate','https']);





    //模板页
    Route::get('base', 'DocController@base');
    Route::get('basic', 'DocController@basic');

    //主页
//    Route::get('/','ProjectController@home');


    //我的项目
    Route::get('insertToProject', 'document\ProjectController@insertToProject');
    Route::get('myProject', 'document\ProjectController@myProject');
    Route::get('saveProject', 'document\ProjectController@saveProject');
    Route::get('seeProject', 'document\ProjectController@seeProject');
    Route::get('homeSearch', 'document\ProjectController@homeSearch');


    //我的文档
    Route::get('insertToDoc', 'document\DocController@insertToDoc');
    Route::get('myDoc', 'document\DocController@myDoc');
    Route::get('seeDoc', 'document\DocController@seeDoc');
    Route::get('searchDoc', 'document\DocController@searchDoc');


    Route::get('project', function (){
        $projects = \App\model\Project::all();
        return view('users.project',['projects'=>$projects]);
    });

});
