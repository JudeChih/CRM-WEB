<?php

namespace App\Repositories;

use App\Models\CrmUserData;

class CrmUserDataRepository {

    /**
     * 注入的 WebProductData model
     * @var type 
     */
    protected $model;

    public function __construct(CrmUserData $model) {
        $this->model = $model;
    }

    /**
     * 初始化一新的物件
     * @return \App\Repositories\WebProductDataRepository
     */
    public static function withNew() {
        return new CrmUserDataRepository(new CrmUserData());
    }

    /**
     * 取得所有資料
     * @return type
     */
    public function getAllData() {
        return $this->model->orderBy($this->primaryKey)->get();
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
     * 取得分頁資料「工程師」
     * @return type
     */
    public function getPaginateEngineer() {

        return $this->model->join('CrmDepartment', 'dep_id', '=', 'CrmDepartment.dep_id')->orderBy('ud_id')->get();


        return $this->model->orderBy($this->primaryKey)->paginate(10);
    }

    /**
     * 取得分頁資料「業務」
     * @return type
     */
    public function getPaginatSales() {
        return $this->model
                        ->join('CrmDepartment', 'CrmUserData.dep_id', '=', 'CrmDepartment.dep_id')
                        ->where('CrmUserData.isflag', '=', '1')
                        ->where('CrmDepartment.dep_type', '=', '3')
                        ->orderBy('CrmDepartment.dep_ch')
                        ->orderBy('CrmUserData.ud_cname')
                        ->get();
        return $this->model->orderBy($this->primaryKey)->paginate(10);
    }

    /**
     * 取得資料「業務」
     * @return type
     */
    public function getSalesListByCondition($conditin) {
        return $this->model
                        ->join('CrmDepartment', 'CrmUserData.dep_id', '=', 'CrmDepartment.dep_id')
                        ->where('CrmUserData.isflag', '=', '1')
                        ->where('CrmDepartment.dep_type', '=', '3')
                        ->where('CrmUserData.ud_cname', 'like', '%' . $conditin . '%')
                        ->orderBy('CrmDepartment.dep_ch')
                        ->orderBy('CrmUserData.ud_cname')
                        ->get();
        return $this->model->orderBy($this->primaryKey)->paginate(10);
    }

    /**
     * 取得資料「工程師」
     * @return type
     */
    public function getEngineerListByCondition($conditin) {
        return $this->model
                        ->join('CrmDepartment', 'CrmUserData.dep_id', '=', 'CrmDepartment.dep_id')
                        ->where('CrmUserData.isflag', '=', '1')
                        ->where('CrmDepartment.dep_type', '=', '2')
                        ->where('CrmUserData.ud_cname', 'like', '%' . $conditin . '%')
                        ->orderBy('CrmDepartment.dep_ch')
                        ->orderBy('CrmUserData.ud_cname')
                        ->get();
        return $this->model->orderBy($this->primaryKey)->paginate(10);
    }

    /**
     * 建立一筆新的資料
     * @param array $arraydata 要新增的資料
     * @return type
     */
    public function create(array $arraydata) {
        return null;
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

}
