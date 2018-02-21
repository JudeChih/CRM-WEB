<?php

namespace App\Repositories;

use App\Models\WebSatisfactionScore;

class WebSatisfactionScoreRepository {

    /**
     * 注入的 WebProductData model
     * @var type 
     */
    protected $model;

    public function __construct(WebSatisfactionScore $model) {
        $this->model = $model;
    }

    /**
     * 初始化一新的物件
     * @return \App\Repositories\WebProductDataRepository
     */
    public static function withNew() {
        return new WebSatisfactionScoreRepository(new WebSatisfactionScore());
    }

    /**
     * 取得所有資料
     * @return type
     */
    public function getAllData() {
        return $this->model->orderBy('id')->get();
    }

    public function getDataBySupportID($support_id) {
        return $this->model->where('support_id', '=', $support_id)->first();
    }

    /**
     * 使用「$primarykey」查詢資料表的主鍵值
     * @param type $primarykey 要查詢的值
     * @return type
     */
    public function getData($primarykey) {
        return $this->model->find($primarykey);
    }

    /**
     * 取得「結案滿意度調查」的問題資料
     * @return type
     */
    public function getCloseSatisfactionData() {
        return $this->model->where('isflag', '=', '1')->orderBy('id')->get();
    }

    /**
     * 建立一筆新的資料
     * @param array $arraydata 要新增的資料
     * @return type
     */
    public function create(array $arraydata) {
        /*
          if (!$this->checkColumnExist($arraydata)) {
          return null;
          }
         */
        $savedata['support_id'] = $arraydata['support_id'];


        if (isset($arraydata['score01'])) {
            $savedata['score01'] = $arraydata['score01'];
            $savedata['problem01'] = $arraydata['problem01'];
        } else {
            $savedata['score01'] = 0;
            $savedata['problem01'] = null;
        }
        if (isset($arraydata['score02'])) {
            $savedata['score02'] = $arraydata['score02'];
            $savedata['problem02'] = $arraydata['problem02'];
        } else {
            $savedata['score02'] = 0;
            $savedata['problem02'] = null;
        }
        if (isset($arraydata['score03'])) {
            $savedata['score03'] = $arraydata['score03'];
            $savedata['problem03'] = $arraydata['problem03'];
        } else {
            $savedata['score03'] = 0;
            $savedata['problem03'] = null;
        }
        if (isset($arraydata['score04'])) {
            $savedata['score04'] = $arraydata['score04'];
            $savedata['problem04'] = $arraydata['problem04'];
        } else {
            $savedata['score04'] = 0;
            $savedata['problem04'] = null;
        }
        if (isset($arraydata['score05'])) {
            $savedata['score05'] = $arraydata['score05'];
            $savedata['problem05'] = $arraydata['problem05'];
        } else {
            $savedata['score05'] = 0;
            $savedata['problem05'] = null;
        }
        if (isset($arraydata['score06'])) {
            $savedata['score06'] = $arraydata['score06'];
            $savedata['problem06'] = $arraydata['problem06'];
        } else {
            $savedata['score06'] = 0;
            $savedata['problem06'] = null;
        }
        if (isset($arraydata['score07'])) {
            $savedata['score07'] = $arraydata['score07'];
            $savedata['problem07'] = $arraydata['problem07'];
        } else {
            $savedata['score07'] = 0;
            $savedata['problem07'] = null;
        }
        if (isset($arraydata['score08'])) {
            $savedata['score08'] = $arraydata['score08'];
            $savedata['problem08'] = $arraydata['problem08'];
        } else {
            $savedata['score08'] = 0;
            $savedata['problem08'] = null;
        }
        if (isset($arraydata['score09'])) {
            $savedata['score09'] = $arraydata['score09'];
            $savedata['problem09'] = $arraydata['problem09'];
        } else {
            $savedata['score09'] = 0;
            $savedata['problem09'] = null;
        }
        if (isset($arraydata['score10'])) {
            $savedata['score10'] = $arraydata['score10'];
            $savedata['problem10'] = $arraydata['problem10'];
        } else {
            $savedata['score10'] = 0;
            $savedata['problem10'] = null;
        }

        $savedata['suggest'] = $arraydata['suggest'];
        $savedata['total'] = $savedata['score01'] + $savedata['score02'] + $savedata['score03'] + $savedata['score04'] + $savedata['score05'] + $savedata['score06'] + $savedata['score07'] + $savedata['score08'] + $savedata['score09'] + $savedata['score10'];

        $savedata['isflag'] = '1';
        $savedata['create_date'] = \Carbon\Carbon::now();
        $savedata['last_update_date'] = \Carbon\Carbon::now();
//        $savedata['create_user'] = $arraydata['create_user'];
//        $savedata['last_update_user'] = $arraydata['last_update_user'];
//        
//        
//        
        //新增資料並回傳「自動遞增KEY值」
        return $this->model->insertGetId($savedata);
    }

    /**
     * 更新該「$primarykey」的資料
     * @param array $arraydata 要更新的資料
     * @param type $primarykey 
     * @return type
     */
    public function update(array $arraydata, $primarykey) {
        return null;
    }

    /**
     * 刪除該「$primarykey」的資料
     * @param type $primarykey 主鍵值
     */
    public function delete($primarykey) {
        return null;
    }

    /**
     * 檢查資料欄位是否存在
     * @param type $arraydata
     * @return boolean
     */
    private function checkColumnExist($arraydata) {
        if (//
        //!isset($arraydata['case_number'])//
                !isset($arraydata['support_id'])//
                /*
                  || !isset($arraydata['problem01'])//
                  || !isset($arraydata['score01'])//
                  || !isset($arraydata['problem02'])//
                  || !isset($arraydata['score02'])//
                  || !isset($arraydata['problem03'])//
                  || !isset($arraydata['score03'])//
                  || !isset($arraydata['problem04'])//
                  || !isset($arraydata['score04'])//
                  || !isset($arraydata['problem05'])//
                  || !isset($arraydata['score05'])//
                  || !isset($arraydata['problem06'])//
                  || !isset($arraydata['score06'])//
                  || !isset($arraydata['problem07'])//
                  || !isset($arraydata['score07'])//
                  || !isset($arraydata['problem08'])//
                  || !isset($arraydata['score08'])//
                  || !isset($arraydata['problem09'])//
                  || !isset($arraydata['score09'])//
                  || !isset($arraydata['problem10'])//
                  || !isset($arraydata['score10'])//
                 */ || !isset($arraydata['suggest'])//
        //|| !isset($arraydata['total'])//
        ) {
            return false;
        }
        return true;
    }

}
