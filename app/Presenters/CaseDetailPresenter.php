<?php

namespace App\Presenters;

use App\Models\UserData;

class CaseDetailPresenter {

    /**
     * 檢查權限可使用的功能
     */
    public function checkAuth($authLevel) {

        if (in_array("engineer_head", $authLevel) || in_array("cs_head", $authLevel) || in_array("cs", $authLevel) || in_array("manager", $authLevel)) {
            echo \Collective\Html\FormFacade::button('連結客戶資料', ['name' => 'submit', 'type' => 'submit', 'class' => 'btn btn-info', 'value' => 'setcustomer']);
            echo \Collective\Html\FormFacade::button('設定負責業務', ['name' => 'submit', 'type' => 'submit', 'class' => 'btn btn-info', 'value' => 'setsales']);
            echo \Collective\Html\FormFacade::button('設定接案工程師', ['name' => 'submit', 'type' => 'submit', 'class' => 'btn btn-info', 'value' => 'settakecase']);
            echo \Collective\Html\FormFacade::button('設定支援工程師', ['name' => 'submit', 'type' => 'submit', 'class' => 'btn btn-info', 'value' => 'setsupportcase']);
        } else if (in_array("engineer", $authLevel)) {
            echo \Collective\Html\FormFacade::button('連結客戶資料', ['name' => 'submit', 'type' => 'submit', 'class' => 'btn btn-info', 'value' => 'setcustomer']);
        } else if (in_array("sales", $authLevel) || in_array("sales_head", $authLevel)) {
        }
    }

    /**
     * 檢查「Case Status」可使用的功能
     * @param type $caseStatus
     */
    public function checkCaseStatus($caseStatus) {

        if ($caseStatus == 3 || $caseStatus == 4 || $caseStatus == 9) {
            return;
        }
        //echo \Collective\Html\FormFacade::button('O接案O', ['name' => 'submit', 'type' => 'button', 'class' => 'btn btn-info', 'value' => 'takecase']);
        $authLevel = json_decode(\App\Services\AuthService::authLevel());

        $this->checkAuth($authLevel);
        if (!in_array("engineer", $authLevel) && !in_array("engineer_head", $authLevel)) {
            return;
        }
        switch ($caseStatus) {
            case 0://0	新案件
                echo \Collective\Html\FormFacade::button('接案', ['name' => 'submit', 'type' => 'button', 'class' => 'btn btn-info', 'value' => 'takecase']);

                break;
            case 1://1	處理中
                echo \Collective\Html\FormFacade::button('展延', ['name' => 'submit', 'type' => 'submit', 'class' => 'btn btn-info', 'value' => 'extendcase']);
                echo \Collective\Html\FormFacade::button('結案', ['name' => 'submit', 'type' => 'submit', 'class' => 'btn btn-info', 'value' => 'closecase']);
                break;
            case 2://2	展延
                echo \Collective\Html\FormFacade::button('結案', ['name' => 'submit', 'type' => 'submit', 'class' => 'btn btn-info', 'value' => 'closecase']);
                break;
            case 3://3	工程師結案
                break;
            case 4://4	客戶結案
                break;
            case 9://9	取消
                break;
        }
    }

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

