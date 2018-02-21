<?php
$title = "滿意度評價";
?>
<table style="width:600px;margin: 0 auto;font-family:微軟正黑體; font-size:14px;">
    <thead>
        <tr>
            <th style="text-align: center;font-size:25px;padding-bottom:20px;">滿意度評價</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><span style="font-size:16px;padding: 5px;background-color: #ddd;border-radius: 5px;">案件編號：{{$casenumber}}</span></td>
        </tr>
        <tr>
             <td style="padding:5px 0 5px 40px;">
                公司名稱：{{$casedata->comp_name}}
             </td>
        </tr>
        <tr>
             <td style="padding:5px 0 5px 40px;">
                連絡人：{{$casedata->contact_name}}
             </td>
        </tr>
        <tr>
             <td style="padding:5px 0 5px 40px;">
                電子信箱：{{$casedata->contact_mail}}
             </td>
        </tr>
        @for ($i = 0; $i < $len; $i++)
            <tr>
                <td style="padding:5px 0 5px 40px;">
                    {{ $problemArray[$i]['problem'] }}：
                    {{ $scoreArray[$i]['score'] }}
                </td>
            </tr>
        @endfor
        <tr>
            <td></td>
        </tr>
        <tr>
            <td style="padding-top:40px;text-align: center;">註 : 此為系統自動發送的信件，無須回覆。</td>
        </tr>
    </tbody>
</table>
