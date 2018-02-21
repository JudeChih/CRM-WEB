<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class WebHoliday extends Model {

    /**
     * 資料表名稱
     * @var string
     */
    protected $table = 'WebHoliday';

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

    /**
     * 可異動的資料欄位
     * @var type
     */
    protected $fillable = [
        'c_year', 'c_month', 'c_day', 'c_dayofweek', 'c_is_holiday',
        'create_date', 'last_update', 'create_user', 'last_update_user'
    ];

    /**
     * 不可異動的值
     * @var type
     */
    protected $guarded = ['id'];

    public static function GetData($btn) {
        try {
            $results = DB::get();
            return $results;
        } catch (Exception $ex) {
            return null;
        }
    }
}