    public function showCaseStatusDetails($support_id) {
        $casedata = \App\Repositories\WebSupportRepository::withNew()->getData($support_id);
        switch ($casedata->case_status) {
            case 2://2  展延
                echo '<div class="col-md-6 col-sm-6 col-xs-12">';
                echo '<span class="col-md-12 col-sm-12 col-xs-12"><div class="separation_line"></div></span>';
                echo '<div class="col-md-12 col-sm-12 col-xs-12"><h2>展延資訊</h2></div>';
                echo '<div class="col-md-12 col-sm-12 col-xs-12"><h3>展延人：<span>'.$casedata->extend_user.'</span></h3></div>';
                echo '<div class="col-md-12 col-sm-12 col-xs-12"><h3>展延日期：<span>'.$casedata->extend_date.'</span></h3></div>';
                echo '<div class="col-md-12 col-sm-12 col-xs-12"><h3>展延原因：<span>'.$casedata->extend_reason.'</span></h3></div>';
                echo '<div class="col-md-12 col-sm-12 col-xs-12"><h3>展延預計完成日：<span>'.$casedata->extend_expect_date.'</span></h3></div>';
                echo '</div>';
                break;
            case 3://3  工程師結案
                //展延
                if($casedata->extend_user != '' || $casedata->extend_date != '' || $casedata->extend_reason != '' || $casedata->extend_expect_date != ''){
                    echo '<div class="col-md-6 col-sm-6 col-xs-12">';
                    echo '<span class="col-md-12 col-sm-12 col-xs-12"><div class="separation_line"></div></span>';
                    echo '<div class="col-md-12 col-sm-12 col-xs-12"><h2>展延資訊</h2></div>';
                    echo '<div class="col-md-12 col-sm-12 col-xs-12"><h3>展延人：<span>'.$casedata->extend_user.'</span></h3></div>';
                    echo '<div class="col-md-12 col-sm-12 col-xs-12"><h3>展延日期：<span>'.$casedata->extend_date.'</span></h3></div>';
                    echo '<div class="col-md-12 col-sm-12 col-xs-12"><h3>展延原因：<span>'.$casedata->extend_reason.'</span></h3></div>';
                    echo '<div class="col-md-12 col-sm-12 col-xs-12"><h3>展延預計完成日：<span>'.$casedata->extend_expect_date.'</span></h3></div>';
                    echo '</div>';
                }

                //結案
                echo '<div class="col-md-6 col-sm-6 col-xs-12">';
                echo '<span class="col-md-12 col-sm-12 col-xs-12"><div class="separation_line"></div></span>';
                echo '<div class="col-md-12 col-sm-12 col-xs-12"><h2>結案資訊</h2></div>';
                echo '<div class="col-md-12 col-sm-12 col-xs-12"><h3>結案人：<span>'.$casedata->close_user.'</span></h3></div>';
                echo '<div class="col-md-12 col-sm-12 col-xs-12"><h3>結案日期：<span>'.$casedata->close_date.'</span></h3></div>';
                echo '<div class="col-md-12 col-sm-12 col-xs-12"><h3>結案描述：<span>'.$casedata->close_description.'</span></h3></div>';
                if($casedata->close_filename == ''){
                    echo '<div class="col-md-12 col-sm-12 col-xs-12"><h3>結案檔案：無</h3></div>';
                }else{
                    echo '<div class="col-md-12 col-sm-12 col-xs-12"><h3>結案檔案：<a class="btn btn-info btn-xs" href="../files/closesupportcasefiles/'.$casedata->close_filename.'" target="_blank">點擊下載</a></h3></div>';
                }
                echo '</div>';
                break;
            case 4://4  客戶結案
                //展延
                if($casedata->extend_user != '' || $casedata->extend_date != '' || $casedata->extend_reason != '' || $casedata->extend_expect_date != ''){
                    echo '<div class="col-md-6 col-sm-6 col-xs-12">';
                    echo '<span class="col-md-12 col-sm-12 col-xs-12"><div class="separation_line"></div></span>';
                    echo '<div class="col-md-12 col-sm-12 col-xs-12"><h2>展延資訊</h2></div>';
                    echo '<div class="col-md-12 col-sm-12 col-xs-12"><h3>展延人：<span>'.$casedata->extend_user.'</span></h3></div>';
                    echo '<div class="col-md-12 col-sm-12 col-xs-12"><h3>展延日期：<span>'.$casedata->extend_date.'</span></h3></div>';
                    echo '<div class="col-md-12 col-sm-12 col-xs-12"><h3>展延原因：<span>'.$casedata->extend_reason.'</span></h3></div>';
                    echo '<div class="col-md-12 col-sm-12 col-xs-12"><h3>展延預計完成日：<span>'.$casedata->extend_expect_date.'</span></h3></div>';
                    echo '</div>';
                }

                //結案
                echo '<div class="col-md-6 col-sm-6 col-xs-12">';
                echo '<span class="col-md-12 col-sm-12 col-xs-12"><div class="separation_line"></div></span>';
                echo '<div class="col-md-12 col-sm-12 col-xs-12"><h2>結案資訊</h2></div>';
                echo '<div class="col-md-12 col-sm-12 col-xs-12"><h3>結案人：<span>'.$casedata->close_user.'</span></h3></div>';
                echo '<div class="col-md-12 col-sm-12 col-xs-12"><h3>結案日期：<span>'.$casedata->close_date.'</span></h3></div>';
                echo '<div class="col-md-12 col-sm-12 col-xs-12"><h3>結案描述：<span>'.$casedata->close_description.'</span></h3></div>';
                if($casedata->close_filename == ''){
                    echo '<div class="col-md-12 col-sm-12 col-xs-12"><h3>結案檔案：無</h3></div>';
                }else{
                    echo '<div class="col-md-12 col-sm-12 col-xs-12"><h3>結案檔案：<a class="btn btn-info btn-xs" href="../files/closesupportcasefiles/'.$casedata->close_filename.'" target="_blank">點擊下載</a></h3></div>';
                }
                echo '</div>';

                //滿意度調查表
                $SatisfactionData = \App\Repositories\WebSatisfactionSurveyRepository::withNew()->getCloseSatisfactionData();
                $Satisfactionscore = \App\Repositories\WebSatisfactionScoreRepository::withNew()->getDataBySupportID($support_id);
                echo '<div class="col-md-6 col-sm-6 col-xs-12">';
                echo '<span class="col-md-12 col-sm-12 col-xs-12"><div class="separation_line"></div></span>';
                echo '<div class="col-md-12 col-sm-12 col-xs-12"><h2>滿意度評分</h2></div>';
                foreach ($SatisfactionData as $qqq) {
                    $num = sprintf("%02s", $qqq->ss_sort);
                    $score = 'score'.$num;

                    switch($Satisfactionscore->$score){
                        case '1':
                            $score = '很不滿意';
                            break;
                        case '2':
                            $score = '不滿意';
                            break;
                        case '3':
                            $score = '尚可';
                            break;
                        case '4':
                            $score = '滿意';
                            break;
                        case '5':
                            $score = '很滿意';
                            break;
                    }
                    echo '<div class="col-md-12 col-sm-12 col-xs-12"><h3>'.$qqq->ss_description.'：<span>'.$score.'</span></h3></div>';
                }
                echo '</div>';
                break;
        }
    }

}
