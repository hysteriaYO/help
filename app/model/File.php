<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * 规定表名、主键
     * 维护时间戳
     * 郭俊秀
     * @var string
     */
    protected $table = 'files';
    protected $primaryKey = 'pid';
    public $timestamps = true;

    /**
     * 以下字段可插入
     * @var array
     */
    protected $fillable = [
        'username',
        'file_url',
        'local_path',
        'file_name',
        'project_name',
        'file_size',
        'file_type',
    ];
}
