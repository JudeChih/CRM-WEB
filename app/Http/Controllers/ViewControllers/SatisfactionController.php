<?php

namespace App\Http\Controllers\ViewControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\WebSupportRepository;
use \Illuminate\Support\Facades\View;

class SatisfactionController extends Controller {

    /**
     * View [ CloseSatisfaction ] Route 開啟「結案滿意度調查」頁面
     * @return type
     */
    function closeSatisfaction($case_number) {

        if ($case_number == 'success') {
            return View::make('support.close_satisfaction_success');
        }
        $support_id = $this->checkCaseNumberSHA1($case_number);

        if (!isset($support_id)) {
            return \Illuminate\Support\Facades\Redirect:: to('http://www.sunwai.com');
        }

        $satisfaction = \App\Repositories\WebSatisfactionSurveyRepository::withNew()->getCloseSatisfactionData();

        return View::make('support.close_satisfaction', compact('support_id', 'satisfaction'));
    }

    /**
     * View [ CloseSatisfaction ] Action
     * @param Request $request
     * @return type
     */
    function closeSatisfactionSave(Request $request) {
        try {

            $support_id = $this->checkCaseNumberSHA1($request->case_number);
            $casedata = \App\Repositories\WebSupportRepository::withNew()->getData($request->support_id);
            if (!isset($casedata) || count($casedata) <= 0 || $casedata->case_status != 3) {
                return \Illuminate\Support\Facades\Redirect:: to('/support/closesatisfaction/success');
            }

            \Illuminate\Support\Facades\DB::beginTransaction();

            $result = \App\Repositories\WebSatisfactionScoreRepository::withNew()->create($request->all());

            $result2 = WebSupportRepository::withNew()->update(['case_status' => '4'], $request->support_id);
            if (!isset($result) || !isset($result2)) {
                \Illuminate\Support\Facades\DB::rollback();
                return redirect()->back()->withInput()->withErrors(['error' => '系統異常請稍候再試！！']);
            }
            \Illuminate\Support\Facades\DB::commit();
            $boolean = 1;
            $data = \App\Repositories\WebSatisfactionSurveyRepository::withNew()->getCloseSatisfactionData();
            $len = count($data);
            for($i=1;$i<=$len;$i++){
              $score = 'score'.sprintf("%02s", $i);
              $num = $request->$score;
              switch($num){
                case '1':
                  $boolean = null;
                  break;
                case '2':
                  $boolean = null;
                  break;
                default:
                  break;
              }
            }
            if(!isset($boolean)){
              \App\Services\EMailService::send_SatisfactionReaction($request->support_id);
            }
            return \Illuminate\Support\Facades\Redirect:: to('/support/closesatisfaction/success');
        } catch (\Exception $ex) {
            \Illuminate\Support\Facades\DB::rollback();
            return \Illuminate\Support\Facades\Redirect:: to('/support/closesatisfaction/success');
        }
    }

    /**
     * 檢查案件編號是否存在
     * @param type $caseNumberSHA1
     * @return type support_ID
     */
    private static function checkCaseNumberSHA1($caseNumberSHA1) {

        $casedata = \App\Repositories\WebSupportRepository::withNew()->getDataBySHA1($caseNumberSHA1);

        //檢查是否有值
        if (!isset($casedata) || count($casedata) <= 0 || $casedata->case_status != 3) {
            return null;
        }

        /*
          //檢查是否已評分過
          $score = \App\Repositories\WebSatisfactionScoreRepository::withNew()->getDataBySupportID($casedata->support_id);
          if (isset($score) || count($score > 0)) {
          return null;
          }
         */
        return $casedata->support_id;
    }

}
