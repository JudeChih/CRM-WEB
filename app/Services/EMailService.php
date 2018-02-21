<?php

namespace App\Services;

use \Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;

define('$server', config('app.ServerAddress'));

class EMailService extends Mailable {

    //private static $mail_CS = 'alen102411@gmail.com';
    //private static $mail_Engineer = 'alen102411@gmail.com';

    private static $mail_Sales = 'alen102411@gmail.com';
    private static $mail_CS = 'miffy.ho@sunwai.com';
    private static $mail_Engineer = 'ben.yeh@sunwai.com';
    private static $mail_EngineerBoss = 'ben.yeh@sunwai.com';


    private static $close_downloadURL = $server.'/files/closesupportcasefiles/';
    private static $new_downloadURL = $server.'/files/newsupportcasefiles/';

    // private static $mail_Sales = 'sausage760703@gmail.com';
    // private static $mail_CS = 'sausage760703@gmail.com';
    // private static $mail_Engineer = 'a90111123@yahoo.com.tw';
    // private static $mail_EngineerBoss = '1626030672@qq.com';

    /**
     * 寄送郵件-試用申請-寄送給〔業務〕
     * @param type $support_id
     */
    public static function send_ApplyForTest($apply_id) {

        $applydata = \App\Repositories\WebApplyTestRepository::withNew()->getData($apply_id);

        $customername = $applydata->comp_name;

        $subject = '試用申請 - ' . $customername;

        Mail::send('emails.apply_for_test', compact('applydata'), function ($message)use($subject) {
            $message->to(EMailService::$mail_Sales, '業務')
                    ->subject($subject);
        });
    }

    /**
     * 寄送郵件-結案滿意度調查-寄送給〔客戶〕
     * @param type $support_id
     */
    public static function send_CloseSatisfaction($support_id) {

        $casedata = \App\Repositories\WebSupportRepository::withNew()->getData($support_id);

        // $satisfactionurl = 'http://192.168.30.121:85/support/closesatisfaction/' . $casedata->case_number_sha1;

        $satisfactionurl = $server.'/support/closesatisfaction/' . $casedata->case_number_sha1;

        $contact_mail = $casedata->contact_mail;
        //$contact_mail = 'alen102411@gmail.com';
        $casenumber = $casedata->case_number;

        $subject = '技術支援滿意度調查 - ' . $casenumber;

        Mail::send('emails.close_satisfaction', compact('casedata', 'satisfactionurl'), function ($message)use($subject, $contact_mail) {
            $message->to($contact_mail, '客戶')
                    ->subject($subject);
        });
    }

    /**
     * 寄送郵件-新案件-寄送給工程師
     * @param type $support_id
     */
    public static function send_NewCaseEngineer($case_number) {
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

        $downloadURL = EMailService::$new_downloadURL;

        Mail::send('emails.new_case_engineer', compact('downloadURL','casedata'), function ($message)use($subject) {
            $message->to(EMailService::$mail_Engineer, '工程師')
                    ->subject($subject);
        });
    }

    /**
     * 寄送郵件-新案件-寄送給業務
     * @param type $support_id
     */
    public static function send_NewCaseSales($case_number) {
        if (!isset($case_number)) {
            return false;
        }
        $casedata = \App\Repositories\WebSupportRepository::withNew()->getDataByCaseNumber($case_number);
        $repository = new \App\Repositories\CrmCustomerSaleRelationRepository();

        if (!isset($casedata)) {
            return false;
        }
        if (!isset($casedata->cd_id)) {
            return;
        }
        $salesemails = $repository->getSalesMailArrayByCd_ID($casedata->cd_id);

        $pg_code = $casedata->productGroup->pg_code;

        $customername = $casedata->comp_name;
        //取得「問題父類別名稱」
        $programname = $casedata->problemCategory->problem_name;
        $casenumber = $casedata->case_number;

        $subject = '企業客戶 - ' . $pg_code . '問題-' . $customername . '-' . $programname . ' ' . $casenumber;

        Mail::send('emails.new_case_sales', compact('casedata'), function ($message)use($subject, $salesemails) {
            $message->to($salesemails)
                    ->subject($subject);
        });
    }

    /**
     * 寄送郵件-新案件-寄送給客戶
     * @param type $support_id
     */
    public static function send_NewCaseCustomer($case_number) {
        if (!isset($case_number)) {
            return false;
        }
        $casedata = \App\Repositories\WebSupportRepository::withNew()->getDataByCaseNumber($case_number);
        if (!isset($casedata)) {
            return false;
        }
        $contact_mail = $casedata->contact_mail;

        $pg_code = $casedata->productGroup->pg_code;

        $customername = $casedata->comp_name;
        //取得「問題父類別名稱」
        $programname = $casedata->problemCategory->problem_name;
        $casenumber = $casedata->case_number;

        $subject = '企業客戶 - ' . $pg_code . '問題-' . $customername . '-' . $programname . ' ' . $casenumber;

        $downloadURL = EMailService::$new_downloadURL;

        Mail::send('emails.new_case_engineer', compact('downloadURL','casedata'), function ($message)use($subject, $contact_mail) {
            $message->to($contact_mail)
                    ->subject($subject);
        });
    }

