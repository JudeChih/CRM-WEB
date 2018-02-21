<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebProblemCategory extends Model {

    /**
     * 資料表名稱
     * @var string
     */
    protected $table = 'WebProblemCategory';

    /**
     * 主鍵值
     * @var string
     */
    protected $primaryKey = 'problem_id';

    /**
     * 是否自動遞增
     * @var string
     */
    public $incrementing = true;

    /**
     * 是否自動插入現在時間
     *
     * @var bool
     */
    public $timestamps = false;

//    /**
//     * 可異動的資料欄位
//     * @var type 
//     */
//    protected $fillable = [
//        'problem_name', 'problem_description', 'problem_parent',
//        'isflag', 'create_date', 'last_update_date', 'create_user', 'last_update_user',
//    ];
//
    /**
     * 不可異動的值
     * @var type 
     */
    protected $guarded = ['problem_id'];

}
