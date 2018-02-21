<?php

namespace App\Http\Controllers\ViewControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\WebHolidayRepository;
use App\Models\WebHoliday;

class HolidayController extends Controller {

    protected $repository;

    public function __construct(WebHolidayRepository $repository) {
        $this->repository = $repository;
    }

    public function webHolidayList(Request $request) {
        if(isset($request->c_year)){
            // $caseDate = $this->repository->getListDataPage();
            $case['c_year'] = $request->c_year;
            $case['c_month'] = $request->c_month;
            $caseDate = $this->repository->getDataOfOneMonth($case);
            return view('\holiday.holiday', compact('caseDate','case'));
        }else{
            $dt = \Carbon\Carbon::now();
            $case['c_year'] = $dt->year;
            $case['c_month'] = $dt->month;
            $caseDate = $this->repository->getDataOfOneMonth($case);
            return view('\holiday.holiday', compact('caseDate','case'));
        }
    }

    /**
     * 判斷傳來的submit分別做不同的動作
     * 一是更新使用者所選的天數更換為假日
     * 二是清除之前的假日設定，重置
     * @param  Request $request [description]
     */
    public function detailActionDate(Request $request) {
        if (!isset($request->submit)) {
            return '';
        }else if ($request->submit == 'save') {
            if($request->password == '123'){
                $this->detailActionHoliday($request);
            }else{
                return '密碼錯誤，請重新輸入';
            }
        }else if ($request->submit == 'reset'){
            $this->detailActionHoliday($request);
        }else if ($request->submit == 'create'){
            $this->createNewHoliday($request);
        }
    }

    /**
     * 新增某年某月整月的資訊
     * @param  Request $request [某年某月]
     */
    private function createNewHoliday(Request $request){
        $casedata = $request->all();
        $this->repository->create($casedata);
    }

    /**
     * [detailActionHoliday description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    private function detailActionHoliday(Request $request) {

        $c_year = '';
        $c_month = '';
        if (isset($request->c_year)) {
            $c_year = $request->c_year;
        }
        if (isset($request->c_month)) {
            $c_month = $request->c_month;
        }
        if ($request->submit == 'save'){
            $casedata = $request->all();
            $arrayLength = count($casedata['c_day']);
            for($i=0;$i<$arrayLength;$i++){
                if (isset($casedata['c_day'][$i][$i+1])) {
                    $savedata['c_is_holiday'] = $casedata['c_day'][$i][$i+1];
                }
                $savedata['c_year'] = $c_year;
                $savedata['c_month'] = $c_month;
                $savedata['c_day'] = $i+1;
                $this->repository->update($savedata);
            }
        }else if ($request->submit == 'reset'){
            $casedata = $request->all();
            $arrayLength = count($casedata['c_dayofweek']);
            for($i=0;$i<$arrayLength;$i++){
                if ($casedata['c_dayofweek'][$i][$i+1] == 6 || $casedata['c_dayofweek'][$i][$i+1] == 7) {
                    $savedata['c_is_holiday'] = 1;
                }else{
                    $savedata['c_is_holiday'] = 0;
                }
                $savedata['c_year'] = $c_year;
                $savedata['c_month'] = $c_month;
                $savedata['c_day'] = $i+1;
                $this->repository->update($savedata);
            }
        }
    }
}