    /**
     * 寄送郵件-超過結案期限-寄送給〔客服〕
     * @param type $support_id
     */
    public static function send_OverCloseCaseDeadLine($case_numbers) {


        $subject = '結案期限通知 ';

        Mail::send('emails.over_close_deadline', compact('case_numbers'), function ($message)use($subject) {
            $message->to(EMailService::$mail_CS, '客服')
                    ->subject($subject);
        });
    }

    /**
     * 寄送郵件-超過接案期限-寄送給〔客服〕
     * @param type $support_id
     */
    public static function send_OverTakeCaseDeadLine($case_numbers) {

        $subject = '接案期限通知';

        Mail::send('emails.over_take_deadline', compact('case_numbers'), function ($message)use($subject) {
            $message->to(EMailService::$mail_CS, '客服')
                    ->subject($subject);
        });
    }

    /**
     * 寄送郵件-結案-寄送給CS,副本,密件副本
     * @param type $support_id
     */
    public static function send_CloseCaseCopy($support_id) {

        $casedata = \App\Repositories\WebSupportRepository::withNew()->getData($support_id);
        if (!isset($casedata)) {
            return false;
        }

        $casenumber = $casedata->case_number;
        $subject = '工程師結案 - ' . $casenumber;

        if($casedata->close_to != null){
            $to = explode(";",$casedata->close_to);
        }else{
            $to = [];
        }
        if($casedata->close_carboncopy != null){
            $cc = explode(";",$casedata->close_carboncopy);
            $cc[] = EMailService::$mail_Engineer;
        }else{
            $cc[] = EMailService::$mail_Engineer;
        }
        if($casedata->close_blindcarboncopy != null){
            $bcc = explode(";",$casedata->close_blindcarboncopy);
        }else{
            $bcc = [];
        }

        $downloadURL = EMailService::$close_downloadURL;

        Mail::send('emails.close_case_copy', compact('downloadURL','casedata'), function ($message)use($subject,$to,$cc,$bcc) {
            $message->to($to)
                    ->cc($cc)
                    ->bcc($bcc)
                    ->subject($subject);
        });
    }

    /**
     * 寄送郵件-滿意度太低-寄送給〔客服&Ben〕
     * @param type $support_id
     */
    public static function send_SatisfactionReaction($support_id) {

        $casedata = \App\Repositories\WebSupportRepository::withNew()->getData($support_id);
        if (!isset($casedata)) {
            return false;
        }

        $casenumber = $casedata->case_number;
        $subject = '滿意度太低 - ' . $casenumber;

        $SatisfactionData = \App\Repositories\WebSatisfactionSurveyRepository::withNew()->getCloseSatisfactionData();
        $Satisfactionscore = \App\Repositories\WebSatisfactionScoreRepository::withNew()->getDataBySupportID($casedata->support_id);
        $len = count($SatisfactionData);
        foreach ($SatisfactionData as $data) {
            $num = sprintf("%02s", $data->ss_sort);
            $score = 'score'.$num;
            $problem = 'problem'.$num;
            $sort = $data->ss_sort -1;
            switch($Satisfactionscore->$score){
                case '1':
                    $scoreArray[$sort]['score'] = '很不滿意';
                    $problemArray[$sort]['problem'] = $data->ss_description;
                    break;
                case '2':
                    $scoreArray[$sort]['score'] = '不滿意';
                    $problemArray[$sort]['problem'] = $data->ss_description;
                    break;
                case '3':
                    $scoreArray[$sort]['score'] = '尚可';
                    $problemArray[$sort]['problem'] = $data->ss_description;
                    break;
                case '4':
                    $scoreArray[$sort]['score'] = '滿意';
                    $problemArray[$sort]['problem'] = $data->ss_description;
                    break;
                case '5':
                    $scoreArray[$sort]['score'] = '很滿意';
                    $problemArray[$sort]['problem'] = $data->ss_description;
                    break;
            }
        }
        Mail::send('emails.satisfaction_reaction', compact('casenumber','scoreArray','len','problemArray','casedata'), function ($message)use($subject) {
                $message->to(EMailService::$mail_CS, '客服')
                        ->cc(EMailService::$mail_EngineerBoss, 'Ben')
                        ->subject($subject);
        });
    }

}
