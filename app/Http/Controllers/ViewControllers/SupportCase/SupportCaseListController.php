<?php

namespace App\Http\Controllers\ViewControllers\SupportCase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\WebSupportRepository;
use \Illuminate\Support\Facades\View;
use Session;

class SupportCaseListController extends Controller {

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
     * View [ case_list ] Route，開啟頁面「技術支援案件列表」並傳入「列表資料」
     * @param Request $request
     */
    public function supportCaseList(Request $request) {

        //echo 'supportCaseList<br>';
        //echo json_encode($request->all()) . '<br>';

        $query_case_status = null;
        $query_comp_name = null;
        $query_contact_email = null;

        $query_case_status = Session::get('query_case_status');
        $query_comp_name = Session::get('query_comp_name');
        $query_contact_email = Session::get('query_contact_email');
        /*
          echo 'query_case_status:' . $query_csae_status . '<br>';
          echo 'query_comp_name:' . $query_comp_name . '<br>';
          echo 'query_contact_email:' . $query_contact_email . '<br>';
         *
         */
        /*
          echo $caselist;
          if (isset($request->query_csae_status) && $request->query_csae_status != '-1') {
          $query_csae_status = $request->query_csae_status;
          }
          echo 'www' . $query_csae_status;
         */

        if(isset($_GET['sort'])){
          $sort = $_GET['sort'];
          $order = $_GET['order'];
        }else{
          $sort = null;
          $order = null;
        }


        $caselist = $this->repository->getPaginateDataByAuth($query_case_status, $query_comp_name, $query_contact_email, $sort, $order);

        return View::make('supportcase.case_list', compact('caselist', 'query_case_status', 'query_comp_name', 'query_contact_email','sort','order'));
    }

    public function supportCaseListQuery(Request $request) {
//        echo 'supportCaseListQuery<br>';
//        echo json_encode($request->all()) . '<br>';

        if (!isset($request->actiontype) || !isset($request->submit) || $request->actiontype != 'search' || $request->submit != 'search') {

            Session::forget('query_case_status');
            Session::forget('query_comp_name');
            Session::forget('query_contact_email');

            return \Illuminate\Support\Facades\Redirect::route('caselist')->withInput();
        }
        $query_case_status = null;
        $query_comp_name = null;
        $query_contact_email = null;

        if (isset($request->query_case_status)) {
            $query_case_status = $request->query_case_status;
        }
        if (isset($request->query_comp_name)) {
            $query_comp_name = $request->query_comp_name;
        }
        if (isset($request->query_contact_email)) {
            $query_contact_email = $request->query_contact_email;
        }
        Session::put('query_case_status', $query_case_status);
        Session::put('query_comp_name', $query_comp_name);
        Session::put('query_contact_email', $query_contact_email);



        return \Illuminate\Support\Facades\Redirect::route('caselist')->withInput();
    }

}
