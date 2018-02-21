<?php

namespace App\Repositories;

use App\Models\WebSupport;

class WebSupportRepository {
    private static $closecasedeadline = 2; // day
    private static $takecasedeadline = 2; // hour
    private static $worktime = 9;         // hour
    private static $offworktime = 18;     // hour

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
     * 使用「case_number」查詢資料表的資料
     * @param type $case_number
     * @return type
     */
    public function getDataByCaseNumber($case_number) {
        return $this->model->where('case_number', '=', $case_number)->first();
    }

    /**
     * 取得分頁資料
     * @return type
     */
    public function getListDataPage() {
        return $reusls = $this->model->paginate(10);
    }

    /**
     * 依「權限」與「查詢條件」取得案件分頁資料
     * @param type $query_case_status 查詢「案件狀態」
     * @param type $query_comp_name 查詢「公司名稱」
     * @param type $query_contact_mail 查詢「聯絡人郵件」
     * @return type
     */
    public function getPaginateDataByAuth($query_case_status = null, $query_comp_name = null, $query_contact_mail = null, $sort = null, $order = null) {

        $authLevel = json_decode(\App\Services\AuthService::authLevel());
        $wherecondition = '1=1 ';

        if (!isset($authLevel)) {
            return null;
        }
        //依權限取得資料
        if (in_array("engineer_head", $authLevel) || in_array("cs_head", $authLevel) || in_array("cs", $authLevel) || in_array("manager", $authLevel)) {
            $query = $this->model
                    ->leftJoin('WebSupport_User', 'WebSupport_User.support_id', '=', 'WebSupport.support_id');
        } else if (in_array("engineer", $authLevel)) {
            $query = $this->model
                    ->leftJoin('WebSupport_User', 'WebSupport_User.support_id', '=', 'WebSupport.support_id');
            $wherecondition = $wherecondition . "AND (WebSupport_User.support_id is null or WebSupport_User.ud_id = '" . \App\Services\AuthService::userID() . "') ";
        } else if (in_array("sales", $authLevel) || in_array("sales_head", $authLevel)) {
            $query = $this->model
                    ->leftJoin('WebSupport_User', 'WebSupport_User.support_id', '=', 'WebSupport.support_id')
                    ->orWhere('WebSupport.case_status', '=', 0);
            $wherecondition = $wherecondition . "AND (WebSupport_User.support_id is null or WebSupport_User.ud_id = '" . \App\Services\AuthService::userID() . "') ";
        }

        //查詢 案件狀態
        if (isset($query_case_status) && $query_case_status != '-1') {
            $wherecondition = $wherecondition . "AND WebSupport.case_status =  " . $query_case_status;
        }
        //查詢 公司名稱
        if (isset($query_comp_name) && strlen($query_comp_name) != 0) {
            $wherecondition = $wherecondition . "AND WebSupport.comp_name LIKE '%" . $query_comp_name . "%' ";
        }
        //查詢 聯絡人E-Mail
        if (isset($query_contact_mail) && strlen($query_contact_mail) != 0) {
            $wherecondition = $wherecondition . "AND WebSupport.contact_mail LIKE '%" . $query_contact_mail . "%' ";
        }
        if(isset($sort)){
            return $results = $query
                ->whereRaw($wherecondition)
                ->select('WebSupport.support_id')
                ->groupBy('WebSupport.support_id')
                ->orderBy('WebSupport'.'.'.$sort,$order)
                ->paginate(10);
        }else{
            return $results = $query
                ->whereRaw($wherecondition)
                ->select('WebSupport.support_id')
                ->groupBy('WebSupport.support_id')
                ->orderBy('WebSupport.support_id','DESC')
                ->paginate(10);
        }
    }

    /**
     * 使用「$case_number_sha1」取得「資料」
     * @param type $case_number_sha1
     * @return type
     */
    public function getDataBySHA1($case_number_sha1) {
        return $this->model->where('case_number_sha1', '=', $case_number_sha1)->first();
    }

