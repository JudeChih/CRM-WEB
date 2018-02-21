<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use \Firebase\JWT\JWT;
use \App\Services\AuthService;
use App\Http\Controllers\Auth\JWTController;
use \Illuminate\Support\Facades\View;

class LoginController extends Controller {

//    
    use JWTController;

    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $redirectToLogOut = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest', ['except' => 'logout']);
    }


    /**
     * 執行登入
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    function login(\Illuminate\Http\Request$request) {
        try {
            //檢查帳號密碼是否有填寫
            if (!isset($request->username) || !isset($request->password)) {
                AuthService::clearToken();
                return redirect()->back()->withInput()->withErrors(['error' => '帳號或密碼錯誤！！']);
            }
            //檢查是否有這個使用者資料
            $userdata = $this->checkUserPassword($request->username, $request->password);
            if (!isset($userdata)) {
                AuthService::clearToken();
                return redirect()->back()->withInput()->withErrors(['error' => '帳號或密碼錯誤！！']);
            }

            //建立「JWT Token」
            $jwttoken = $this->generateJWTToken($userdata);
            if (!isset($jwttoken)) {
                AuthService::clearToken();
                return redirect()->back()->withInput()->withErrors(['error' => '帳號或密碼錯誤！！']);
            }
            //儲存「Token」
            AuthService::saveToken($jwttoken, $userdata);

            return redirect('/index');
        } catch (Exception $ex) {
            AuthService::clearToken();
            return redirect()->back()->withInput()->withErrors(['error' => '帳號或密碼錯誤！！']);
        }
    }

    /**
     * 執行登出
     * @param \Illuminate\Http\Request $request
     * @return type
     */
    function logOut(\Illuminate\Http\Request$request) {

        //清除「Token」
        AuthService::clearToken();
        return redirect('/login');
    }

    /**
     * 檢查使用者帳號密碼，並取得使用者資料
     * @param type $userName 使用者帳號
     * @param type $userPassword 使用者密碼
     * @return type 使用者資料 [ ud_id ,ud_name ,auth ]
     */
    private function checkUserPassword($userName, $userPassword) {

        $userdata = \App\Repositories\CrmUserDataRepository::withNew()->getDataByNickPass($userName, $userPassword);

        if (count($userdata) > 0) {
            return json_decode(json_encode(['userid' => $userdata->ud_id, 'username' => $userdata->ud_cname, 'auth' => json_encode($userdata->authrole())]));
        } else {
            return null;
        }
    }

}
