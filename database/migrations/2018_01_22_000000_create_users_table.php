<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 创建用户表
         */

        Schema::create('users', function (Blueprint $table) {
            $table->increments('uid');                        //唯一id
            $table->string('username','14');        //用户名
            $table->string('password','60');        //密码
            $table->string('email','40');           //邮箱
            $table->string('phone','40');            //电话
            $table->string('description','255');            //描述
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