    /**
     * 取得超過期限的資料
     * @param type $deadlineType 期限類別。takecase：接案
     * @return type
     */
    public function getDataByDeadline($deadlineType) {

        $columnName = '';
        if ($deadlineType == 'takecase') {
            return $this->model->where('deadline_take', '<=', \Carbon\Carbon::now())
                            ->where('deadline_take_remind', '=', '0')
                            ->where('case_status', '=', '0')
                            ->get();
        } else if ($deadlineType == 'closecase') {
            $columnName = 'deadline_close';
            return $this->model->where('deadline_close', '<=', \Carbon\Carbon::now())
                            ->where('deadline_close_remind', '=', '0')
                            ->where('case_status', '=', '1')
                            ->get();
        }
        return null;
    }

    /**
     * 建立一新的技術支援案件
     * @param array $arraydata
     * @return type
     */
    public function createNewCase(array $arraydata) {

        if (
                !isset($arraydata['comp_name']) || !isset($arraydata['contact_name']) || !isset($arraydata['contact_mail']) || !isset($arraydata['contact_phone'])//
                || !isset($arraydata['pg_id']) || !isset($arraydata['pd_id']) || !isset($arraydata['product_version'])//
                || !isset($arraydata['problem_id']) || !isset($arraydata['problem_parent'])//
                || !isset($arraydata['support_subject']) || !isset($arraydata['support_description'])
        ) {
            return null;
        }

        //取得新案件編號
        $savedata['case_number'] = $this->getNewCaseNumber();
        $savedata['case_number_sha1'] = sha1('sun' . $savedata['case_number'] . 'wai');

        if (isset($arraydata['cd_id'])) {
            $savedata['cd_id'] = $arraydata['cd_id'];
        }
        //新案件
        $savedata['case_status'] = 0;

        $savedata['create_date'] = \Carbon\Carbon::now();
        //要計算
        $savedata['deadline_take'] = $this->getTakeCaseDeadline();
        $savedata['deadline_close'] = $this->getCloseCaseDeadline();

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
        if (isset($arraydata['support_filename'])) {
            $savedata['support_filename'] = $arraydata['support_filename'];
        }


//        $savedata['isflag'] = '1';
//        $savedata['create_date'] = \Carbon\Carbon::now();
//        $savedata['last_update_date'] = \Carbon\Carbon::now();
//        $savedata['create_user'] = $arraydata['create_user'];
//        $savedata['last_update_user'] = $arraydata['last_update_user'];
//
//
//
        //新增資料並回傳「自動遞增KEY值」
        $support_id = $this->model->insertGetId($savedata);

        if (isset($support_id)) {
            return $savedata['case_number'];
        }
        return null;
    }

    /**
     * 建立接案資料
     * @param type $ud_id
     * @param type $support_id
     * @return type
     */
    public function updateTakeCaseData($ud_id, $support_id) {
        if (!isset($ud_id) || !isset($support_id)) {
            return null;
        }

        $savedata['case_status'] = '1';

        $savedata['take_user'] = $ud_id;
        $savedata['take_date'] = \Carbon\Carbon::now();

        return $this->model->where('support_id', '=', $support_id)->update($savedata);
    }

    /**
     * 更新「案件展延資料」
     * @param type $arraydata
     * @param type $support_id
     * @return type
     */
    public function updateExtendData($arraydata, $support_id) {

        if (!isset($support_id)) {
            return null;
        }
        if (!isset($arraydata['extend_reason']) || !isset($arraydata['extend_expect_date'])) {
            return null;
        }

        $savedata['case_status'] = '2';

        $savedata['extend_user'] = \App\Services\AuthService::userID();
        $savedata['extend_date'] = \Carbon\Carbon::now();

        $savedata['extend_reason'] = $arraydata['extend_reason'];
        $savedata['extend_expect_date'] = $arraydata['extend_expect_date'];

        return $this->model->where('support_id', '=', $support_id)->update($savedata);
    }

