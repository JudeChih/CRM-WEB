<?php

namespace App\Repositories;

use App\Models\WebHoliday;
use Carbon\Carbon;

class WebHolidayRepository {

    /**
     * 注入的 WebProductData model
     * @var type
     */
    protected $model;

    public function __construct(WebHoliday $model) {
        $this->model = $model;
    }

    /**
     * 初始化一新的物件
     * @return \App\Repositories\WebProductDataRepository
     */
    public static function withNew() {
        return new WebHolidayRepository(new WebHoliday());
    }

    /**
     * 取得所有資料
     * @return type
     */
    public function getAllData() {
        return $this->model->orderBy('id')->get();
    }

    /**
     * 使用「c_year c_month」查詢資料表的值
     * @param type $date 查詢陣列，年跟月
     * @return type
     */
    public function getDataOfOneMonth($date) {
        return $this->model->where('c_year',$date['c_year'])->where('c_month',$date['c_month'])->get();
    }

    /**
     * 使用「c_year c_month」查詢資料表的值
     * @param type $date 查詢陣列，年跟月
     * @return type
     */
    public function getDataByDate($date) {
        return $this->model->where('c_year','>=',$date['c_year'])->where('c_month','>=',$date['c_month'])->orderBy('c_year','asc')->orderBy('c_month','asc')->get();
    }

    /**
     * 取得分頁資料
     * @return type
     */
    public function getListDataPage() {
        return $reusls = $this->model->get();
    }

    /**
     * 更新「某年某月某天」的資料
     * @param array $arraydata 要更新的資料
     * @return type
     */
    public function update(array $arraydata) {
        $savedata['last_update_date'] = \Carbon\Carbon::now();
        $savedata['c_is_holiday'] = $arraydata['c_is_holiday'];
        $this->model->where('c_year', '=',$arraydata['c_year'])->where('c_month', '=',$arraydata['c_month'])->where('c_day', '=',$arraydata['c_day'])->update($savedata);
    }


    /**
     * 新增「某年某月」的資料
     * @param  array  $arraydata [description]
     * @return [type]            [description]
     */
    public function create(array $arraydata) {
        $y = $arraydata['c_year'];
        $m = $arraydata['c_month'];
        $days = \Carbon\Carbon::create($y,$m)->daysInMonth;

        for( $i=1 ; $i<=$days ; $i++ ){
            $dt = Carbon::createFromDate($y,$m,$i);
            $dayofweek = $dt->dayOfWeek;
            $savedata['c_year'] = $y;
            $savedata['c_month'] = $m;
            $savedata['c_day'] = $i;
            if($dayofweek == 0){
                $savedata['c_dayofweek'] = 7;
            }else{
                $savedata['c_dayofweek'] = $dayofweek;
            }
            if ($dayofweek == 0 || $dayofweek == 6) {
                $savedata['c_is_holiday'] = 1;
            }else{
                $savedata['c_is_holiday'] = 0;
            }
            $savedata['isflag'] = '1';
            $savedata['create_date'] = Carbon::now();
            $this->model->insert($savedata);
        }
    }
}