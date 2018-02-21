<?php

namespace App\Http\Controllers\ViewControllers\SupportCase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\WebSupportRepository;
use \Illuminate\Support\Facades\View;
use Session;

class SupportCaseExtendController extends Controller {

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
     * View〔 case_extend 〕Route GET
     * @param Request $request
     * @return type
     */
    function supportCaseExtendGET(Request $request) {

        $this->readSession($support_id);

        if (!isset($support_id)) {
            return \Illuminate\Support\Facades\Redirect::route('caselist');
        }

        $casedata = $this->repository->getData($support_id);

        return View::make('supportcase.case_extend', compact('casedata'));
    }

    /**
     * View〔 case_extend 〕ACTION
     * @param Request $request
     * @return type
     */
    function supportCaseExtend(Request $request) {

        if (isset($request->actiontype) && $request->actiontype == 'save') {
            echo json_encode($request->all());
            return $this->saveEngineerExtendCase($request);
        }
        //參數錯誤導回「CaseList」
        return \Illuminate\Support\Facades\Redirect::route('caselist');
    }

    /**
     * View [ case_take_engineer ] Action，按鈕事件，檢查並儲存資料
     * @param Request $request
     * @return type
     */
    private function saveEngineerExtendCase(Request $request) {
        Session::put('support_id', $request->support_id);

        if (!isset($request->password) || !\App\Services\AuthService::checkPassword($request->password)) {

            return \Illuminate\Support\Facades\Redirect::route('casedetail/extendcase')->withInput()->withErrors(['error' => '密碼輸入錯誤！！']);
        }

        $filename = null;
        //檢查是否有檔案
        if ($request->hasFile('close_filename')) {
            $filename = \App\Services\FileUploadService::SaveCloseSupportCaseFile($request->file('close_filename'));
            if (!isset($filename)) {
                return redirect()->back()->withInput()->withErrors(['error' => '檔案上傳失敗！！']);
            }
        }

        $data = $request->all();

        //更新「WebSupport」展延資料
        $result = $this->repository->updateExtendData($data, $request->support_id);

        if (isset($result)) {
            return \Illuminate\Support\Facades\Redirect::route('casedetail')->withErrors(['error' => '案件展延成功']);
        } else {
            return \Illuminate\Support\Facades\Redirect::route('casedetail/extendcase')->withInput()->withErrors(['error' => '系統異常請稍候再試！！']);
        }
    }

    /**
     * 讀取「Session」並清除
     * @param type $support_id
     * @param type $querycondition
     */
    function readSession(&$support_id) {
        $support_id = Session::get('support_id');

        Session::forget('support_id');
    }

}
