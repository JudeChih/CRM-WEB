<?php

namespace App\Repositories;

use App\Models\WebProblemCategory;

class WebProblemCategoryRepository {

    /**
     * 注入的 ResultMessage model
     * @var type 
     */
    protected $model;

    public function __construct(WebProblemCategory $model) {
        $this->model = $model;
    }

    /**
     * 初始化一新的物件
     * @return \App\Repositories\WebProblemCategoryRepository
     */
    public static function withNew() {
        return new WebProblemCategoryRepository(new WebProblemCategory());
    }

    /**
     * 取得頁面「技術支援」的下拉選單資料
     * @return type
     */
    public function getDropDownListDataSupport() {
        return $this->model
                        ->whereNull('problem_parent')
                        ->where('isflag', '=', '1')
                        ->select('pg_id', 'problem_id', 'problem_name', 'problem_parent')
                        ->orderBy('pg_id', 'problem_id')
                        ->get();
    }

    /**
     * 取得頁面「技術支援」的下拉選單資料
     * @return type
     */
    public function getSubDropDownListDataSupport() {
        return $this->model
                        ->whereNotNull('problem_parent')
                        ->where('isflag', '=', '1')
                        ->select('pg_id', 'problem_id', 'problem_name', 'problem_parent')
                        ->orderBy('pg_id', 'problem_id')
                        ->get();
    }

    /**
     * 取得所有資料
     * @return type
     */
    public function getAllData() {
        return $this->model->orderBy('problem_id')->get();
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
     * 
     * @param type $key
     * @param type $value
     */
    public function getDataBy($key, $value) {
        return $this->model->where($key, $value);
    }

    public function getPluckProblemCategory($pg_id) {
        return $this->model
                        ->where('problem_parent', '=', '')
                        ->where('pg_id', '=', $pg_id)
                        ->where('isflag', '=', '1')
                        ->pluck('problem_name', 'problem_id');
    }

    public function getPluckSubProblemCategory($problem_id) {
        return $this->model
                        ->where('problem_parent', '=', $problem_id)
                        ->where('isflag', '=', '1')
                        ->pluck('problem_name', 'problem_id');
    }

    /**
     * 取得問題類別
     * @return type
     */
    public function getProblemCategory() {
        return $this->model->where('problem_parent', '')->where('isflag', '1')->pluck('problem_name', 'problem_id');
    }

    /**
     * 取得問題子類別
     * @param type $parent_id
     * @return type
     */
    public function getSubProblemCategory($parent_id) {
        if (isset($parent_id)) {
            return $this->model->where('problem_parent', $parent_id)->where('isflag', '1')->pluck('problem_name', 'problem_id');
        }
        return null;
    }

    /**
     * 取得問題類別
     * @return type
     */
    public function getPluckProblemCategoryQQ() {
        return $this->model->where('problem_parent', '')->where('isflag', '1')->pluck('problem_name', 'problem_id');
    }

    /**
     * 取得問題子類別
     * @param type $parent_id
     * @return type
     */
    public function getPluckSubProblemCategoryQQ($parent_id) {
        if (isset($parent_id)) {
            return $this->model->where('problem_parent', $parent_id)->where('isflag', '1')->pluck('problem_name', 'problem_id');
        }
        return null;
    }

    /**
     * 建立一筆新的資料
     * @param array $arraydata 要新增的資料
     * @return type
     */
    public function create(array $arraydata) {

        if (!isset($arraydata['problem_name']) || !isset($arraydata['problem_description']) || !isset($arraydata['problem_parent'])
        ) {
            return null;
        }

        $savedata['problem_name'] = $arraydata['problem_name'];
        $savedata['problem_description'] = $arraydata['problem_description'];
        $savedata['problem_parent'] = $arraydata['problem_parent'];

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

        if (isset($arraydata['problem_name'])) {
            $savedata['problem_name'] = $arraydata['problem_name'];
        }
        if (isset($arraydata['problem_description'])) {
            $savedata['problem_description'] = $arraydata['problem_description'];
        }
        if (isset($arraydata['problem_parent'])) {
            $savedata['problem_parent'] = $arraydata['problem_parent'];
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
