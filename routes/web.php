<?php

/*
  |----------------------------------------------------------------
  | Web Routes
  |----------------------------------------------------------------
  |
  | This file is where you may define all of the routes
  | that are handled by your application.
  | Just tell Laravel the URIs it should respond
  | to using a Closure or controller method.
  | Build something great!
  |
 */

Route::get('/test', function () {

    $repository = new \App\Repositories\CrmCustomerContactRepository();

    $result = $repository->getDataByCCEmail('kin@taifatech.com');
    echo json_encode($result);
    echo '<br>';
    $RRR = json_encode(App\Http\Controllers\ViewControllers\SupportServiceController::checkExistCustomer('kin@taifatech.com'));
    echo ($RRR);
    echo '<br>';
    return;
    //return

    $qq = App\Repositories\WebSupportRepository::withNew()->getNewCaseNumber();
    echo $qq;
});

Route::get('/testdeadline', 'ViewControllers\SupportServiceController@testtest');

Route::get('/testmailview', 'ViewControllers\TestController@mailView_NewCaseEngineer');

Route::get('/testmail', function () {
    return \Illuminate\Support\Facades\View::make('test.mail');
});

Route::post('/testmail', 'ViewControllers\TestController@sendMail');

Route::get('/testrecaptcha', function () {
    return \Illuminate\Support\Facades\View::make('test.recaptcha');
});

Route::post('/testrecaptcha', 'ViewControllers\TestController@testReCaptcha');

Route::get('/testpostmessage', function () {
    return \Illuminate\Support\Facades\View::make('test.postmessage');
});

Route::get('/testlogin', function () {
    return \Illuminate\Support\Facades\View::make('auth.login_test');
    //return view('auth.login');
});

Route::post('/testlogin', 'Auth\LoginController@login');

Route::get('/testSchedule/overtake', 'APIControllers\ScheduleController@check_Deadline_TakeCase');

Route::get('/testSchedule/overclose', 'APIControllers\ScheduleController@check_Deadline_CloseCase');

//
//登入後首頁
//
Route::get('/', function () {
    return \Illuminate\Support\Facades\View::make('index.index');
})->middleware('userdata');

Route::get('/index', function () {
    return \Illuminate\Support\Facades\View::make('index.index');
})->middleware('userdata');

//
//支援服務
//
Route::get('/support/supportservice', 'ViewControllers\SupportServiceController@supportService');
Route::post('/support/supportservice', 'ViewControllers\SupportServiceController@createSupportCase');
//
//試用申請
//
Route::get('/applytest/applyservice', 'ViewControllers\ApplyTestController@applyService');
Route::post('/applytest/applyservice', 'ViewControllers\ApplyTestController@createApplyTestData');
//
//滿意度調查
//
Route::get('/support/closesatisfaction/{case_number}', 'ViewControllers\SatisfactionController@closeSatisfaction');
Route::post('/support/closesatisfaction', 'ViewControllers\SatisfactionController@closeSatisfactionsave');

//
//登入
//
Route::get('/login', function () {
    return \Illuminate\Support\Facades\View::make('auth.login');
    //return view('auth.login');
});
Route::post('/login', 'Auth\LoginController@login');
//
//登出
//
Route::get('/logout', [
    'as' => 'logout',
    'uses' => 'Auth\LoginController@logout'
]);

//
//Web Holiday
//
Route::get('/holiday/holiday', 'ViewControllers\HolidayController@webHolidayList');
Route::post('/holiday/holiday', 'ViewControllers\HolidayController@webHolidayList');
Route::post('/holiday/holiday_save', 'ViewControllers\HolidayController@detailActionDate');
//需要登入的頁面
Route::group(['middleware' => 'userdata'], function () {
//案件列表
    Route::get('/supportcase/caselist', [
        'as' => 'caselist',
        'uses' => 'ViewControllers\SupportCase\SupportCaseListController@supportCaseList'
    ]);
    Route::post('/supportcase/caselist', 'ViewControllers\SupportCase\SupportCaseListController@supportCaseListQuery');
//案件明細
    Route::get('/supportcase/casedetail', [
        'as' => 'casedetail',
        'uses' => 'ViewControllers\SupportCase\SupportCaseDetailController@supportCaseDetailGET'
    ]);
    Route::post('/supportcase/casedetail', 'ViewControllers\SupportCase\SupportCaseDetailController@supportCaseDetail');
//案件明細/設定連結客戶
    Route::get('/supportcase/casedetail/setcustomer', [
        'as' => 'casedetail/setcustomer',
        'uses' => 'ViewControllers\SupportCase\SupportCaseCustomerController@supportCaseCustomerGET'
    ]);
    Route::post('/supportcase/casedetail/setcustomer', 'ViewControllers\SupportCase\SupportCaseCustomerController@supportCaseCustomer');
//案件明細/設定負責業務
    Route::get('/supportcase/casedetail/setsales', [
        'as' => 'casedetail/setsales',
        'uses' => 'ViewControllers\SupportCase\SupportCaseSalesController@supportCaseSalesGET'
    ]);
    Route::post('/supportcase/casedetail/setsales', 'ViewControllers\SupportCase\SupportCaseSalesController@supportCaseSales');
//案件明細/設定支援工程師
    Route::get('/supportcase/casedetail/setsupportcase', [
        'as' => 'casedetail/setsupportcase',
        'uses' => 'ViewControllers\SupportCase\SupportCaseSupportController@supportCaseSupportGET'
    ]);
    Route::post('/supportcase/casedetail/setsupportcase', 'ViewControllers\SupportCase\SupportCaseSupportController@supportCaseSupport');
//案件明細/設定接案工程師
    Route::get('/supportcase/casedetail/settakecase', [
        'as' => 'casedetail/settakecase',
        'uses' => 'ViewControllers\SupportCase\SupportCaseTakeController@supportCaseTakeGET'
    ]);
    Route::post('/supportcase/casedetail/settakecase', 'ViewControllers\SupportCase\SupportCaseTakeController@supportCaseTake');
//案件明細/案件展延
    Route::get('/supportcase/casedetail/extendcase', [
        'as' => 'casedetail/extendcase',
        'uses' => 'ViewControllers\SupportCase\SupportCaseExtendController@supportCaseExtendGET'
    ]);
    Route::post('/supportcase/casedetail/extendcase', 'ViewControllers\SupportCase\SupportCaseExtendController@supportCaseExtend');
//案件明細/案件結案
    Route::get('/supportcase/casedetail/closecase', [
        'as' => 'casedetail/closecase',
        'uses' => 'ViewControllers\SupportCase\SupportCaseCloseController@supportCaseCloseGET'
    ]);
    Route::post('/supportcase/casedetail/closecase', 'ViewControllers\SupportCase\SupportCaseCloseController@supportCaseClose');
});


