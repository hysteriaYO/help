<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 创建项目表
         */

        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');                            //唯一ID
            $table->string('project_name','40');      //项目名称
            $table->string('abstract','40');         //项目摘要
            $table->integer('doc_num');                         //文档数量
            $table->string('username','14');           //创建者
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
        Schema::dropIfExists('posts');
    }
}
