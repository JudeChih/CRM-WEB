<?php

namespace App\Presenters;

use App\Models\UserData;

class CaseDetailPresenter {

    /**
     * 滿意度調查表
     */
    public function checkAuth($support_id) {

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
    }
}
