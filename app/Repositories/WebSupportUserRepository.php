<?php

namespace App\Repositories;

use App\Models\WebProductGroup;

class WebSupportUserRepository {

    /**
     * 注入的 WebProductData model
     * @var type 
     */
    protected $model;

    public function __construct(WebProductGroup $model) {
        $this->model = $model;
    }

    /**
     * 初始化一新的物件
     * @return \App\Repositories\WebProductDataRepository
     */
    public static function withNew() {
        return new WebProductGroupRepository(new WebProductGroup());
    }

    /**
     * 取得所有資料
     * @return type
     */
    public function getAllData() {
        return $this->model->orderBy('pg_id')->get();
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

        if (!isset($arraydata['ud_id']) || !isset($arraydata['user_role'])) {
            return null;
        }

        $savedata['ud_id'] = $arraydata['ud_id'];
        $savedata['user_role'] = $arraydata['user_role'];

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

        if (isset($arraydata['ud_id'])) {
            $savedata['ud_id'] = $arraydata['ud_id'];
        }
        if (isset($arraydata['user_role'])) {
            $savedata['user_role'] = $arraydata['user_role'];
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
