<?php

namespace App\Services;

use Session;
use App\Http\Controllers\Auth\JWTController;

class AuthService {

    use JWTController;

    private static $sessionToken = 'jwttoken';
    private static $sessionUserData = 'userdata';
    private static $sessionUserName = 'username';
    private static $sessionUserID = 'userid';
    private static $sessionUserAuth = 'auth';

    /**
     * 儲存「JWT Token」
     * @param type $token
     */
    public static function saveToken($token, $userdata) {

        if (!isset($token) || !isset($userdata)) {
            return \Illuminate\Support\Facades\Redirect::route('logout');
        }
        
        Session::put(AuthService::$sessionToken, $token);
        //$_SESSION['jwttoken'] = $token;
        //echo json_encode($userdata);
        Session::put(AuthService::$sessionUserData, $userdata);
        Session::put(AuthService::$sessionUserName, $userdata->username);
        Session::put(AuthService::$sessionUserID, $userdata->userid);
        Session::put(AuthService::$sessionUserAuth, $userdata->auth);
    }

    /**
     * 清除「JWT Token」
     */
    public static function clearToken() {
        //session_destroy();
        Session::flush();
    }

    /**
     * 取得「JWT Token」
     * @return type
     */
    public static function token() {
        return Session::get(AuthService::$sessionToken);
    }

    /**
     * 使用者資料
     * @return type
     */
    public static function userData() {
        return Session::get(AuthService::$sessionUserData);
    }

    /**
     * 使用者名稱
     * @return type
     */
    public static function userName() {
        return Session::get(AuthService::$sessionUserName);
        //return $_SESSION['username'];
    }

    /**
     * 使用者代碼
     * @return type
     */
    public static function userID() {
        return Session::get(AuthService::$sessionUserID);
        //return $_SESSION['userid'];
    }

    /**
     * 權限「Level」
     * @return type
     */
    public static function authLevel() {

        //Session::put('option', '$option');
        return Session::get(AuthService::$sessionUserAuth);
        //return $_SESSION['auth'];
    }

    /**
     * 檢查使用者密碼
     * @param type $password
     * @return type
     */
    public static function checkPassword($password) {

        $repository = \App\Repositories\CrmUserDataRepository::withNew();

        return $repository->checkUserPassword(AuthService::userID(), $password);
    }

}
