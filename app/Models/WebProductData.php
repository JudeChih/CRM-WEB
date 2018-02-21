<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebProductData extends Model {

    /**
     * 資料表名稱
     * @var string
     */
    protected $table = 'WebProductData';

    /**
     * 主鍵值
     * @var string
     */
    protected $primaryKey = 'pd_id';

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
//        'pd_name', 'pg_id',
//        'isflag', 'create_date', 'last_update_date', 'create_user', 'last_update_user',
//    ];

    /**
     * 不可異動的值
     * @var type 
     */
    protected $guarded = ['pd_id'];

    /**
     * 產品群組資料
     * @return type
     */
    public function productGroup() {
        return $this->belongsTo('App\Models\WebProductGroup', 'pg_id');
    }

}
