<?php

namespace App\Presenters;

class SupportServicePresenter {

    /**
     * 顯示「產品分類」下拉選單
     */
    public function showProductGroupOption($productgroup) {

        echo '<option value="" selected="selected">請選擇產品分類</option>';

        if (!isset($productgroup)) {
            return;
        }
        foreach ($productgroup as $group) {
            echo '<option value="' . $group->pg_id . '">' . $group->pg_name . '</option>';
        }
    }

}
