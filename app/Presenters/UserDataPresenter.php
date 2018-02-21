<?php

namespace App\Presenters;

use App\Models\UserData;

class UserDataPresenter {

    public function showStatus(UserData $userdata) {

        if ($userdata->ud_status == '1') {
            return '可使用';
        } else {
            return '停用';
        }
    }

    public function showLogin(UserData $userdata) {

        if ($userdata->ud_login == '1') {
            return '可以登入';
        } else {
            return '不可登入';
        }
    }

    public function showManage(UserData $userdata) {

        if ($userdata->ud_manage == '1') {
            return '可編輯';
        } else {
            return '不可編輯';
        }
    }

    public function transToBoolean($value) {


        if ($value == '1' || $value == 1) {
            return true;
        }
        return false;
    }

}
