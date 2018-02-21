<?php
$title = "結案副本";
?>
<table style="width:600px;margin: 0 auto;font-family:微軟正黑體; font-size:14px;">
    <thead>
        <tr>
            <th style="text-align: center;font-size:25px;padding-bottom:20px;">結案副本</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><span style="font-size:16px;padding: 5px;background-color: #ddd;border-radius: 5px;">案件編號：{{ $casedata->case_number }}</span></td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">案件主旨：{{ $casedata->comp_name }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">結案日期：{{ $casedata->close_date }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">結案描述：{{ $casedata->close_description }}</td>
        </tr>
        @if($casedata->close_filename == null)
            <tr>
                <td style="padding:5px 0 5px 40px;">上傳的檔案：無</td>
            </tr>
        @else
            <tr>
                <td style="padding:5px 0 5px 40px;">上傳的檔案：<a href="{{ $downloadURL.$casedata->close_filename }}" download="{{$casedata->close_filename}}">連結</a></td>
            </tr>
        @endif
        <tr>
            <td style="padding-top:40px;text-align: center;">註 : 此為系統自動發送的信件，無須回覆。</td>
        </tr>
    </tbody>
</table>
