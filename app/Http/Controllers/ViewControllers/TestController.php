<?php

namespace App\Http\Controllers\ViewControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\View;

class TestController extends Controller {

    public function sendMail(Request $request) {
        if (!isset($request->mailtype)) {
            return \Illuminate\Support\Facades\View::make('test.mail');
        }

        switch ($request->mailtype) {
            case 'applyfortest':
                \App\Services\EMailService::send_ApplyForTest('21');
                break;
            case 'close_satisfaction':
                \App\Services\EMailService::send_CloseSatisfaction('44');
                break;
            case 'newcase':
                \App\Services\EMailService::send_NewCaseEngineer('44');
                break;
            case 'overclose':
                \App\Services\EMailService::send_OverCloseCaseDeadLine('44');
                break;
            case 'overtake':
                \App\Services\EMailService::send_OverTakeCaseDeadLine('44');
                break;
        }
        return \Illuminate\Support\Facades\View::make('test.mail');
    }

    public function testReCaptcha(Request $request) {

        echo json_encode($request->all());
        echo '<br>';
        echo '@@@[';
        echo $request['g-recaptcha-response'];
        echo ']@@@';
        echo '<br>';
        if (!isset($request['g-recaptcha-response'])) {
            echo ']@@@';
            echo '<br>';
            return \Illuminate\Support\Facades\View::make('test.mail');
        } else {

        }

        $ReCaptchaResponse = $request['g-recaptcha-response'];
        echo $ReCaptchaResponse;
        echo '<br>';
        $Response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LcBIA4UAAAAAI8UJvYjWeOOOmAyhU-KgKpSvYl4&response=' . $ReCaptchaResponse . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        echo $Response;
        $qqq = json_decode($Response);
        echo ($qqq->success) ? 'OK' : 'ERROR';
        //echo ($Response->isSuccess()) ? 'OK' : 'ERROR';


        return \Illuminate\Support\Facades\View::make('test.recaptcha');
    }

    public function mailView_NewCaseEngineer() {

        $case_number = '20161222-002';

        \App\Services\EMailService::send_NewCaseSales($case_number);
        return;

        if (!isset($case_number)) {
            return false;
        }
        $casedata = \App\Repositories\WebSupportRepository::withNew()->getDataByCaseNumber($case_number);
        if (!isset($casedata)) {
            return false;
        }
        $pg_code = $casedata->productGroup->pg_code;

        $customername = $casedata->comp_name;
        //取得「問題父類別名稱」
        $programname = $casedata->problemCategory->problem_name;
        $casenumber = $casedata->case_number;

        $subject = '企業客戶 - ' . $pg_code . '問題-' . $customername . '-' . $programname . ' ' . $casenumber;

        return View::make('emails.new_case_engineer', compact('casedata'));
    }

}
