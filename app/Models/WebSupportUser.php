<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebSupportUser extends Model {

    /**
     * 資料表名稱
     * @var string
     */
    protected $table = 'WebSupport_User';

    /**
     * 主鍵值
     * @var string
     */
    protected $primaryKey = 'id';

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

    public function supportCase() {
        return $this->belongsTo('App\Models\WebSupport', 'support_id', 'support_id');
    }

    public function userData() {
        return $this->belongsTo('App\Models\CrmUserData', 'ud_id');
    }

}
