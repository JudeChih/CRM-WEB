<?php

namespace App\Http\Controllers\ViewControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\View;

//use App\Repositories\WebApplyTestRepository;

class ApplyTestController extends Controller {

    protected $repository;

    /**
     *  constructor.
     *
     * @param 
     */
    public function __construct(\App\Repositories\WebApplyTestRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * View [ ApplyService ] Route
     * @return type
     */
    function applyService() {

        $productgroup = \App\Repositories\WebProductGroupRepository::withNew()->getApplyTestGroup();
        $productdata = \App\Repositories\WebProductDataRepository::withNew()->getDropDownListDataSupport();


        return View::make('applytest.apply_service', compact('productgroup', 'productdata'));
    }

    /**
     * View [ ApplyService ] Action
     * @param Request $request
     * @return type
     */
    function createApplyTestData(Request $request) {

        if (!isset($request['g-recaptcha-response']) || !$this->checkreCAPTCHA($request['g-recaptcha-response'])) {
            return redirect()->back()->withInput()->withErrors(['error' => '請輸入驗證碼！！']);
        }


        $primarykey = $this->repository->create($request->all());

        if (isset($primarykey)) {
            return View::make('applytest.apply_success');
        }

        return redirect()->back()->withInput()->withErrors(['error' => '系統異常請稍候再試！！']);
    }

    function checkreCAPTCHA($recaptcha) {

        $Response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LcBIA4UAAAAAI8UJvYjWeOOOmAyhU-KgKpSvYl4&response=' . $recaptcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);

        $reponse = json_decode($Response);

        if ($reponse->success) {
            return true;
        }
        return false;
    }

}
