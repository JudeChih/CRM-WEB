<?php

namespace App\Http\Controllers\ViewControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\WebSupportRepository;

class SupportController extends Controller {

    protected $repository;

    /**
     *  constructor.
     *
     * @param 
     */
    public function __construct(WebSupportRepository $repository) {
        $this->repository = $repository;
    }

    function getProductDataDetail(Request $request){
        $pg_id = $request->pg_id;
        $grouplist = \App\Repositories\WebProductDataRepository::withNew()->getProductPluck($pg_id);

        return response()->json($grouplist);
    }

    /**
     * View [ SupportService ] Route 開啟「技術支援服務」頁面
     * @return type
     */
    function supportService() {
        $productlist = ($this->getProductList());
        $grouplist = \App\Repositories\WebProductGroupRepository::withNew()->getPluckSupportCaseGroup();

        $problemlist = \App\Repositories\WebProblemCategoryRepository::withNew()->getProblemCategory();
        $problemsublist = ($this->getProgramSubList());

        return view('support.supportservice', compact('problemlist', 'grouplist', 'productlist', 'problemsublist'));

        //return view('support.support_service', compact('problemlist', 'grouplist', 'productlist', 'problemsublist'));
    }

    /**
     * View [ CloseSatisfaction ] Route 開啟「結案滿意度調查」頁面
     * @return type
     */
    function closeSatisfaction() {

        $satisfaction = \App\Repositories\WebSatisfactionSurveyRepository::withNew()->getCloseSatisfactionData();

        return view('support.close_satisfaction', compact('satisfaction'));
    }

    /**
     * View [ SupportService ] Action 建立「技術支援服務」資料
     * @param Request $request
     * @return type
     */
    function createSupportCase(Request $request) {

        echo json_encode($request->all());
        echo '<br>';


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

        //儲存資料並取得案件編號
        $case_number = $this->repository->createNewCase($data);
        echo json_encode($data);
        if (isset($case_number)) {
            return view('support.support_success', compact('case_number'));
        }

        return redirect()->back()->withInput()->withErrors(['error' => '系統異常請稍候再試！！']);
    }

    /**
     * View [ CloseSatisfaction ] Action
     * @param Request $request
     * @return type
     */
    function closeSatisfactionComplete(Request $request) {
        return view('support.close_satisfaction_success');
    }

    /**
     * 取得問題子類別
     * @param type $id
     * @return type
     */
    function getProgramSubList() {
        $problemlist = \App\Repositories\WebProblemCategoryRepository::withNew()->getPluckProblemCategory();

        foreach ($problemlist as $key => $value) {
            $problemlist[$key] = \App\Repositories\WebProblemCategoryRepository::withNew()->getPluckSubProblemCategory($key);
        }
        $grouplist[0] = [0 => '請先選案件類別'];
        return $problemlist;
    }

    /**
     * 取得產品資料
     * @param type $id
     * @return type
     */
    public static function getProductList() {
        $grouplist = \App\Repositories\WebProductGroupRepository::withNew()->getPluckSupportCaseGroup();

        foreach ($grouplist as $key => $value) {
            $grouplist[$key] = \App\Repositories\WebProductDataRepository::withNew()->getProductPluck($key);
        }
        $grouplist[0] = [0 => '請先選產品群組'];

        return $grouplist;
    }

    public static function getProductDataQ() {
        $grouplist = \App\Repositories\WebProductGroupRepository::withNew()->getPluckSupportCaseGroup();

        $grouplist[0] = 'qqq';


        return $grouplist;
        $group[0] = ['text' => '請先選分類', 'value' => null];
        foreach ($grouplist as $groupdata) {
            foreach ($groupdata->WebProductData as $productdata) {
                //$text[] = $productdata->pd_name;
                //$value[] = $productdata->pd_id;
                $productlist[] = ['value' => $productdata->pd_id, 'text' => $productdata->pd_name];
            }
            $group[$groupdata->pg_id] = $productlist;
            $productlist = null;
            /*
              $group[$groupdata->pg_id] = ['text' => $text, 'value' => $value];
              $text = null;
              $value = null;
             */
        }

        return ['pd_id' => $group];
    }

}
