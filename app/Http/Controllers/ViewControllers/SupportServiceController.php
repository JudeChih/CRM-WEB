<?php

namespace App\Http\Controllers\ViewControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\WebSupportRepository;
use \Illuminate\Support\Facades\View;

class SupportServiceController extends Controller {

    protected $repository;

    /**
     *  constructor.
     *
     * @param
     */
    public function __construct(WebSupportRepository $repository) {
        $this->repository = $repository;
    }

    public function testtest(){
        $data = $this->repository->getTakeCaseDeadline();
        return View::make('test.deadline', compact('data'));
    }

    /**
     * View [ SupportService ] Route 開啟「技術支援服務」頁面
     * @return type
     */
    function supportService() {

        $productgroup = \App\Repositories\WebProductGroupRepository::withNew()->getDropDownListDataSupport();
        $productdata = \App\Repositories\WebProductDataRepository::withNew()->getDropDownListDataSupport();

        $problemcategory = \App\Repositories\WebProblemCategoryRepository::withNew()->getDropDownListDataSupport();
        $subproblemcategory = \App\Repositories\WebProblemCategoryRepository::withNew()->getSubDropDownListDataSupport();

        return View::make('support.support_service', compact('productgroup', 'productdata', 'problemcategory', 'subproblemcategory'));
    }

    /**
     * View [ SupportService ] Action 建立「技術支援服務」資料
     * @param Request $request
     * @return type
     */
    function createSupportCase(Request $request) {

        if (!isset($request['g-recaptcha-response']) || !$this->checkreCAPTCHA($request['g-recaptcha-response'])) {
            return redirect()->back()->withInput()->withErrors(['error' => '請輸入驗證碼！！']);
        }

        $filename = null;
        //檢查是否有檔案
        if ($request->hasFile('support_filename')) {
            $filename = \App\Services\FileUploadService::SaveNewSupportCaseFile($request->file('support_filename'));
            if (!isset($filename)) {
                return redirect()->back()->withInput()->withErrors(['error' => '檔案上傳失敗！！']);
            }
        }
        $data = $request->all();
        $data['support_filename'] = $filename;
        $data['cd_id'] = $this->checkExistCustomer($request->contact_mail);

        //儲存資料並取得案件編號
        $case_number = $this->repository->createNewCase($data);

        if (isset($case_number)) {
            \App\Services\EMailService::send_NewCaseEngineer($case_number);
            \App\Services\EMailService::send_NewCaseCustomer($case_number);
            return View::make('support.support_success', compact('case_number'));
        }

        return redirect()->back()->withInput()->withErrors(['error' => '系統異常請稍候再試！！']);
    }

    /**
     * 檢查驗證碼
     * @param type $recaptcha
     * @return boolean
     */
    function checkreCAPTCHA($recaptcha) {

        $Response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LcBIA4UAAAAAI8UJvYjWeOOOmAyhU-KgKpSvYl4&response=' . $recaptcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);

        $reponse = json_decode($Response);

        if ($reponse->success) {
            return true;
        }
        return false;
    }

    /**
     * 使用「聯絡人郵件」檢查是否為已存在的客戶
     * @param type $contact_mail 聯絡人郵件
     * @return string
     */
    public static function checkExistCustomer($contact_mail) {
        $repository = new \App\Repositories\CrmCustomerContactRepository();

        $result = $repository->getDataByCCEmail($contact_mail);

        if (isset($result) && count($result) != 0) {
            return $result->cd_id;
        }
        return '';
    }
}
