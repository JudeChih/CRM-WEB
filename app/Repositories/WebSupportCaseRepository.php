<?php
namespace App\Repositories;

use App\Models\WebCaseList;

class WebSupportCaseRepository {

    /**
     * 注入的 WebCaseList model
     * @var type
     */
    protected $model;

    public function __construct(WebCaseList $model) {
        $this->model = $model;
    }

    /**
     * 初始化一新的物件
     * @return \App\Repositories\WebProductDataRepository
     */
    public static function withNew() {
        return new WebSupportCaseRepository(new WebCaseList());
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
