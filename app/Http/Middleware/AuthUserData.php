<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\Auth\JWTController;
use \App\Services\AuthService;

class AuthUserData {

    use JWTController;

    public function handle($request, Closure $next) {

        $token = \App\Services\AuthService::token();

        if (!isset($token)) {
            return redirect('/logout');
        }
        //檢查「Token」
        if (!$this->checkSignature($token)) {
            return redirect('/logout');
        }
        //展延「Token」
        //產生新的「Token」
        $newToken = $this->generateJWTToken(\App\Services\AuthService::userData());
        //存入Session
        AuthService::saveToken($newToken, \App\Services\AuthService::userData());
        return $next($request);
    }

}
