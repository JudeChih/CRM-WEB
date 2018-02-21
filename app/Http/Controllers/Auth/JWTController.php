<?php

namespace App\Http\Controllers\Auth;

use \Firebase\JWT\JWT;
use App\Services\AuthService;

define('SECRET_KEY', config('jwt.SECRET_KEY'));
define('ALGORITHM', config('jwt.ALGORITHM'));

trait JWTController {

    /**
     * 產生「JWT Token」
     * @param type $userData 使用者登入資料
     * @return type 若為「Null」為產生失敗
     */
    public function generateJWTToken($userData) {
        try {
            $datetimeNow = \Carbon\Carbon::now();

            $tokenId = base64_encode(mcrypt_create_iv(32));
            $issuedAt = $datetimeNow->timestamp;
            $notBefore = $datetimeNow->timestamp;
            //$expire = $datetimeNow->addMinutes(10)->timestamp; // 10分鐘
            $expire = $datetimeNow->addDay()->timestamp; // TEST
            $serverName = 'http:/sunwai.com/'; /// set your domain name 

            $data = [
                'iss' => $serverName, //iss: jwt簽發者
                //sub: jwt所面向的用戶
                //aud: 接收jwt的一方
                'exp' => $expire, //exp: jwt的過期時間，這個過期時間必須要大於簽發時間
                'nbf' => $notBefore, //nbf: 定義在什麼時間之前，該jwt都是不可用的.
                'iat' => $issuedAt, //iat: jwt的簽發時間。格式〔timestamp〕
                'jti' => $tokenId, //jti: jwt的唯一身份標識，主要用來作為一次性token,從而迴避重放攻擊。
                //使用者登入資料
                'data' => $userData
            ];
            $secretKey = base64_decode(SECRET_KEY);
            $jwt = JWT::encode($data, $secretKey, ALGORITHM);

            return $jwt;
        } catch (\Exception $ex) {
            return null;
        }
    }

    /**
     * 檢查Token簽證
     * @return boolean TRUE：驗證通過、FALSE：驗證失敗
     */
    public function checkSignature($jwtToken) {
        try {
            //解碼 驗證Token
            $decodeJWT = JWT::decode($jwtToken, base64_decode(SECRET_KEY), array(ALGORITHM));
            //檢查是否有「使用者登入資料」
            if (!isset($decodeJWT->data) || !isset($decodeJWT->data->userid) || !isset($decodeJWT->data->username) || !isset($decodeJWT->data->auth)) {
                return false;
            }

            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }

    /**
     * 取得「Token」中的使用者資料
     * @param type $jwtToken
     * @return type
     */
    public function getTokenUserData($jwtToken) {
        try {
            if (!isset($jwtToken)) {
                return null;
            }

            //解碼 驗證Token
            $decodeJWT = JWT::decode($jwttoken, base64_decode(SECRET_KEY), array(ALGORITHM));
            //檢查是否有「使用者登入資料」
            if (!isset($decodeJWT->data) || !isset($decodeJWT->data->userid) || !isset($decodeJWT->data->username) || !isset($decodeJWT->data->auth)) {
                return null;
            }
            return $decodeJWT->data;
        } catch (\Exception $ex) {
            return null;
        }
    }

    /**
     * 產生「JWT Token」
     * @param type $userData 使用者登入資料
     * @return type 若為「Null」為產生失敗
     */
    public function generateJWTTokenQ($userData) {
        try {
            $datetimeNow = \Carbon\Carbon::now();

            $tokenId = base64_encode(mcrypt_create_iv(32));
            $issuedAt = $datetimeNow->timestamp;
            $notBefore = $datetimeNow->timestamp;
            $expire = $datetimeNow->addMinutes(10)->timestamp; // 10分鐘
            $serverName = 'http:/crmweb/'; /// set your domain name 

            $data = [
                'iss' => $serverName, /* iss: jwt簽發者 */
                /* sub: jwt所面向的用戶 */
                /* aud: 接收jwt的一方 */
                'exp' => $expire, /* exp: jwt的過期時間，這個過期時間必須要大於簽發時間 */
                'nbf' => $notBefore, /* nbf: 定義在什麼時間之前，該jwt都是不可用的. */
                'iat' => $issuedAt, /* iat: jwt的簽發時間。格式〔timestamp〕 */
                'jti' => $tokenId, /* jti: jwt的唯一身份標識，主要用來作為一次性token,從而迴避重放攻擊。 */
                //
                //使用者登入資料
                'data' => $userData
                    /* [
                      'ud_id' => '使用者代碼', // id from the users table
                      'ud_name' => '使用者名稱', //  name
                      'auth' => '使用者權限',
                      ] */
            ];
            $secretKey = base64_decode(SECRET_KEY);
            $jwt = JWT::encode($data, $secretKey, ALGORITHM);
            $_SESSION['jwttoken'] = $jwt;

            \App\Services\AuthService::hasLogged($userData);

            return $jwt;
        } catch (\Exception $ex) {
            return null;
        }
    }

    /**
     * 檢查Token簽證
     * @return boolean TRUE：驗證通過、FALSE：驗證失敗
     */
    public function checkSignatureQ() {
        try {
            $jwttoken = $_SESSION['jwttoken'];
            //解碼 驗證Token
            $decodeJWT = JWT::decode($jwttoken, base64_decode(SECRET_KEY), array(ALGORITHM));
            //檢查是否有「使用者登入資料」
            if (!isset($decodeJWT->data) || !isset($decodeJWT->data->userid) || !isset($decodeJWT->data->username) || !isset($decodeJWT->data->auth)) {
                //清除Session
                session_destroy();
                return 'ERROR';
            }

            $_SESSION['userid'] = $decodeJWT->data->userid;
            $_SESSION['username'] = $decodeJWT->data->username;
            $_SESSION['auth'] = $decodeJWT->data->auth;


            echo json_encode($decodeJWT->data);
            echo '<br>';
            echo json_encode($decodeJWT->data->userid);
            echo '<br>';
            echo json_encode($decodeJWT->data->username);
            echo '<br>';
            echo json_encode($decodeJWT->data->auth);
            echo '<br>';
            return 'SUCCESS';
        } catch (\Exception $ex) {
            session_destroy();
            return false;
        }
    }

    /*
     * auth
     * login
     * loginout
     * check
     * getuserdata
     * 
     * 
     * 
     * 
     * 
     */
}
