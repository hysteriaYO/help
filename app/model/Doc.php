<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    /**
     * 规定表名、主键
     * 维护时间戳
     * @var string
     */
    protected $table = 'docs';
    protected $primaryKey = 'doid';
    public $timestamps = true;

//    protected function getDateFormat()
//    {
//        return time();
//    }
//    protected function asDateTime($value)
//    {
//        return $value;
    /**
     * 以下字段可插入
     * @var array
     */
    protected $fillable = [
        'project_name',
        'title',
        'doc_url',
        'username',
        'tag',  //未使用
        'sign'
    ];

//    }


}
