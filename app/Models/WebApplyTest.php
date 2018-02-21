<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebApplyTest extends Model {

    /**
     * 資料表名稱
     * @var string
     */
    protected $table = 'WebApplyTest';

    /**
     * 主鍵值
     * @var string
     */
    protected $primaryKey = 'apply_id';

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
     * 對應資料表「WebProductGroup」
     * @return type
     */
    public function productGroup() {
        
        return $this->belongsTo('App\Models\WebProductGroup', 'pg_id', 'pg_id');
    }

    /**
     * 對應資料表「WebProductData」
     * @return type
     */
    public function productData() {

        return $this->belongsTo('App\Models\WebProductData', 'pd_id', 'pd_id');
    }

}
