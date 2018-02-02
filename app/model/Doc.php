<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    /**
     * 规定表名、主键
     * 维护时间戳
     * 郭俊秀
     * @var string
     */
    protected $table = 'docs';
    protected $primaryKey = 'doid';
    public $timestamps = true;

    /**
     * 以下字段可插入
     * @var array
     */
    protected $fillable = [
        'title',
        'project_name',
        'doc_url',
        'username',
        'tag'
    ];


}
