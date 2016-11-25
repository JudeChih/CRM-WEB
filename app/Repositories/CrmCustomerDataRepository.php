<?php

namespace App\Repositories;

use App\Models\CrmCustomerData;

class CrmCustomerDataRepository {

    /**
     * 注入的 WebProductData model
     * @var type 
     */
    protected $model;

    public function __construct(CrmCustomerData $model) {
        $this->model = $model;
    }

    /**
     * 初始化一新的物件
     * @return \App\Repositories\WebProductDataRepository
     */
    public static function withNew() {
        return new CrmCustomerDataRepository(new CrmCustomerData());
    }

    /**
     * 取得所有資料
     * @return type
     */
    public function getAllData() {
        return $this->model->orderBy($this->primaryKey)->get();
    }

    /**
     * 
     * @return type
     */
    public function getPaginateCustomer() {
        return $this->model->orderBy('cd_id')->paginate(10);
    }

    /**
     * 
     * @return type
     */
    public function getPaginateCustomerByName($name) {

//        return $this->model->where('cd_full_cname', 'like', "%$name%")
//                        ->orderBy('cd_id')
//                        ->paginate(10)
//                        ->appends(['name' => $name]);

        return $this->model->where('cd_full_cname', 'like', '%' . $name . '%')->orderBy('cd_id')->paginate(10);
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
