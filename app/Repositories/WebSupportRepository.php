<?php

namespace App\Repositories;

use App\Models\WebSupport;

class WebSupportRepository {

    /**
     * 注入的 WebProductData model
     * @var type
     */
    protected $model;

    public function __construct(WebSupport $model) {
        $this->model = $model;
    }

    /**
     * 初始化一新的物件
     * @return \App\Repositories\WebProductDataRepository
     */
    public static function withNew() {
        return new WebSupportRepository(new WebSupport());
    }

    /**
     * 取得所有資料
     * @return type
     */
    public function getAllData() {
        return $this->model->orderBy('support_id')->get();
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
     * 取得分頁資料
     * @return type
     */
    public function getListDataPage() {
        return $reusls = $this->model->paginate();
    }

    /**
     * 建立一新的技術支援案件
     * @param array $arraydata
     * @return type
     */
    public function createNewCase(array $arraydata) {
        //$savedata['case_number'] = $this->getCaseNumber();

        if (//
                !isset($arraydata['comp_name']) || !isset($arraydata['contact_name']) || !isset($arraydata['contact_mail']) || !isset($arraydata['contact_phone'])//
                || !isset($arraydata['pg_id']) || !isset($arraydata['pd_id']) || !isset($arraydata['product_version'])//
                || !isset($arraydata['problem_id']) || !isset($arraydata['problem_parent'])//
                || !isset($arraydata['support_subject']) || !isset($arraydata['support_description']) //|| !isset($arraydata['support_filename'])//
        ) {
            return null;
        }

        //要建立
        $savedata['case_number'] = $this->getCaseNumber();

        $savedata['case_status'] = 0; //新案件

        $savedata['create_date'] = \Carbon\Carbon::now();
        //要計算
        $savedata['deadline_take'] = \Carbon\Carbon::now();
        $savedata['deadline_close'] = \Carbon\Carbon::now();

        $savedata['comp_name'] = $arraydata['comp_name'];
        $savedata['contact_name'] = $arraydata['contact_name'];
        $savedata['contact_mail'] = $arraydata['contact_mail'];
        $savedata['contact_phone'] = $arraydata['contact_phone'];
        $savedata['pg_id'] = $arraydata['pg_id'];
        $savedata['pd_id'] = $arraydata['pd_id'];
        $savedata['product_version'] = $arraydata['product_version'];
        $savedata['problem_id'] = $arraydata['problem_id'];
        $savedata['problem_parent'] = $arraydata['problem_parent'];
        $savedata['support_subject'] = $arraydata['support_subject'];
        $savedata['support_description'] = $arraydata['support_description'];
        //$savedata['support_filename'] = $arraydata['support_filename'];

        //$savedata['isflag'] = '1';
        $savedata['create_date'] = \Carbon\Carbon::now();
        //$savedata['last_update_date'] = \Carbon\Carbon::now();

//        $savedata['create_user'] = $arraydata['create_user'];
//        $savedata['last_update_user'] = $arraydata['last_update_user'];
//
//
//
        //新增資料並回傳「自動遞增KEY值」
        return array($this->getCaseNumber(),$arraydata['contact_name']);
    }

    /**
     * 建立一筆新的資料
     * @param array $arraydata 要新增的資料
     * @return type
     */
    public function create(array $arraydata) {

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
        if (isset($arraydata['pg_name'])) {
            $savedata['pg_name'] = $arraydata['pg_name'];
        }
        if (isset($arraydata['pg_type'])) {
            $savedata['pg_type'] = $arraydata['pg_type'];
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

    /**
     * 取得案件編號
     * @return type
     */
    private function getCaseNumber() {
        $dt = \Carbon\Carbon::now();
        return $dt->year . $dt->month . $dt->day . $dt->hour . $dt->minute . $dt->second . $dt->micro;
    }

}
