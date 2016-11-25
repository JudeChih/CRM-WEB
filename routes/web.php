<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of the routes that are handled
  | by your application. Just tell Laravel the URIs it should respond
  | to using a Closure or controller method. Build something great!
  |
 */

Route::get('/', function () {
    return view('welcome');
});
Route::get('index', function () {
    return view('welcome');
});

// Route::get('/applyfortest', function () {
//     return view('apply.index');
// });

// Route::post('/applyfortest/senddata', 'ApplyController@senddata');

Route::get('/cust', function () {

    $customer = Illuminate\Support\Facades\DB::table('crmcustomerdata')
                    ->where('cd_id', '55')->get();

    //echo json_decode(json_encode($customer, true));
    echo json_encode($customer, FALSE);
    //return view('welcome');
});

//Login
Route::get('login', 'Auth\LoginController@login');
Route::post('login', 'Auth\LoginController@login');
Route::group([
    'prefix' => 'restricted',
    'middleware' => 'auth:api',
        ], function () {

    // Authentication Routes...
    Route::get('logout', 'Auth\LoginController@logout');

    Route::get('/test', function () {
        return 'authenticated';
    });
});
//
//SupportService
//
Route::get('/support/supportservice', 'ViewControllers\SupportController@supportService');
Route::post('/support/supportservice', 'ViewControllers\SupportController@createSupportCase');

Route::post('/support/select', 'ViewControllers\SupportController@getProductDataDetail');
// Route::post('/support/select', function(){
//   return 'Success! ajax in laravel 5';
// });
//
//Apply For Test
//
Route::get('/applytest/applyfortest', 'ViewControllers\ApplyTestController@applyTest');
Route::post('/applytest/applyfortest', 'ViewControllers\ApplyTestController@createApplyCase');
Route::post('/applytest/select', 'ViewControllers\SupportController@getProductDataDetail');
//
//Support Case
//
Route::get('/supportcase/caselist', 'ViewControllers\SupportCaseController@supportCaseList');
Route::post('/supportcase/casedetail', 'ViewControllers\SupportCaseController@supportCaseDetail');
Route::post('/supportcase/casedetailaction', 'ViewControllers\SupportCaseController@supportCaseDetailAction');
//
//SupportCaseCustomer
//
Route::get('/supportcase/case_customer', 'ViewControllers\SupportCaseCustomerController@supportCaseCustomer');
//
//SupportCaseSales
//
Route::get('/supportcase/case_sales', 'ViewControllers\SupportCaseCustomerController@supportCaseSales');
//
//SupportCaseTakeEngineer
//
Route::get('/supportcase/case_take_engineer', 'ViewControllers\SupportCaseCustomerController@supportCaseTakeEngineer');
//
//SupportCaseSupportEngieer
//
Route::get('/supportcase/case_support_engineer', 'ViewControllers\SupportCaseCustomerController@supportCaseSupportEngieer');
//
//MailNewCaseEngineer
//
Route::get('/emails/new_case_engineer', 'ViewControllers\MailTextViewController@mailNewCaseEngineer');
//
//MailNewCaseCustomer
//
Route::get('/emails/new_case_customer', 'ViewControllers\MailTextViewController@mailNewCaseCustomer');
//
//CloseSatisfaction
//
Route::get('/emails/close_satisfaction', 'ViewControllers\MailTextViewController@closeSatisfaction');
//
//OverTakeDeadline
//
Route::get('/emails/over_take_deadline', 'ViewControllers\MailTextViewController@overTakeDeadline');
//
//OverCloseDeadline
//
Route::get('/emails/over_close_deadline', 'ViewControllers\MailTextViewController@overCloseDeadline');
//
//ApplyForTest
//
Route::get('/emails/apply_for_test', 'ViewControllers\MailTextViewController@applyForTest');
//
//Login
//
Route::get('/login/login', 'ViewControllers\LoginController@login');
//
//SupportSurvey
//
Route::get('support/close_satisfaction', 'ViewControllers\SupportController@closeSatisfaction');
Route::post('support/close_satisfaction', 'ViewControllers\SupportController@closeSatisfaction');
//
//UserRegister
//
Route::get('/support/supportUserRegister', 'ViewControllers\SupportUserController@supportService');
//
//Case Group
//
Route::post('/supportcase/casecustomer', 'ViewControllers\SupportCaseQueryController@detailActionCustomer');
Route::post('/supportcase/casesales', 'ViewControllers\SupportCaseQueryController@detailActionSales');
Route::post('/supportcase/takecase', 'ViewControllers\SupportCaseQueryController@detailActionTakeEngineer');
Route::post('/supportcase/support', 'ViewControllers\SupportCaseQueryController@detailActionSupportEngineer');
//
//Case Table
//
// Route::get('/supportcase/case_table', function(){
//   return view('supportcase/case_table');
// });
Route::get('/supportcase/case_table', 'ViewControllers\SupportCaseTableController@caseTableList');
Route::post('/supportcase/case_table', 'ViewControllers\SupportCaseTableController@caseTableList');
Route::post('/supportcase/case_table_save', 'ViewControllers\SupportCaseTableController@detailActionDate');

// Route::post('/ajax/create', function(){
//    return 'Success! ajax in laravel 5';
// });


