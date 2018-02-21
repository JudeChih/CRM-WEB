<?php

namespace App\Http\Controllers\ViewControllers\SupportCase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\WebSupportRepository;
use \Illuminate\Support\Facades\View;
use Session;

class SupportCaseCustomerController extends Controller {

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
     * View〔 case_sales 〕Route GET
     * @param Request $request
     * @return type
     */
    function supportCaseCustomerGET(Request $request) {

        $this->readSession($support_id, $querycondition);

        if (!isset($support_id)) {
            return \Illuminate\Support\Facades\Redirect::route('caselist');
        }

        $customerlist = \App\Repositories\CrmCustomerDataRepository::withNew()->getPaginateCustomerByName(isset($querycondition) ? $querycondition : '');
        return View::make('supportcase.case_customer', compact('support_id', 'querycondition', 'customerlist'));
    }

    /**
     * View〔 case_customer 〕ACTION
     * @param Request $request
     * @return type
     */
    function supportCaseCustomer(Request $request) {

        if (isset($request->submit) && $request->submit == 'customer') {
            return $this->queryCustomer($request);
        }

        if (isset($request->actiontype)) {
            if ($request->actiontype == 'search') {
                return $this->queryCustomer($request);
            } else if ($request->actiontype == 'save') {
                return $this->saveSupportCaseCustomer($request);
            }
        }
        //參數錯誤導回「CaseList」
        return \Illuminate\Support\Facades\Redirect::route('caselist');
    }

    /**
     * View [ case_customer ] Action，「Query」按鈕事件，查詢資料
     * @param Request $request
     * @return type
     */
    private function queryCustomer(Request $request) {

        $querycondition = '';
        $support_id = '';
        if (isset($request->querycondition)) {
            $querycondition = $request->querycondition;
        }
        if (isset($request->support_id)) {
            $support_id = $request->support_id;
        }

        $customerlist = \App\Repositories\CrmCustomerDataRepository::withNew()->getPaginateCustomerByName($querycondition);
        return View::make('supportcase.case_customer', compact('support_id', 'querycondition', 'customerlist'));
    }

    /**
     * View [ case_customer ] Action，按鈕事件，檢查並儲存資料
     * @param Request $request
     * @return type
     */
    public function saveSupportCaseCustomer(Request $request) {
        Session::put('support_id', $request->support_id);
        Session::put('querycondition', $request->querycondition);

        if (!isset($request->password) || !\App\Services\AuthService::checkPassword($request->password)) {

            return \Illuminate\Support\Facades\Redirect::route('casedetail/setcustomer')->withErrors(['error' => '密碼輸入錯誤！！']);
        }

        //更新「WebSupport.cd_id」
        $savedata['cd_id'] = $request->cd_id;
        $result = $this->repository->update($savedata, $request->support_id);

        if (isset($result)) {
            Session::forget('querycondition');
            return \Illuminate\Support\Facades\Redirect::route('casedetail')->withErrors(['error' => '客戶設定成功']);
            //return \Illuminate\Support\Facades\Redirect::route('casedetail')->with('success', '客戶設定成功');
        } else {
            return \Illuminate\Support\Facades\Redirect::route('casedetail/setcustomer')->withErrors(['error' => '系統異常請稍候再試！！']);
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
