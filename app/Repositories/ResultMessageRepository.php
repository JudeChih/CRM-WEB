<?php

namespace App\Repositories;

use App\Models\ResultMessage as ResultMessage;

class ResultMessageRepository {

    /**
     * 注入的 ResultMessage model
     * @var type 
     */
    protected $resultmessage;

    public function __construct(ResultMessage $resultmessage) {
        $this->resultmessage = $resultmessage;
    }

    public static function withNew() {
        return new ResultMessageRepository(new ResultMessage());
    }

    /**
     * 取得所有資料
     * @return type
     */
    public function getAllData() {
        return $this->resultmessage->orderBy('rm_code')->get();
    }

    /**
     * 
     * @param type $primarykey
     * @return type
     */
    public function getDataByPrimaryKey($primarykey) {
        return $this->resultmessage->where('rm_id', $primarykey)->orderBy('rm_code')->get();
    }

    /**
     * 依「$rm_code」取得訊息
     * @param type $rm_code $rm_code
     * @return type
     */
    public function getResultMessageByCode($rm_code) {
        $data = $this->resultmessage->where('rm_code', $rm_code)->orderBy('rm_code')->first();

        $message = ['rm_code' => '', 'rm_message01' => '', 'rm_message02' => '', 'rm_message03' => ''];

        if (isset($data)) {
            $message = ['rm_code' => $data->rm_code, 'rm_message01' => $data->rm_message01, 'rm_message02' => $data->rm_message02, 'rm_message03' => $data->rm_message03];
        }

        return json_encode($message);
    }

    /**
     * 建立一筆新的資料
     * @param array $arraydata 要新增的資料
     * @return type
     */
    public function create(array $arraydata) {
        return $this->userdata->create($arraydata);
    }

    /**
     * 更新該「$ud_guid」的資料
     * @param array $arraydata 要更新的資料
     * @param type $ud_guid 使用者代碼
     * @return type
     */
    public function update(array $arraydata, $ud_guid) {
        return $this->userdata->where('ud_guid', '=', $ud_guid)->update($arraydata);
    }

    /**
     * 刪除該「$ud_guid」的資料
     * @param type $ud_guid 使用者代碼
     */
    public function delete($ud_guid) {
        
    }

}
