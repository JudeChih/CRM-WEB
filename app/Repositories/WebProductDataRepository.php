<?php

namespace App\Repositories;

use App\Models\WebProductData;

class WebProductDataRepository {

    /**
     * 注入的 WebProductData model
     * @var type 
     */
    protected $model;

    public function __construct(WebProductData $model) {
        $this->model = $model;
    }

    /**
     * 初始化一新的物件
     * @return \App\Repositories\WebProductDataRepository
     */
    public static function withNew() {
        return new WebProductDataRepository(new WebProductData());
    }

    /**
     * 取得所有資料
     * @return type
     */
    public function getAllData() {
        return $this->model->orderBy('pd_id')->get();
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
     * 使用「$pg_id」查詢資料表的「產品群組代碼」
     * @param type $pg_id 要查詢的產品群組代碼
     * @return type
     */
    public function getDataByPg_Id($pg_id) {
        return $this->model->where('pg_id', '=', $pg_id);
    }

    /**
     * 
     * @return type
     */
    public function getProductPluck($pg_id) {
        return $this->model->where('pg_id', $pg_id)->where('isflag', '1')->pluck('pd_name', 'pd_id');
    }

    /**
     * 建立一筆新的資料
     * @param array $arraydata 要新增的資料
     * @return type
     */
    public function create(array $arraydata) {

        if (!isset($arraydata['pd_name']) || !isset($arraydata['pg_id'])) {
            return null;
        }

        $savedata['pd_name'] = $arraydata['pd_name'];
        $savedata['pg_id'] = $arraydata['pg_id'];

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

        if (isset($arraydata['pd_name'])) {
            $savedata['pd_name'] = $arraydata['pd_name'];
        }
        if (isset($arraydata['pg_id'])) {
            $savedata['pg_id'] = $arraydata['pg_id'];
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
