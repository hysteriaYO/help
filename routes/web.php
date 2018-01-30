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

//Route::any('upload','admin\PhotoController@showPhotoForm');        //图片上传

//Route::any('usergroup','admin\DashboardController@show');        //用户管理


Route::group(['middleware' => ['web']],function(){

    //主页
    Route::get('/', 'HomeController@index')->name('home');

    //下拉菜单
    Route::get('person', 'HomeController@showPersonSpace')->name('users.person');  //显示用户空间
    Route::get('project', 'HomeController@showMyProject')->name('users.project');  //显示用户项目
    Route::get('center','HomeController@showCenterForm')->name('center');   //后台管理
    Route::get('/home', 'users\UsersController@logout')->name('users.logOut'); //用户退出

    //用户
    Route::get('login', 'HomeController@showLoginForm')->name('login');  //用户登录
    Route::post('login', 'users\UsersController@login');
    Route::get('create', 'HomeController@showCreateForm')->name('create'); //用户注册
    Route::post('create', 'users\UsersController@create');

    //admin后台管理
    Route::get('dashboard','HomeController@showBoardForm')->name('dashboard');  //仪表盘
    Route::get('photo','HomeController@showPhotoForm')->name('photo');          //附件列表
    Route::get('userlist','HomeController@showUserList')->name('userlist');     //用户列表
    Route::get('projectlist','HomeController@showProjectList')->name('projectlist');    //项目列表

    //附件管理
    Route::post('photo','admin\PhotoController@delete')->name('photodelete');  //删除附件
});
