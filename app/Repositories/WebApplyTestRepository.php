<?php

namespace App\Repositories;

use App\Models\WebApplyTest;

class WebApplyTestRepository {

    /**
     * 注入的 WebApplyTest model
     * @var type 
     */
    protected $model;

    public function __construct(WebApplyTest $model) {
        $this->model = $model;
    }

    /**
     * 初始化一新的物件
     * @return \App\Repositories\WebApplyTestRepository
     */
    public static function withNew() {
        return new WebApplyTestRepository(new WebApplyTest());
    }

    /**
     * 取得所有資料
     * @return type
     */
    public function getAllData() {
        return $this->model->orderBy('apply_id')->get();
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
     * 建立一筆新的資料
     * @param array $arraydata 要新增的資料
     * @return type
     */
    public function create(array $arraydata) {

        if (//
                !isset($arraydata['comp_name']) || !isset($arraydata['contact_name']) || !isset($arraydata['contact_mail']) || !isset($arraydata['contact_phone'])//
                || !isset($arraydata['pg_id']) || !isset($arraydata['pd_id']) || !isset($arraydata['computer_amount'])//
        ) {
            return null;
        }

        $savedata['comp_name'] = $arraydata['comp_name'];
        $savedata['contact_name'] = $arraydata['contact_name'];
        $savedata['contact_mail'] = $arraydata['contact_mail'];
        $savedata['contact_phone'] = $arraydata['contact_phone'];
        $savedata['pg_id'] = $arraydata['pg_id'];
        $savedata['pd_id'] = $arraydata['pd_id'];
        $savedata['computer_amount'] = $arraydata['computer_amount'];

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

        if (!isset($primarykey)) {
            return null;
        }

        if (isset($arraydata['isflag'])) {
            $savedata['isflag'] = $arraydata['isflag'];
        }

        $savedata['last_update_date'] = \Carbon\Carbon::now();

        return $this->model->where($this->model->primaryKey, '=', $primarykey)->update($savedata);
    }

    /**
     * 刪除該「$primarykey」的資料
     * @param type $primarykey 主鍵值
     */
    public function delete($primarykey) {
        return $this->model->where($this->model->primaryKey, '=', $primarykey)->delete();
    }

}
