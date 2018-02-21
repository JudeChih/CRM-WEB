<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebProductGroup extends Model {

    /**
     * 資料表名稱
     * @var string
     */
    protected $table = 'WebProductGroup';

    /**
     * 主鍵值
     * @var string
     */
    protected $primaryKey = 'pg_id';

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

    /**
     * 可異動的資料欄位
     * @var type 
     */
//    protected $fillable = [
//        'pg_name', 'pg_type',
//        'isflag', 'create_date', 'last_update_date', 'create_user', 'last_update_user',
//    ];

    /**
     * 不可異動的值
     * @var type 
     */
    //protected $guarded = ['pg_id'];
    /**
     * 對應產品資料
     * @return type
     */
    public function WebProductData() {
        return $this->hasMany('App\Models\WebProductData', 'pg_id');
    }

}
