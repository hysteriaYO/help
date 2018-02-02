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

Route::any('upload','admin\FileController@upload');        //图片上传

Route::group(['middleware' => ['web']], function () {

    //主页
    Route::get('/', 'HomeController@index')->name('home');

    //下拉菜单
    Route::get('person', 'HomeController@showPersonSpace')->name('user.show');  //显示用户空间
    Route::get('project', 'HomeController@showMyProject')->name('users.project');  //显示用户项目
    Route::get('center', 'HomeController@showCenterForm')->name('center');   //后台管理
    Route::get('home', 'users\UsersController@logout')->name('user.logOut'); //用户退出

    //用户
    Route::get('login', 'HomeController@showLoginForm')->name('login');  //用户登录
    Route::post('login', 'users\UsersController@login');
    Route::get('create', 'HomeController@showCreateForm')->name('create'); //用户注册
    Route::post('create', 'users\UsersController@create');
    Route::get('updatePassword', 'HomeController@showUpdatePassword')->name('user.password');         //显示修改密码页
    Route::post('person', 'users\UsersController@edit');         //编辑用户信息
    Route::post('updatePassword', 'users\UsersController@update');          //修改密码

    //admin后台管理
    Route::get('dashboard', 'HomeController@showBoardForm')->name('dashboard');  //仪表盘

    Route::get('fileList', 'HomeController@showPhotoForm')->name('fileList');          //附件列表
    Route::post('deleteFile={id}', 'admin\fileListController@adminDelete');             //admin删除附件

    Route::get('userList', 'HomeController@showUserList')->name('userList');     //用户列表
    Route::get('userId={id}', 'HomeController@showUserEdit');                     //admin修改用户信息页面
    Route::post('userId={id}', 'admin\UserListController@adminEdit');
    Route::post('deleteUser={id}', 'admin\UserListController@adminDelete');
    Route::get('createUser','HomeController@showUserCreate');                       //admin创建用户
    Route::post('createUser','admin\UserListController@adminCreate');

    Route::get('projectList', 'HomeController@showProjectList')->name('projectList');    //项目列表
    Route::get('projectId={id}', 'HomeController@showProjectEdit');                     //admin修改项目信息页面
    Route::post('projectId={id}', 'admin\ProjectListController@adminEdit');
    Route::post('deleteProject={id}', 'admin\ProjectListController@adminDelete');
    Route::get('createProject','HomeController@showProjectCreate');                     //admin创建项目
    Route::post('createProject','admin\ProjectListController@adminCreate');





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
