<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * 规定表名、主键
     * 维护时间戳
     * 郭俊秀
     * @var string
     */
    protected $table = 'photos';
    protected $primaryKey = 'pid';
    public $timestamps = true;

    protected function getDateFormat()
    {
        return time();
    }

    protected function asDateTime($value)
    {
        return $value;
    }

    /**
     * 以下字段可插入
     * @var array
     */
    protected $fillable = [
        'photo_name',
        'project_name'
    ];
}
