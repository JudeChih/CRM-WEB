<?php

namespace App\Http\Controllers\ViewControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\WebSupportUserRepository;
use Mail;

class SupportUserController extends Controller {

    protected $websupportuserrepository;

    /**
     *  constructor.
     *
     * @param
     */
    public function __construct(WebSupportUserRepository $websupportuserrepository) {
        $this->websupportuserrepository = $websupportuserrepository;
    }

    /**
     * View [ SupportService ] Route
     * @return type
     */
    function supportService() {

        $problemlist = \App\Repositories\WebProblemCategoryRepository::withNew()->getProblemCategory();

        $grouplist = \App\Repositories\WebProductGroupRepository::withNew()->getSupportCaseGroup();

        $data = ['problem' => $problemlist, 'productgroup' => $grouplist];

        return view('support.supportUserRegister', compact('problemlist', 'grouplist', 'problemsublist'));
    }

    /**
     * View [ SupportService ] Action
     * @param Request $request
     * @return type
     */
    function createSupportCase(Request $request) {

        // $case_number = $this->websupportrepository->createNewCase($request->all());
        // //https://laravel.tw/docs/5.2/mail
        // // Mail::raw('測試使用 Laravel 5 的 Gmail 寄信服務', function($message)
        // // {
        // //     $message->to('sausage760703@gmail.com');
        // // });

        // if (isset($case_number)) {
        //     return view('support.supportsuccess', compact('case_number'));
        // }

        // return redirect()->back()->withInput()->withErrors(['error' => '系統異常請稍候再試！！']);
    }

    /**
     * 取得問題子類別
     * @param type $id
     * @return type
     */
    function getProgramSubList($id) {

        // $problemsublist = \App\Repositories\WebProblemCategoryRepository::withNew()->getSubProblemCategory($id);

        // return $problemsublist;
    }

    /**
     * 取得產品資料
     * @param type $id
     * @return type
     */
    function getProductData($id) {

        // $problemsublist = \App\Repositories\WebProductDataRepository::withNew()->getProductPluck($id);

        // return $problemsublist;
    }

}
