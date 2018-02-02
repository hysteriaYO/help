<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * 规定表名、主键
     * 维护时间戳
     * 郭俊秀
     * @var string
     */
    protected $table = 'projects';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * 以下字段可插入
     * @var array
     */
    protected $fillable = [
        'project_name',
        'doc_num',
        'username'
    ];
}
