<?php

namespace App\Http\Controllers\ViewControllers\SupportCase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\WebSupportRepository;
use \Illuminate\Support\Facades\View;
use Session;

class SupportCaseTakeController extends Controller {

    protected $repository;

    /**
     *  constructor.
     *
     * @param 
     */
    public function __construct(WebSupportRepository $repository = null) {

        if (is_null($repository)) {
            $this->repository = WebSupportRepository::withNew();
        } else {
            $this->repository = $repository;
        }
    }

    /**
     * View〔 case_engineer_take 〕Route GET
     * @param Request $request
     * @return type
     */
    function supportCaseTakeGET(Request $request) {

        $this->readSession($support_id, $querycondition);

        if (!isset($support_id)) {
            return \Illuminate\Support\Facades\Redirect::route('caselist');
        }

        $engineerlist = \App\Repositories\CrmUserDataRepository::withNew()->getEngineerListByCondition(isset($querycondition) ? $querycondition : '');

        return View::make('supportcase.case_engineer_take', compact('support_id', 'querycondition', 'engineerlist'));
    }

    /**
     * View〔 case_engineer_take 〕ACTION
     * @param Request $request
     * @return type
     */
    function supportCaseTake(Request $request) {

        if (isset($request->submit) && $request->submit == 'takecase') {
            return $this->queryEngineerTakeCase($request);
        }

        if (isset($request->actiontype)) {
            if ($request->actiontype == 'search') {
                return $this->queryEngineerTakeCase($request);
            } else if ($request->actiontype == 'save') {
                return $this->saveEngineerTakeCase($request);
            }
        }
        //參數錯誤導回「CaseList」
        return \Illuminate\Support\Facades\Redirect::route('caselist');
    }

    /**
     * View [ case_take_engineer ] Action，「Query」按鈕事件，查詢資料
     * @param Request $request
     * @return type
     */
    private function queryEngineerTakeCase(Request $request) {

        $querycondition = '';
        $support_id = '';
        if (isset($request->querycondition)) {
            $querycondition = $request->querycondition;
        }
        if (isset($request->support_id)) {
            $support_id = $request->support_id;
        }

        $engineerlist = \App\Repositories\CrmUserDataRepository::withNew()->getEngineerListByCondition($querycondition);

        return View::make('supportcase.case_engineer_take', compact('support_id', 'querycondition', 'engineerlist'));
    }

    /**
     * View [ case_take_engineer ] Action，按鈕事件，檢查並儲存資料
     * @param Request $request
     * @return type
     */
    private function saveEngineerTakeCase(Request $request) {

        Session::put('support_id', $request->support_id);
        Session::put('querycondition', $request->querycondition);

        if (!isset($request->password) || !\App\Services\AuthService::checkPassword($request->password)) {

            return \Illuminate\Support\Facades\Redirect::route('casedetail/settakecase')->withErrors(['error' => '密碼輸入錯誤！！']);
        }

        //建立「WebSupport_User」資料
        $result = SupportCaseDetailController::createWebSupportUser($request->support_id, $request->ud_id, '1');

        if ($result) {
            Session::forget('querycondition');
            return \Illuminate\Support\Facades\Redirect::route('casedetail')->withErrors(['error' => '接案工程師設定成功']);
            //return \Illuminate\Support\Facades\Redirect::route('casedetail')->with('success', '接案工程師設定成功');
        } else {
            return \Illuminate\Support\Facades\Redirect::route('casedetail/settakecase')->withErrors(['error' => '系統異常請稍候再試！！']);
        }
    }

    /**
     * 讀取「Session」並清除
     * @param type $support_id
     * @param type $querycondition
     */
    function readSession(&$support_id, &$querycondition) {
        $support_id = Session::get('support_id');
        $querycondition = Session::get('querycondition');

        Session::forget('support_id');
        Session::forget('querycondition');
    }

}
