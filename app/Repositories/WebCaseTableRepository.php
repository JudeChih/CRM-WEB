<?php

namespace App\Repositories;

use App\Models\WebCaseTable;
use Carbon\Carbon;

class WebCaseTableRepository {

    /**
     * 注入的 WebProductData model
     * @var type
     */
    protected $model;

    public function __construct(WebCaseTable $model) {
        $this->model = $model;
    }

    /**
     * 初始化一新的物件
     * @return \App\Repositories\WebProductDataRepository
     */
    public static function withNew() {
        return new WebCaseTableRepository(new WebCaseTable());
    }

    /**
     * 取得所有資料
     * @return type
     */
    public function getAllData() {
        return $this->model->orderBy('id')->get();
    }

    /**
     * 使用「$primarykey」查詢資料表的主鍵值
     * @param type $primarykey 要查詢的值
     * @return type
     */
    public function getData($primarykey) {
        // return $this->model->find($primarykey);
        return $this->model->where('c_year',$primarykey->c_year)->where('c_month',$primarykey->c_month)->get();
    }
    public function getData2($primarykey) {
        // return $this->model->find($primarykey);
        return $this->model->where('c_year',2016)->where('c_month',11)->get();
    }

    /**
     * 取得分頁資料
     * @return type
     */
    public function getListDataPage() {
        return $reusls = $this->model->get();
    }

    /**
     * 更新該「$primarykey」的資料
     * @param array $arraydata 要更新的資料
     * @param type $primarykey
     * @return type
     */
    public function update(array $arraydata,$c_year,$c_month) {
        echo '1111';
        if($arraydata['submit'] == 'save'){
            $arrayLength = count($arraydata['c_day']);
            for($i=0;$i<$arrayLength;$i++){
                if (isset($arraydata['c_day'][$i][$i+1])) {
                    $savedata['c_is_holiday'] = $arraydata['c_day'][$i][$i+1];
                }
                $savedata['last_update_date'] = \Carbon\Carbon::now();
                $this->model->where('c_year', '=',$c_year)->where('c_month', '=',$c_month)->where('c_day', '=',$i+1)->update($savedata);
            }
        }else if($arraydata['submit'] == 'reset'){
            $arrayLength = count($arraydata['c_dayofweek']);
            for($i=0;$i<$arrayLength;$i++){
                if ($arraydata['c_dayofweek'][$i][$i+1] == 6 || $arraydata['c_dayofweek'][$i][$i+1] == 7) {
                    $savedata['c_is_holiday'] = 1;
                }else{
                    $savedata['c_is_holiday'] = 0;
                }
                $savedata['last_update_date'] = \Carbon\Carbon::now();
                $this->model->where('c_year', '=',$c_year)->where('c_month', '=',$c_month)->where('c_day', '=',$i+1)->update($savedata);
            }
        }else if($arraydata['submit'] == 'create'){

        }
    }



    public function create(array $arraydata) {
        $numberofday = $arraydata['c_numberofday'];
        $y = $arraydata['c_year'];
        $m = $arraydata['c_month'];

        for( $i=1 ; $i<=$numberofday ; $i++ ){
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