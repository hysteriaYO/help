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

//主页
Route::get('/', 'HomeController@index')->name('home');

//下拉菜单
Route::get('person', ['uses' => 'HomeController@showPersonSpace'])->name('user.show');  //显示用户空间
Route::get('project', ['uses' => 'HomeController@showMyProject'])->name('users.project');  //显示用户项目
Route::get('home', ['uses' => 'users\UsersController@logout'])->name('user.logOut'); //用户退出

//用户
Route::get('login', ['uses' => 'HomeController@showLoginForm'])->name('login');  //用户登录
Route::post('login', ['uses' => 'users\UsersController@login']);
Route::get('create', ['uses' => 'HomeController@showCreateForm'])->name('create'); //用户注册
Route::get('forget', ['uses' => 'HomeController@showForgetForm'])->name('forget'); //用户忘记密码

//我的项目  相关操作
Route::post('homeSearch', 'document\ProjectController@homeSearch');                                     //主页的搜索   匹配关键字相关的项目
Route::get('myProject', 'document\ProjectController@myProject');                                        //主页的项目展示
Route::post('verifyProjectName','document\ProjectController@verifyProjectName');                        //验证项目名的唯一性
Route::post('saveProject', 'document\ProjectController@saveProject');                                   //保存项目信息
Route::get('seeProject', 'document\ProjectController@seeProject');                                      //查看单个项目信息
Route::any('editProject','document\ProjectController@editProject');                                     //编辑项目信息
Route::post('editProjectSave','document\ProjectController@editProjectSave');                            //编辑项目后保存
Route::post('dropProject','document\ProjectController@dropProject');                                    //删除项目

//我的文档  相关操作
Route::get('myDoc', 'document\DocController@myDoc');                                                    //单个项目下的所有文档
Route::get('project_name={project_name}', ['uses' => 'document\DocController@myPrivateDoc','https'])->name('myPrivateDoc');      //单个项目下的所有private文档
Route::get('seeDoc', 'document\DocController@seeDoc');                                                  //查看单个文档的详细信息
Route::post('addDocName','document\DocController@addDocName');                                          //添加文档名在左边列表显示
Route::post('searchDoc', 'document\DocController@searchDoc');                                           //搜索文档  通过关键字匹配相关文档
Route::post('verifyDocName','document\DocController@verifyDocName');                                    //验证文档名的唯一性
Route::post('addDocInfo','document\DocController@addDocInfo');                                          //保存文档的相关信息
Route::post('addDocSave','document\DocController@addDocSave');                                          //保存文档的内容
Route::post('editDoc','document\DocController@editDoc');                                                //编辑文档内容
Route::post('docEditSave','document\DocController@docEditSave');                                        //编辑文档后保存
Route::post('dropDoc','document\DocController@dropDoc');                                                //删除文档


Route::group(['https'], function () {

    //下拉菜单
    Route::get('center',['uses' =>  'HomeController@showCenterForm'])->name('center');   //后台管理

    //用户
    Route::post('create', ['uses' => 'users\UsersController@create']);              //用户注册
    Route::post('forget', ['uses' => 'users\UsersController@forget']);              //用户忘记密码
    Route::get('updatePassword', ['uses' => 'HomeController@showUpdatePassword'])->name('user.password');         //显示修改密码页
    Route::post('updatePassword', ['uses' => 'users\UsersController@update']);          //修改密码
    Route::post('person', ['uses' => 'users\UsersController@edit']);         //编辑用户信息

    //admin后台管理
    Route::get('dashboard', ['uses' => 'HomeController@showBoardForm'])->name('dashboard');  //仪表盘

    Route::get('fileList', ['uses' => 'HomeController@showPhotoForm'])->name('fileList');          //附件列表
    Route::get('fileId={id}',['uses' => 'HomeController@showFileEdit']);                        //admin查看附件详情
    Route::post('fileId={id}',['uses' => 'admin\fileListController@adminEdit']);
    Route::post('deleteFile={id}', ['uses' => 'admin\fileListController@adminDelete']);             //admin删除附件
    Route::get('uploadFile',['uses' => 'HomeController@showFileUpload']);                       //admin上传附件
    Route::post('uploadFile',['uses' => 'admin\fileListController@adminUpload']);

    Route::get('userList', ['uses' => 'HomeController@showUserList'])->name('userList');     //用户列表
    Route::get('userId={id}', ['uses' => 'HomeController@showUserEdit']);                     //admin修改用户信息页面
    Route::post('userId={id}', ['uses' => 'admin\UserListController@adminEdit']);
    Route::post('deleteUser={id}', ['uses' => 'admin\UserListController@adminDelete']);
    Route::get('createUser',['uses' => 'HomeController@showUserCreate']);                       //admin创建用户
    Route::post('createUser',['uses' => 'admin\UserListController@adminCreate']);

    Route::get('projectList', ['uses' => 'HomeController@showProjectList'])->name('projectList');    //项目列表
    Route::get('projectId={id}', ['uses' => 'HomeController@showProjectEdit']);                     //admin修改项目信息页面
    Route::post('projectId={id}', ['uses' => 'admin\ProjectListController@adminEdit']);
    Route::post('deleteProject={id}', ['uses' => 'admin\ProjectListController@adminDelete']);       //admin删除项目
    Route::get('createProject',['uses' => 'HomeController@showProjectCreate']);                     //admin创建项目
    Route::post('createProject',['uses' => 'admin\ProjectListController@adminCreate']);

});
