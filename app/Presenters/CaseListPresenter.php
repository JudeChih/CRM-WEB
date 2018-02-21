<?php

namespace App\Presenters;

use App\Models\UserData;

class CaseListPresenter {

    /**
     * 顯示案件狀態
     * @param type $caseStatus
     * @return string
     */
    public function showCaseStatus($caseStatus) {

        switch ($caseStatus) {
            case 0://0	新案件
                return '新案件';
            case 1://1	處理中
                return '處理中';
            case 2://2	展延
                return '展延';
            case 3://3	工程師結案
                return '工程師結案';
            case 4://4	客戶結案
                return '客戶結案';
            case 9://9	取消
                return '取消';
        }
    }

    /**
     * 顯示清單資料
     * @param type $support_id
     * @return type
     */
    public function showData($support_id) {
        $case = \App\Repositories\WebSupportRepository::withNew()->getData($support_id);
        if (!isset($case)) {
            return;
        }
        echo '<a href="#" class="case_setting_detail col-md-12 col-sm-12 col-xs-12" onclick="form' . $case->support_id . '.submit();">';

        echo '<div class="col-md-2 col-sm-2 col-xs-2 text-left">' . $case->case_number . '</div>';
        echo '<div class="col-md-1 col-sm-1 col-xs-1 text-left">' . $this->showCaseStatus($case->case_status) . '</div>';
        echo '<div class="col-md-2 col-sm-2 col-xs-2 text-left">' . $case->comp_name . '</div>';
        echo '<div class="col-md-1 col-sm-1 col-xs-1 text-left">' . $case->contact_name . '</div>';
        echo '<div class="col-md-2 col-sm-2 col-xs-2 text-left">' . $case->contact_mail . '</div>';

        echo '<div class="col-md-2 col-sm-2 col-xs-2 text-left">';
        echo isset($case->productGroup) ? $case->productGroup->pg_name : '';
        echo '</div>';
        echo '<div class="col-md-2 col-sm-2 col-xs-2 text-left">';
        echo isset($case->productData) ? $case->productData->pd_name : '';
        echo '</div>';

        echo '</a>';
        /*
          <a href="#" class="case_setting_detail col-md-12 col-sm-12 col-xs-12" onclick="{{ 'form'.$case->support_id }}.submit();">
          {{ Form::hidden('support_id', $case->support_id) }}
          <div class="col-md-2 col-sm-2 col-xs-2">{{ $case->case_number }}</div>
          <div class="col-md-1 col-sm-1 col-xs-1">{{ $presenter ->showCaseStatus( $case->case_status ) }}</div>
          <div class="col-md-3 col-sm-3 col-xs-3">{{ $case->comp_name }}</div>
          <div class="col-md-2 col-sm-2 col-xs-2">{{ $case->contact_name }}</div>
          <div class="col-md-2 col-sm-2 col-xs-2">{{ isset($case->productGroup) ? $case->productGroup->pg_name : '' }}</div>
          <div class="col-md-2 col-sm-2 col-xs-2">{{ isset($case->productData) ? $case->productData->pd_name : '' }}</div>
          </a>
         *         */
    }

    function showQuerySelectData() {


        return $items = array('-1' => '全部', '0' => '新案件', '1' => '處理中', '2' => '案件已展延', '3' => '工程師結案', '4' => '客戶結案'/* , '9' => '案件已取消' */);

        //$select = [['key' => '0', '0' => '全部'], ['key' => '1', '1' => '全Q部']];

        $select[0] = 'QQ';
        $select[1] = 'WW';
        return $select;

        return array('0' => '全部', '1' => 'QQQ');

        return array(
            'Cats' => array('leopard' => 'Leopard'),
            'Dogs' => array('spaniel' => 'Spaniel'),
        );
    }

    function showQuerySelectOption($selected = null) {

        if (!isset($selected)) {
            echo '<option value="-1">全部</option>';
            echo '<option value="0">新案件</option>';
            echo '<option value="1">處理中</option>';
            echo '<option value="2">案件已展延</option>';
            echo '<option value="3">工程師結案</option>';
            echo '<option value="4">客戶結案</option>';
            //echo '<option value="9">案件已取消</option>';
        } else {

            echo '<option value="-1">全部</option>';
            if ($selected == '0') {
                echo '<option value="0" selected="selected">新案件</option>';
            } else {
                echo '<option value="0">新案件</option>';
            }
            if ($selected == '1') {
                echo '<option value="1" selected="selected">處理中</option>';
            } else {
                echo '<option value="1">處理中</option>';
            }
            if ($selected == '2') {
                echo '<option value="2" selected="selected">案件已展延</option>';
            } else {
                echo '<option value="2">案件已展延</option>';
            }
            if ($selected == '3') {
                echo '<option value="3" selected="selected">工程師結案</option>';
            } else {
                echo '<option value="3">工程師結案</option>';
            }
            if ($selected == '4') {
                echo '<option value="4" selected="selected">客戶結案</option>';
            } else {
                echo '<option value="4">客戶結案</option>';
            }
        }

        //echo '<option value="9">案件已取消</option>';

        return;




        return $items = array('-1' => '全部', '0' => '新案件', '1' => '處理中', '2' => '案件已展延', '3' => '工程師結案', '4' => '客戶結案'/* , '9' => '案件已取消' */);

        //$select = [['key' => '0', '0' => '全部'], ['key' => '1', '1' => '全Q部']];

        $select[0] = 'QQ';
        $select[1] = 'WW';
        return $select;

        return array('0' => '全部', '1' => 'QQQ');

        return array(
            'Cats' => array('leopard' => 'Leopard'),
            'Dogs' => array('spaniel' => 'Spaniel'),
        );
    }

}
