<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 创建文章表
         */

        Schema::create('docs', function (Blueprint $table) {
            $table->increments('doid');                      //唯一id
            $table->string('title','40');           //文章题目
            $table->string('project_name','40');   //项目名称
            $table->string('doc_url','13');        //文章路径
            $table->string('username','14');        //作者
            $table->string('tag','40');             //标签
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
