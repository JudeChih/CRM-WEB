<?php

namespace App\Repositories;

use App\Models\WebSupportUser;

class WebSupportUserRepository {

    /**
     * 注入的 WebProductData model
     * @var type
     */
    protected $model;

    public function __construct(WebSupportUser $model) {
        $this->model = $model;
    }

    /**
     * 初始化一新的物件
     * @return \App\Repositories\WebSupportUserRepository
     */
    public static function withNew() {
        return new WebSupportUserRepository(new WebSupportUser());
    }

    /**
     * 取得所有資料
     * @return type
     */
    public function getAllData() {
        return $this->model->orderBy('id')->get();
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
     * 使用「$primarykey」查詢資料表的主鍵值
     * @param type $primarykey 要查詢的值
     * @return type
     */
    public function getDataBySupportID($supportID) {
        return $this->model->where('support_id', '=', $supportID)->get();
    }

    /**
     * [deleteUserByUserRole description]
     * @param  [type] $support_id [description]
     * @param  [type] $user_role  [description]
     * @return [type]             [description]
     */
    public function deleteUserByUserRole($support_id, $user_role) {
        return $this->model->where('support_id', '=', $support_id)->where('user_role', '=', $user_role)->delete();
    }

    /**
     * 建立一筆新的資料
     * @param array $arraydata 要新增的資料
     * @return type
     */
    public function create(array $arraydata) {

        if (!isset($arraydata['support_id']) || !isset($arraydata['ud_id']) || !isset($arraydata['user_role'])) {
            return null;
        }
        $savedata['support_id'] = $arraydata['support_id'];
        $savedata['ud_id'] = $arraydata['ud_id'];
        $savedata['user_role'] = $arraydata['user_role'];
        $savedata['add_date'] = \Carbon\Carbon::now();
        $savedata['isflag'] = '1';
        $savedata['create_date'] = \Carbon\Carbon::now();
        $savedata['last_update_date'] = \Carbon\Carbon::now();

        //新增資料並回傳「自動遞增KEY值」
        return $this->model->insertGetId($savedata);
    }

    public function createBindingUser($support_id, $ud_id, $user_role) {

        if (!isset($support_id) || !isset($ud_id) || !isset($user_role)) {
            return null;
        }
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