    /**
     * 更新「案件結案資料」
     * @param type $arraydata
     * @param type $support_id
     * @return type
     */
    public function updateCloseData($arraydata, $support_id) {

        if (!isset($support_id)) {
            return null;
        }
        if (!isset($arraydata['close_description'])) {
            return null;
        }
        if($arraydata['close_carboncopy'] != ''){
            $savedata['close_carboncopy'] = $arraydata['close_carboncopy'];
        }
        if($arraydata['close_blindcarboncopy'] != ''){
            $savedata['close_blindcarboncopy'] = $arraydata['close_blindcarboncopy'];
        }
        if($arraydata['close_to'] != ''){
            $savedata['close_to'] = $arraydata['close_to'];
        }
        $savedata['case_status'] = '3';

        $savedata['close_user'] = \App\Services\AuthService::userID();
        $savedata['close_date'] = \Carbon\Carbon::now();

        $savedata['close_description'] = $arraydata['close_description'];
        if (isset($arraydata['close_filename'])) {
            $savedata['close_filename'] = $arraydata['close_filename'];
        }

        return $this->model->where('support_id', '=', $support_id)->update($savedata);
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

        if (isset($arraydata['case_status'])) {
            $savedata['case_status'] = $arraydata['case_status'];
            if($savedata['case_status'] == 1){
              $savedata['deadline_close'] = $this->getCloseCaseDeadline();
            }
        }
        if (isset($arraydata['cd_id'])) {
            $savedata['cd_id'] = $arraydata['cd_id'];
        }
        if (isset($arraydata['create_date'])) {
            $savedata['create_date'] = $arraydata['create_date'];
        }
        if (isset($arraydata['deadline_take'])) {
            $savedata['deadline_take'] = $arraydata['deadline_take'];
        }
        if (isset($arraydata['deadline_close'])) {
            $savedata['deadline_close'] = $arraydata['deadline_close'];
        }
        /*
          if (isset($arraydata['comp_name'])) {
          $savedata['comp_name'] = $arraydata['comp_name'];
          }
          if (isset($arraydata['contact_name'])) {
          $savedata['contact_name'] = $arraydata['contact_name'];
          }
          if (isset($arraydata['contact_mail'])) {
          $savedata['contact_mail'] = $arraydata['contact_mail'];
          }
          if (isset($arraydata['contact_phone'])) {
          $savedata['contact_phone'] = $arraydata['contact_phone'];
          }
          if (isset($arraydata['pg_id'])) {
          $savedata['pg_id'] = $arraydata['pg_id'];
          }
          if (isset($arraydata['pd_id'])) {
          $savedata['pd_id'] = $arraydata['pd_id'];
          }
          if (isset($arraydata['product_version'])) {
          $savedata['product_version'] = $arraydata['product_version'];
          }
          if (isset($arraydata['problem_id'])) {
          $savedata['problem_id'] = $arraydata['problem_id'];
          }
          if (isset($arraydata['problem_parent'])) {
          $savedata['problem_parent'] = $arraydata['problem_parent'];
          }
          if (isset($arraydata['support_subject'])) {
          $savedata['support_subject'] = $arraydata['support_subject'];
          }
          if (isset($arraydata['support_description'])) {
          $savedata['support_description'] = $arraydata['support_description'];
          }
          if (isset($arraydata['support_filename'])) {
          $savedata['support_filename'] = $arraydata['support_filename'];
          }
         */
        if (isset($arraydata['take_user'])) {
            $savedata['take_user'] = $arraydata['take_user'];
        }
        if (isset($arraydata['take_date'])) {
            $savedata['take_date'] = $arraydata['take_date'];
        }
        if (isset($arraydata['close_user'])) {
            $savedata['close_user'] = $arraydata['close_user'];
        }
        if (isset($arraydata['close_date'])) {
            $savedata['close_date'] = $arraydata['close_date'];
        }
        if (isset($arraydata['close_description'])) {
            $savedata['close_description'] = $arraydata['close_description'];
        }
        if (isset($arraydata['close_filename'])) {
            $savedata['close_filename'] = $arraydata['close_filename'];
        }
        if (isset($arraydata['extend_user'])) {
            $savedata['extend_user'] = $arraydata['extend_user'];
        }
        if (isset($arraydata['extend_date'])) {
            $savedata['extend_date'] = $arraydata['extend_date'];
        }
        if (isset($arraydata['extend_reason'])) {
            $savedata['extend_reason'] = $arraydata['extend_reason'];
        }
        if (isset($arraydata['extend_expect_date'])) {
            $savedata['extend_expect_date'] = $arraydata['extend_expect_date'];
        }







        return $this->model->where('support_id', '=', $primarykey)->update($savedata);
    }

    /**
     * 刪除該「$primarykey」的資料
     * @param type $primarykey 主鍵值
     */
    public function delete($primarykey) {
        return $this->model->where($this->model->primaryKey, '=', $primarykey)->delete();
    }

