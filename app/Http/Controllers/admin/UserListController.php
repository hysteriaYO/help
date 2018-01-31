<?php

namespace App\Http\Controllers\admin;

use App\model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserListController extends Controller
{
    public function userDelete(User $user)
    {
        User::detele($user);
        $datas = User::all();
        return view('admin.userlist',['datas'=>$datas]);
    }
}
