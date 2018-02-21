<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Controllers\Controller;

class ScheduleController extends Controller {

    /**
     * 排程開始
     */
    function scheduleStart() {
        $result01 = $this->check_Deadline('takecase');
        $result02 = $this->check_Deadline('closecase');
        // return '[Result TakeCase]' . $result01 . '|[Result CloseCase]' . $result02;
    }

    function check_Deadline($deadlineType) {

        if (!isset($deadlineType)) {
            return;
        }

        $results = \App\Repositories\WebSupportRepository::withNew()->getDataByDeadline($deadlineType);
        //若無資料，則結束
        if (!isset($results) || count($results) == 0) {
            return 'no data';
        }

        //建立 〔寄送郵件〕用的「case_number」清單、〔更新資料為已提醒〕用的「support_id」清單
        foreach ($results as $data) {
            $case_numbers[] = $data->case_number;
            $support_ids[] = $data->support_id;
        }
        //若無資料，則結束
        if (!isset($case_numbers) || count($case_numbers) == 0) {
            return 'no data2';
        }

        if ($deadlineType == 'takecase') {
            //寄送郵件給客服
            \App\Services\EMailService::send_OverTakeCaseDeadLine($case_numbers);
            //更新資料為「已提醒」
            $result = \App\Models\WebSupport::whereIn('support_id', $support_ids)->update(['deadline_take_remind' => '1']);
        } else if ($deadlineType == 'closecase') {
            //寄送郵件給客服
            \App\Services\EMailService::send_OverCloseCaseDeadLine($case_numbers);
            //更新資料為「已提醒」
            $result = \App\Models\WebSupport::whereIn('support_id', $support_ids)->update(['deadline_close_remind' => '1']);
        }

        return 'success';
    }

    function check_Deadline_TakeCase() {
        $result = \App\Repositories\WebSupportRepository::withNew()->getDataByDeadline('takecase');

        foreach ($result as $data) {
            $case_numbers[] = $data->case_number;
        }

        if (!isset($case_numbers) || count($case_numbers) == 0) {
            return;
        }

        \App\Services\EMailService::send_OverTakeCaseDeadLine($case_numbers);
    }

    function check_Deadline_CloseCase() {
        $result = \App\Repositories\WebSupportRepository::withNew()->getDataByDeadline('closecase');

        //建立 〔郵件〕用的「case_number」清單、〔更新〕用的「support_id」清單
        foreach ($result as $data) {
            $case_numbers[] = $data->case_number;
            $support_ids[] = $data->support_id;
        }
        //若無資料，則結束
        if (!isset($case_numbers) || count($case_numbers) == 0) {
            return;
        }
        //寄送郵件給客服
        \App\Services\EMailService::send_OverCloseCaseDeadLine($case_numbers);

        $result = \App\Models\WebSupport::whereIn('support_id', $support_ids)->update(['deadline_close_remind' => '1']);

        echo json_encode($result);
    }

    function update_Deadline_Remind() {

    }
}