    /**
     * 取得新的案件編號
     * @return type
     */
    public function getNewCaseNumber() {
        $datenow = \Carbon\Carbon::now();

        $dateString = $datenow->format('Ymd-');

        $numberdata = $this->model->where('case_number', 'like', $dateString . '%')->orderBy('case_number', 'desc')->first();

        if (count($numberdata) == 0) {
            return $dateString . sprintf("%03s", 1);
        }

        return $dateString . sprintf("%03s", substr($numberdata->case_number, 9, 3) + 1);
    }

    /**
     * 取得某月休假日表
     * @param type $date 年月日時分秒
     */
    public function getMonthData($date) {
      $y = $date->year;
      $m = $date->month;
      $datearray['c_year'] = $y;
      $datearray['c_month'] = $m;
      $date = \App\Repositories\WebHolidayRepository::withNew()->getDataByDate($datearray);
      if(count($date) == 0){
        \App\Repositories\WebHolidayRepository::withNew()->create($datearray);
        $date = \App\Repositories\WebHolidayRepository::withNew()->getDataByDate($datearray);
      }
      return $date;
    }

    /**
     * 取得未接案期限
     */
    public function getTakeCaseDeadline() {
        $datenow = \Carbon\Carbon::now();
        $datedeadline = $this->takeCaseCheckHoliday($datenow);

        return $datedeadline;
    }

    /**
     * 未接案期限設定
     * 判斷是否為休假日
     * @param type $datetime
     */
    private function takeCaseCheckHoliday($datetime) {
      $date = $this->getMonthData($datetime);
      foreach($date as $qqq ){
        // 排除小於$datetime日期
        if($qqq->c_day < $datetime->day){
          continue;
        }
        // 排除是假日的
        if($qqq->c_is_holiday != 0){
          $datetime->addDays(1);
          continue;
        }
        // 案件建立當天是上班日，但是加總時間超過上班時間，會將剩餘的時間加到另一天的上班日
        if(isset($datedeadlinehour)){
          $datetime = $datetime->hour(0)->addHours(WebSupportRepository::$worktime)->addHours($datedeadlinehour)->minute(0)->second(0);
          break;
        }
        // 案件建立當天是上班日
        if($qqq->c_day == \Carbon\Carbon::now()->day){
          $datetime->addHours(WebSupportRepository::$takecasedeadline);
          if($datetime->hour >= WebSupportRepository::$offworktime){
            $datedeadlinehour = $datetime->hour - WebSupportRepository::$offworktime;
            $datetime->addDays(1);
            continue;
          }else{
            break;
          }
        }
        $datetime->hour(0)->addHours(WebSupportRepository::$takecasedeadline)->addHours(WebSupportRepository::$worktime)->minute(0)->second(0);
        break;
      }
      return $datetime;
    }

    /**
     * 取得結案期限
     * @param type $date
     */
    public function getCloseCaseDeadline() {
        $datenow = \Carbon\Carbon::now();
        $datedeadline = $this->closeCaseCheckHoliday($datenow);
        return $datedeadline;
    }

    /**
     * 結案期限設定
     * 判斷是否為休假日
     * @param type $date
     */
    private function closeCaseCheckHoliday($datecheck) {
      $date = $this->getMonthData($datecheck);
      $days = WebSupportRepository::$closecasedeadline+1;
      foreach($date as $qqq ){
        if($qqq->c_day < $datecheck->day){
          continue;
        }
        if($qqq->c_is_holiday != 0){
          $datecheck->addDays(1);
          continue;
        }
        $days = $days-1;
        if($days != 0){
          $datecheck->addDays(1);
          continue;
        }
        break;
      }
      return $datecheck;
    }

//     /**
//      * 取得未結案期限
//      * @param type $date
//      */
//     private function getCloseCaseDeadline() {
//         $datenow = \Carbon\Carbon::now();
//         //$work = \Carbon\Carbon::now()->addDays(1)->hour(9)->minute(0)->second(0);
//         //$offwork = \Carbon\Carbon::now()->hour(18)->minute(0)->second(0);


//         $datenow->addDays(2);

// //        if ($datenow->gt($offwork)) {
// //            return $work->addHours(2);
// //        }
//         return $datenow;
//     }

}
