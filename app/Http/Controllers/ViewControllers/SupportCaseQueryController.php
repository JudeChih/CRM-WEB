<?php

namespace App\Http\Controllers\ViewControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupportCaseQueryController extends Controller {

    //
    // case_customer
    //
    /**
     * View [ case_customer ] 按鈕事件
     * @param Request $request
     * @return type
     */
    function detailActionCustomer(Request $request) {
        echo 'detailActionCustomer';
        echo'<br>';
        echo 'type名:'.$request->type;
        echo'<br>';
        echo '密碼:'.$request->password;
        echo'<br>';
        echo json_encode($request->all());
        echo'<br>';
        if (!isset($request->submit)) {
            return '';
        } else if ($request->submit == 'search' || $request->submit == 'customer') {
            return $this->detailActionCustomerQuery($request);
        } else if ($request->submit == 'save') {
            if( $request->password == 'qwe123' ){
                return $this->detailActionCustomerSave($request);
            }else{
                echo'密碼錯誤，請重新輸入';
                echo'<br>';
                return $this->detailActionCustomerQuery($request);
            }
        }
    }

    /**
     * View [ case_customer ] Action，「Query」按鈕事件，查詢資料
     * @param Request $request
     * @return type
     */
    private function detailActionCustomerQuery(Request $request) {
        echo 'detailActionCustomerQuery';

        $querycondition = '';
        $support_id = '';
        if (isset($request->querycondition)) {
            $querycondition = $request->querycondition;
        }
        if (isset($request->support_id)) {
            $support_id = $request->support_id;
        }

        $customerlist = \App\Repositories\CrmCustomerDataRepository::withNew()->getPaginateCustomerByName($querycondition);
        return view('supportcase.case_customer', compact('support_id', 'querycondition', 'customerlist'));
    }

    /**
     * View [ case_customer ] Action，按鈕事件，檢查並儲存資料
     * @param Request $request
     * @return type
     */
    private function detailActionCustomerSave(Request $request) {

        $savedata['cd_id'] = $request->cd_id;

        $result = $this->repository->update($savedata, $request->support_id);

        $dataarray = $request->all();
        $dataarray['user_role'] = '1';
        $result = \App\Repositories\WebSupportUserRepository::withNew()->create($dataarray);

        $casedata = $this->repository->getData($request->support_id);
        $auth = 'manager';
        if (isset($result)) {
            return view('\supportcase.case_detail', compact('casedata', 'auth'))->with('success', '客戶設定成功');
        } else {
            return view('\supportcase.case_detail', compact('casedata', 'auth'))->withErrors(['error' => '系統異常請稍候再試！！']);
        }
    }

    //
    // case_sales
    //
    /**
     * View [ case_sales ] 按鈕事件
     * @param Request $request
     * @return type
     */
    function detailActionSales(Request $request) {
        echo 'detailActionSales';
        echo'<br>';
        echo 'type名:'.$request->type;
        echo'<br>';
        echo '密碼:'.$request->password;
        echo'<br>';
        if (!isset($request->submit)) {
            return '';
        } else if ($request->submit == 'search' || $request->submit == 'sales') {
            return $this->detailActionSalesQuery($request);
        } else if ($request->submit == 'save') {
            if( $request->password == 'qwe123' ){
                return $this->detailActionSalesSave($request);
            }else{
                echo'密碼錯誤，請重新輸入';
                echo'<br>';
                return $this->detailActionSalesQuery($request);
            }
        }
    }

    /**
     * View [ case_sales ] Action，「Query」按鈕事件，查詢資料
     * @param Request $request
     * @return type
     */
    private function detailActionSalesQuery(Request $request) {

        echo 'detailActionSalesQuery';
        echo'<br>';
        echo json_encode($request->all());
        echo'<br>';
        $querycondition = '';
        $support_id = '';
        if (isset($request->querycondition)) {
            $querycondition = $request->querycondition;
        }
        if (isset($request->support_id)) {
            $support_id = $request->support_id;
        }
        $saleslist = \App\Repositories\CrmUserDataRepository::withNew()->getSalesListByCondition($querycondition);

        return view('supportcase.case_sales', compact('support_id', 'querycondition', 'saleslist'));
    }

    /**
     * View [ case_sales ] Action，按鈕事件，檢查並儲存資料
     * @param Request $request
     * @return type
     */
    private function detailActionSalesSave(Request $request) {
        $dataarray = $request->all();
        $dataarray['user_role'] = '3';
        $result = \App\Repositories\WebSupportUserRepository::withNew()->create($dataarray);

        $casedata = $this->repository->getData($request->support_id);
        $auth = 'manager';
        if (isset($result)) {
            return view('\supportcase.case_detail', compact('casedata', 'auth'))->with('success', '業務設定成功');
        } else {
            return view('\supportcase.case_detail', compact('casedata', 'auth'))->withErrors(['error' => '系統異常請稍候再試！！']);
        }
    }

