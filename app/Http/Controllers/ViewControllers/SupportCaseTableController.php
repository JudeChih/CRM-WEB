<?php

namespace App\Http\Controllers\ViewControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\WebCaseTableRepository;
use App\Models\WebCaseTable;

class SupportCaseTableController extends Controller {

    protected $repository;

    /**
     *  constructor.
     *
     * @param
     */
    public function __construct(WebCaseTableRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * View [ case_list ] Route，開啟頁面「技術支援案件列表」並傳入「列表資料」
     * @param Request $request
     */
    public function caseTableList(Request $request) { //supportCaseList
        echo 'caseTableList';
        echo'<br>';
        echo '年:'.$request->c_year;
        echo'<br>';
        echo '月:'.$request->c_month;
        echo'<br>';
        echo json_encode($request->all());
        echo'<br>';
        
        if(isset($request->c_year)){
            // $caseDate = $this->repository->getListDataPage();
            $case['c_year'] = $request->c_year;
            $case['c_month'] = $request->c_month;
            $caseDate = $this->repository->getData($request);
            // echo $caseDate;
            return view('\supportcase.case_table', compact('caseDate','case'));
        }else{
            $dt = \Carbon\Carbon::now();
            $case['c_year'] = $dt->year;
            $case['c_month'] = $dt->month;
            $caseDate = $this->repository->getData2($request);
            // echo $caseDate;
            return view('\supportcase.case_table', compact('caseDate','case'));
        }
    }

    public function detailActionDate(Request $request) {
        // echo 'detailActionDate';
        // echo'<br>';
        // echo '年:'.$request->c_year;
        // echo'<br>';
        // echo '月:'.$request->c_month;
        // echo'<br>';
        // echo json_encode($request->all());
        // echo'<br>';
        if (!isset($request->submit)) {
            return '';
        }else if ($request->submit == 'save') {
            if($request->password == '123'){
                $this->detailActionCaseTable($request);
            }else{
                return '密碼錯誤，請重新輸入';
            }
        }else if ($request->submit == 'reset'){
            // if($request->password == '123'){
                $this->detailActionCaseTable($request);
            // }else{
            //     return '密碼錯誤，請重新輸入';
            // }
        }else if ($request->submit == 'create'){
            // $y = $request->c_year;
            // $m = $request->c_month;
            // $dt = \Carbon\Carbon::createFromDate($y,$m,7);
            // $dayofweek = $dt->dayOfWeek;
            // return $dayofweek;
            $this->createNewHoliday($request);
        }
        //  else if ($request->submit == 'search') {
        //     return $this->detailActionCaseTable($request);} 
    }


    private function createNewHoliday(Request $request){
        $casedata = $request->all();
        $this->repository->create($casedata);
    }



    private function detailActionCaseTable(Request $request) {
        echo 'detailActionCustomerQuery';

        $c_year = '';
        $c_month = '';
        if (isset($request->c_year)) {
            $c_year = $request->c_year;
        }
        if (isset($request->c_month)) {
            $c_month = $request->c_month;
        }
        $casedata = $request->all();
        $this->repository->update($casedata,$c_year,$c_month);
    }
}


