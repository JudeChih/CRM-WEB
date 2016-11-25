<?php

namespace App\Http\Controllers\ViewControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\WebSupportRepository;

class SupportCaseController extends Controller {

    protected $repository;

    /**
     *  constructor.
     *
     * @param
     */
    public function __construct(WebSupportRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * View [ case_list ] Route，開啟頁面「技術支援案件列表」並傳入「列表資料」
     * @param Request $request
     */
    public function supportCaseList(Request $request) {

        $caselist = $this->repository->getListDataPage();

        return view('\supportcase.case_list', compact('caselist'));
    }

    /**
     * View [ case_list ] Action，選取資料事件，開啟頁面「技術支援案件明細」並傳入「明細資料」
     * @param Request $request
     * @return type
     */
    function supportCaseDetail(Request $request) {
        echo 'supportCaseDetail';
        //return;
        $casedata = $this->repository->getData($request->support_id);
        $auth = 'manager';
        //echo json_encode($casedata, false);
        //return;
        return view('\supportcase.case_detail', compact('casedata', 'auth'));
    }

    /**
     * View [ case_detail ] Action，按鈕事件，判斷「Submit.value」執行事件
     * @param Request $request
     * @return type
     */
    function supportCaseDetailAction(Request $request) {
        $casedata = $this->repository->getData($request->support_id);
        $auth = 'manager';
        //return $this->detailActionSales($request);
        if($request->submit == 'takecase' && $request->password != '123'){
            return view('\supportcase.case_detail', compact('casedata', 'auth'))->withErrors(['error' => '密碼錯誤，請重新輸入']);
        }else{
            echo json_encode($request->all(), false);
            echo '<br>';
            $controller = new SupportCaseQueryController();

            switch (strtolower($request->submit)) {
                case 'customer':
                    return $controller->detailActionCustomer($request);
                case 'sales':
                    return $controller->detailActionSales($request);
                case 'takeengineer':
                    return $controller->detailActionTakeEngineer($request);
                case 'supportengineer':
                    return $controller->detailActionSupportEngineer($request);
                case 'takecase':
                    return $this->detailActionTakeCase($request);
                case 'extendcase':
                    return $this->detailActionExtendClose($request);
                case 'closecase':
                    return $this->detailActionExtendClose($request);
            }
        }
    }

    /**
     * Commit Value〔takecase〕，執行「工程師接案」
     * @param Request $request
     * @return type
     */
    private function detailActionTakeCase(Request $request) {
        echo 'detailActionTakeCase';
        $casedata = $this->repository->getData($request->support_id);
        $auth = 'manager';
        $pass = $request->password;
        return view('\supportcase.case_detail', compact('casedata', 'auth'))->with('success', '密碼'.$pass.'的工程師接案成功');
    }

    /**
     * Commit Value〔extendcase〕或〔closecase〕，開啟頁面「技術支援案件結案展延」
     * @param Request $request
     * @return type
     */
    private function detailActionExtendClose(Request $request) {
        $submit = $request->submit;
        $casedata = $this->repository->getData($request->support_id);
        echo 'detailActionExtendClose';
        return view('supportcase.case_extendclose', compact('casedata','submit'));
    }

}
