<?php

namespace App\Http\Controllers\ViewControllers\SupportCase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\WebSupportRepository;
use \Illuminate\Support\Facades\View;
use Session;

class SupportCaseCloseController extends Controller {

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
     * View〔 case_close 〕Route GET
     * @param Request $request
     * @return type
     */
    function supportCaseCloseGET(Request $request) {

        $this->readSession($support_id, $close_description);

        if (!isset($support_id)) {
            return \Illuminate\Support\Facades\Redirect::route('caselist');
        }

        $casedata = $this->repository->getData($support_id);

        return View::make('supportcase.case_close', compact('casedata', 'close_description'));
    }

    /**
     * View〔 case_close 〕ACTION
     * @param Request $request
     * @return type
     */
    function supportCaseClose(Request $request) {

        if (isset($request->actiontype)) {
            echo json_encode($request->all());
            return $this->saveEngineerCloseCase($request);
        }
        //參數錯誤導回「CaseList」
        return \Illuminate\Support\Facades\Redirect::route('caselist');
    }

    /**
     * View [ case_take_engineer ] Action，按鈕事件，檢查並儲存資料
     * @param Request $request
     * @return type
     */
    private function saveEngineerCloseCase(Request $request) {
        Session::put('support_id', $request->support_id);
        Session::put('close_description', $request->close_description);

        if (!isset($request->password) || !\App\Services\AuthService::checkPassword($request->password)) {

            return \Illuminate\Support\Facades\Redirect::route('casedetail/closecase')->withInput()->withErrors(['error' => '密碼輸入錯誤！！']);
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

        $data['support_id'] = $request->support_id;
        $data['close_description'] = $request->close_description;
        $data['close_filename'] = $filename;
        $data['close_carboncopy'] = $request->close_carboncopy;
        $data['close_blindcarboncopy'] = $request->close_blindcarboncopy;
        $data['close_to'] = $request->close_to;

        //更新「WebSupport」結案資料
        $result = $this->repository->updateCloseData($data, $request->support_id);

        if (isset($result)) {
            Session::forget('close_description');
            //寄送信件「結案滿意度調查」
            \App\Services\EMailService::send_CloseSatisfaction($request->support_id);
            \App\Services\EMailService::send_CloseCaseCopy($request->support_id);

            return \Illuminate\Support\Facades\Redirect::route('casedetail')->withErrors(['error' => '案件結案成功']);
        } else {
            return \Illuminate\Support\Facades\Redirect::route('casedetail/closecase')->withInput()->withErrors(['error' => '系統異常請稍候再試！！']);
        }
    }

    /**
     * 讀取「Session」並清除
     * @param type $support_id
     * @param type $querycondition
     */
    function readSession(&$support_id, &$close_description) {
        $support_id = Session::get('support_id');
        $close_description = Session::get('close_description');

        Session::forget('support_id');
        Session::forget('close_description');
    }

}
