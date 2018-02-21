<?php

namespace App\Repositories;

use App\Models\CrmCustomerSaleRelation;

class CrmCustomerSaleRelationRepository {

    /**
     * 注入的 WebProductData model
     * @var type 
     */
    protected $model;

    public function __construct(CrmCustomerSaleRelation $model = null) {

        if (isset($model)) {
            $this->model = $model;
        }

        $this->model = new CrmCustomerSaleRelation();
    }

    /**
     * 初始化一新的物件
     * @return \App\Repositories\WebProductDataRepository
     */
    public static function withNew() {
        return new CrmCustomerSaleRelationRepository(new CrmCustomerSaleRelation());
    }

    /**
     * 取得所有資料
     * @return type
     */
    public function getAllData() {
        return $this->model->get();
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
     * 使用「$cd_id 客戶代碼」取得 客戶 負責業務郵件陣列
     * @param type $cd_id 客戶代碼
     * @return type
     */
    public function getSalesMailArrayByCd_ID($cd_id) {

        $result = $this->model
                ->join('CrmUserData', 'CrmUserData.ud_id', '=', 'CrmCustomerSaleRelation.sd_id')
                ->where('CrmUserData.isflag', '=', '1')
                ->where('CrmCustomerSaleRelation.cd_id', '=', $cd_id)
                ->where('CrmCustomerSaleRelation.sr_type', '=', '1')
                ->get();

        if (!isset($result) || count($result) == 0) {

            $query = $this->model
                            ->join('CrmUserData', 'CrmUserData.ud_id', '=', 'CrmCustomerSaleRelation.sd_id')
                            ->where('CrmUserData.isflag', '=', '1')
                            ->where('CrmCustomerSaleRelation.cd_id', '=', $cd_id)
                            ->where('CrmCustomerSaleRelation.sr_type', '=', '1')->toSql();
            echo $query;
            echo $cd_id;
            echo 'wwww<br>';
            return null;
        }

        $emails = [];
        foreach ($result as $sales) {

            if (isset($sales->ud_email) && strlen($sales->ud_email) != 0) {
                $emails[] = $sales->ud_email;
            }
        }

        return $emails;
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