    //
    // case_take_engineer
    //
    /**
     * View [ case_take_engineer ] 按鈕事件
     * @param Request $request
     * @return type
     */
    function detailActionTakeEngineer(Request $request) {
        echo 'detailActionTakeEngineer';
        echo'<br>';
        echo 'type名:'.$request->type;
        echo'<br>';
        echo '密碼:'.$request->password;
        echo'<br>';
        if (!isset($request->submit)) {
            return '';
        } else if ($request->submit == 'search' || $request->submit == 'takeengineer') {
            return $this->detailActionTakeEngineerQuery($request);
        } else if ($request->submit == 'save') {
            if( $request->password == 'qwe123' ){
                return $this->detailActionTakeEngineerSave($request);
            }else{
                echo'密碼錯誤，請重新輸入';
                echo'<br>';
                return $this->detailActionTakeEngineerQuery($request);
            }
        }
    }

    /**
     * View [ case_take_engineer ] Action，「Query」按鈕事件，查詢資料
     * @param Request $request
     * @return type
     */
    private function detailActionTakeEngineerQuery(Request $request) {

        echo 'detailActionTakeEngineerQuery';
        echo'<br>';
        echo json_encode($request->all());
        echo'<br>';
        $querycondition = '';
        $support_id = '';
        if (isset($request->querycondition)) {
            $querycondition = $request->querycondition;
        }
        if (isset($request->support_id)) {
            $support_id = $request->support_id;
        }

        $engineerlist = \App\Repositories\CrmUserDataRepository::withNew()->getEngineerListByCondition($querycondition);

        return view('supportcase.case_take_engineer', compact('support_id', 'querycondition', 'engineerlist'));
    }

    /**
     * View [ case_take_engineer ] Action，按鈕事件，檢查並儲存資料
     * @param Request $request
     * @return type
     */
    private function detailActionTakeEngineerSave(Request $request) {
        $dataarray = $request->all();
        $dataarray['user_role'] = '1';
        $result = \App\Repositories\WebSupportUserRepository::withNew()->create($dataarray);

        $casedata = $this->repository->getData($request->support_id);
        $auth = 'manager';
        if (isset($result)) {
            return view('\supportcase.case_detail', compact('casedata', 'auth'))->with('success', '接案工程師設定成功');
        } else {
            return view('\supportcase.case_detail', compact('casedata', 'auth'))->withErrors(['error' => '系統異常請稍候再試！！']);
        }
    }

    //
    // case_support_engineer

    //
    
    /**
     * View [ case_support_engineer ] 按鈕事件
     * @param Request $request
     * @return type
     */
    function detailActionSupportEngineer(Request $request) {
        echo 'detailActionSupportEngineer';
        echo'<br>';
        echo 'type名:'.$request->type;
        echo'<br>';
        echo '密碼:'.$request->password;
        echo'<br>';
        if (!isset($request->submit)) {
            return '';
        } else if ($request->submit == 'search' || $request->submit == 'supportengineer') {
            return $this->detailActionSupportEngineerQuery($request);
        } else if ($request->submit == 'save') {
            if( $request->password == 'qwe123' ){
                return $this->detailActionSupportEngineerSave($request);
            }else{
                echo'密碼錯誤，請重新輸入';
                echo'<br>';
                return $this->detailActionSupportEngineerQuery($request);
            }
        }
    }

    /**
     * View [ case_support_engineer ] Action，「Query」按鈕事件，查詢資料
     * @param Request $request
     * @return type
     */
    private function detailActionSupportEngineerQuery(Request $request) {

        echo 'detailActionSupportEngineerQuery';
        echo'<br>';
        echo json_encode($request->all());
        echo'<br>';
        $querycondition = '';
        $support_id = '';
        if (isset($request->querycondition)) {
            $querycondition = $request->querycondition;
        }
        if (isset($request->support_id)) {
            $support_id = $request->support_id;
        }

        $engineerlist = \App\Repositories\CrmUserDataRepository::withNew()->getEngineerListByCondition($querycondition);

        return view('supportcase.case_support_engineer', compact('support_id', 'querycondition', 'engineerlist'));
    }

    /**
     * View [ case_support_engineer ] Action，按鈕事件，檢查並儲存資料
     * @param Request $request
     * @return type
     */
    private function detailActionSupportEngineerSave(Request $request) {
        $dataarray = $request->all();
        $dataarray['user_role'] = '2';
        $result = \App\Repositories\WebSupportUserRepository::withNew()->create($dataarray);

        $casedata = $this->repository->getData($request->support_id);
        $auth = 'manager';
        if (isset($result)) {
            return view('\supportcase.case_detail', compact('casedata', 'auth'))->with('success', '支援工程師設定成功');
        } else {
            return view('\supportcase.case_detail', compact('casedata', 'auth'))->withErrors(['error' => '系統異常請稍候再試！！']);
        }
    }

}
