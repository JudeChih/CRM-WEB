<?php

namespace App\Http\Controllers\ViewControllers\SupportCase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\WebSupportRepository;
use \Illuminate\Support\Facades\View;
use Session;

class SupportCaseDetailController extends Controller {

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
     * View [ case_list ] Action，選取資料事件，開啟頁面「技術支援案件明細」並傳入「明細資料」
     * @param Request $request
     * @return type
     */
    function supportCaseDetailGET() {
        $supportID = Session::get('support_id');
        Session::forget('support_id');

        if (!isset($supportID)) {
            return \Illuminate\Support\Facades\Redirect::route('caselist');
        }

        $casedata = $this->repository->getData($supportID);

        return View::make('supportcase.case_detail', compact('casedata'));
    }

    /**
     * View [ case_list ] Action，選取資料事件，開啟頁面「技術支援案件明細」並傳入「明細資料」
     * @param Request $request
     * @return type
     */
    function supportCaseDetail(Request $request) {
        if (!isset($request->submit)) {
            $casedata = $this->repository->getData($request->support_id);
            return View::make('supportcase.case_detail', compact('casedata'));
        }

        switch (strtolower($request->submit)) {
            case 'setcustomer':
                Session::put('support_id', $request->support_id);
                return \Illuminate\Support\Facades\Redirect::route('casedetail/setcustomer');
            case 'setsales':
                Session::put('support_id', $request->support_id);
                return \Illuminate\Support\Facades\Redirect::route('casedetail/setsales');
            case 'setsupportcase':
                Session::put('support_id', $request->support_id);
                return \Illuminate\Support\Facades\Redirect::route('casedetail/setsupportcase');
            case 'settakecase':
                Session::put('support_id', $request->support_id);
                return \Illuminate\Support\Facades\Redirect::route('casedetail/settakecase');
            case 'takecase':
                return $this->engineerTakeCase($request);
            case 'extendcase':
                Session::put('support_id', $request->support_id);
                return \Illuminate\Support\Facades\Redirect::route('casedetail/extendcase');
                break;
            case 'closecase':
                Session::put('support_id', $request->support_id);
                return \Illuminate\Support\Facades\Redirect::route('casedetail/closecase');
                break;
        }
    }

    /**
     * Commit Value〔takecase〕，執行「工程師接案」
     * @param Request $request
     * @return type
     */
    private function engineerTakeCase(Request $request) {
        //檢查密碼
        if (!isset($request->password) || !\App\Services\AuthService::checkPassword($request->password)) {
            Session::put('support_id', $request->support_id);
            return \Illuminate\Support\Facades\Redirect::route('casedetail')->withErrors(['error' => '客戶設定成功']);
        }
        //建立「WebSupport_User」資料
        $result = SupportCaseDetailController::createWebSupportUser($request->support_id, \App\Services\AuthService::userID(), '1');

        if ($result) {
            Session::put('support_id', $request->support_id);
            return \Illuminate\Support\Facades\Redirect::route('casedetail')->with('success', '接案成功');
        } else {
            Session::put('support_id', $request->support_id);
            return \Illuminate\Support\Facades\Redirect::route('casedetail')->withErrors(['error' => '系統異常請稍候再試！！']);
        }
    }

    /**
     * 建立「WebSupport_User」資料
     * @param type $support_id 案件代碼
     * @param type $ud_id 使用者代碼
     * @param type $user_role 使用者角色。１：接案工程師、２：支援工程師、３：業務
     * @return boolean
     */
    public static function createWebSupportUser($support_id, $ud_id, $user_role) {

        if (!isset($support_id) || !isset($ud_id) || !isset($user_role)) {
            return false;
        }
        try {

            \Illuminate\Support\Facades\DB::beginTransaction();
            $resultdelete = \App\Repositories\WebSupportUserRepository::withNew()->deleteUserByUserRole($support_id, $user_role);

            $dataarray['support_id'] = $support_id;
            $dataarray['ud_id'] = $ud_id;
            $dataarray['user_role'] = $user_role;
            $result1 = \App\Repositories\WebSupportUserRepository::withNew()->create($dataarray);

            if (!isset($resultdelete) || !isset($result1)) {
                \Illuminate\Support\Facades\DB::rollback();
                return false;
            }

            if ($user_role == 1) {
                $savedata['case_status'] = '1';
                $savedata['take_user'] = $ud_id;
                $savedata['take_date'] = \Carbon\Carbon::now();
                $result2 = WebSupportRepository::withNew()->update($savedata, $support_id);

                if (!isset($result2)) {
                    \Illuminate\Support\Facades\DB::rollback();
                    return false;
                }
            }
            \Illuminate\Support\Facades\DB::commit();
            return true;
        } catch (\Exception $ex) {
            \Illuminate\Support\Facades\DB::rollback();
            return false;
        }
    }

}
