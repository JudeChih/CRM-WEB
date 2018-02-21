<?php

namespace App\Repositories;

use App\Models\CrmCustomerContact;

class CrmCustomerContactRepository {

    /**
     * 注入的 WebProductData model
     * @var type 
     */
    protected $model;

    public function __construct(CrmCustomerContact $model = null) {
        if (isset($model)) {
            $this->model = $model;
        }
        $this->model = new CrmCustomerContact();
    }

    /**
     * 初始化一新的物件
     * @return \App\Repositories\WebProductDataRepository
     */
    public static function withNew() {
        return new CrmCustomerContactRepository(new CrmCustomerContact());
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
     * 使用「$cc_email 聯絡人電子郵件」查詢資料
     * @param type $cc_email 聯絡人電子郵件
     * @return type
     */
    public function getDataByCCEmail($cc_email) {
        return $this->model
                        ->where('cc_state', '=', '1')
                        ->where('isflag', '=', '1')
                        ->where('cc_email', '=', $cc_email)
                        ->first();
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
